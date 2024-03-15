<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\SaleInvoice;
use Illuminate\Http\Request;

class PayPalCardController extends Controller
{

    private $client;
    private $clientId;
    private $secret;

    public function __construct() 
    {
        $this->client = Http::get([
            'base_uri' => 'https://api-m.sandbox.paypal.com'
        ]);

        $this->clientId = env('PAYPAL_CLIENT_ID');
        $this->secret = env('PAYPAL_SECRET');
    }

    private function getAccesToken() 
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
        $accesToken = $this->getAccesToken();

        $response = $this->client->request('GET', '/v2/checkout/orders/'. $orderId, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer $accessToken'
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        if ($data['status'] === 'APPROVED') {
            // TODO: Finalizar la inserción de la venta
            $sale = SaleInvoice::create([]);
        } else {
            return 
            [
                'success' => false
            ];
        }
    }
}
