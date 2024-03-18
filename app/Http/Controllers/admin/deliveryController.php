<?php

namespace App\Http\Controllers\admin;

use App\Helpers\SlugManager;
use App\Http\Controllers\clients\FacturationController;
use App\Http\Controllers\Controller;
use App\Mail\facturation\ProductDeliveryMail;
use App\Models\SaleInvoice;
use App\Models\State;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class deliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # Obtener todas las facturas y paginarlas
        $facturations = SaleInvoice::where('id_state', function ($query) {
            $query->select('id')
                  ->from('states')
                  ->where('name', 'Pendiente por entregar');
        })->paginate(10);
        

        foreach($facturations as $facturation){
            # Encriptar el id de la factura
            $facturation->slug = SlugManager::encrypt($facturation->id);

            # Separar la fecha y hora de la factura
            $facturation->datetime = FacturationController::getDateTimeInArray($facturation->date_sale);
        }

        # Retornar la vista con la informacion
        return view("admin.delivery.index", compact('facturations'));
    }
    
    /**
     * @abstract Consultar la factura segun el slug encriptado
     */
    public function edit(string $slug)
    {
        // Obtener la factura segun el slug
        $facturation = FacturationController::get($slug);

        // Verificar si la factura existe
        if($facturation == null){
            return redirect()->route('admin.facturation.index');
        }

        // Validar si la el pedido ya fue entregado
        if($facturation->state->name == "Entregado"){
            return redirect()->route('admin.delivery.index')->with('message',[
                'status' => 'danger',
                'message' => '¡Error, La factura ya fue entregada!'
            ]);
        }

        // Separar la fecha y hora de la factura
        $facturation->datetime = FacturationController::getDateTimeInArray($facturation->date_sale);

        // Encriptar el slug
        $facturation->slug = $slug;

        // Retornar la vista con la informacion
        return view("admin.delivery.edit", compact('facturation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $slug)
    {
        try{

            // Obtener la factura segun el id
            $facturation = FacturationController::get($slug);
    
            // Verificar si la factura existe
            if($facturation == null){
                return redirect()->route('admin.facturation.index');
            }

            // Validar si la el pedido ya fue entregado
            if($facturation->state->name == "Entregado"){
                return redirect()->route('admin.delivery.index')->with('message',[
                    'status' => 'danger',
                    'text' => '¡Error, La factura ya fue entregada!'
                ]);
            }

            DB::transaction(function() use($facturation){
                // Actualizar el estado de la factura
                $facturation->id_state = State::where('name', 'Entregado')->first()->id;
                $facturation->save();
            });

            Mail::to($facturation->client->email)->send(new ProductDeliveryMail($facturation));

            // Retornar la vista con la informacion
            return redirect()->route('admin.delivery.index')->with('message',[
                'status' => 'success',
                'text' => '¡Entrega registrada correctamente!'
            ]);

        }catch(Exception){
            return redirect()->route('admin.delivery.index')->with('message',[
                'status' => 'danger',
                'text' => '¡Error, No se ha podido actualizar la entrega!'
            ]);
        }        
    }
}
