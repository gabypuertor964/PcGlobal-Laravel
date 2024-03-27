<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\AuthController;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Mail\facturation\CreateFacturationMail;
use App\Models\Product;
use App\Models\PurchaseUnit;
use App\Models\SaleInvoice;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PayPalCardController extends Controller
{

    private $client;
    private $clientId;
    private $secret;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com'
        ]);

        $this->clientId = env('PAYPAL_CLIENT_ID');
        $this->secret = env('PAYPAL_SECRET');
    }

    private function getAccessToken()
    {
        $response = $this->client->request('POST', '/v1/oauth2/token', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => 'grant_type=client_credentials',
            'auth' => [
                $this->clientId, $this->secret, 'basic'
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function process($orderId)
    {
        $accessToken = $this->getAccessToken();

        $response = $this->client->request('GET', '/v2/checkout/orders/' . $orderId, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        $user = AuthController::get();
        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'APPROVED' && $user !== null) {
            $subtotal = Cart::subtotal();
            $taxes = Cart::tax();
            $total = Cart::total();
            $cartContent = Cart::content();
            return
                [
                    'success' => $this->createInvoicePayment($user, $subtotal, $taxes, $total, $cartContent),
                    'url' => route('cart.clear.after.purchase')
                ];
        }

        return
            [
                'success' => false
            ];
    }


    private function createInvoicePayment(User $user, float $subtotal, float $taxes, float $total, mixed $cartContent): bool
    {
        try {
            DB::transaction(function () use ($user, $subtotal, $taxes, $total, $cartContent) {

                $sale = SaleInvoice::create([
                    'date_sale' => Carbon::now(),
                    'id_client' => $user->id,
                    'subtotal' => $subtotal,
                    'taxes' => $taxes,
                    'total' => $total,
                    'id_state' => State::where('name', 'Pendiente por entregar')->first()->id
                ]);

                foreach ($cartContent as $cartProduct) {
                    //Actualizar la cantidad 
                    $product = Product::all()->where('id', '=', $cartProduct->id)->first();
                    $product->stock -= $cartProduct->qty;
                    $product->save();

                    //Asociar los productos de compra con la cantidad y la factura
                    PurchaseUnit::create([
                        'id_invoice' => $sale->id,
                        'id_product' => $cartProduct->id,
                        'quantity' => $cartProduct->qty,
                        'unit_price' => $cartProduct->price
                    ]);
                }

                // Mail::to($user->email)->send(new CreateFacturationMail($sale));

            });

            return true;
        } catch (Exception) {
            return false;
        }
    }
}
