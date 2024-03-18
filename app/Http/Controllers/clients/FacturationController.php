<?php

namespace App\Http\Controllers\clients;

use App\Helpers\CleanInputs;
use App\Helpers\SlugManager;
use App\Http\Controllers\Controller;
use App\Models\SaleInvoice;
use Carbon\Carbon;
use DateTime;
use Exception;

class FacturationController extends Controller
{

    /**
     * @abstract Separar como arreglo asociativo la fecha y hora de la factura
     * 
     * @param string $date
     * @return array
    */
    public static function getDateTimeInArray(string $date): array
    {
        // Parsear la fecha de la factura
        $datetime = Carbon::parse($date);

        // Retornar la informacion
        return [
            'date' => CleanInputs::clean($datetime->toDateString()),
            'time' => CleanInputs::clean($datetime->toTimeString())
        ];
    }

    /**
     * @abstract Obtener el porcentaje de impuestos de la factura
     * 
     * @param SaleInvoice $facturation
     * @return float|int
    */
    public static function getTaxPercentage(SaleInvoice $facturation): float|int
    {
        return ($facturation->taxes / $facturation->subtotal) * 100;
    }

    /**
     * @abstract Obtener la informacion de la factura seleccionada segun su slug (Codificado o decodificado)
     * 
     * @param string $slug
    */
    public static function get(string $slug, bool $decryp = true)
    {
        try{
            // Verificar si se debe decodificar el slug
            if($decryp){
                $slug = SlugManager::decrypt($slug);
            }

            // Buscar la factura segun el slug
            $facturation = SaleInvoice::where('id', $slug)->first();
            return $facturation;
        }catch(Exception){
            return null;
        }
    }

    /**
     * @abstract Listar la lista de compras realizadas por el cliente
     */
    public function index()
    {
        // Obtener la lista de facturaciones realizadas por el cliente
        $facturations = SaleInvoice::where('id_client', auth()->user()->id)
            ->paginate(10);

        // Modificacion de los valores originales para facilitar su visualizacion y uso
        foreach($facturations as $facturation){

            // Parsear la fecha de la factura
            $datetime = self::getDateTimeInArray($facturation->date_sale);

            // Obtener la fecha de la factura
            $facturation->date = $datetime['date'];

            // Obtener la hora de la factura
            $facturation->time = $datetime['time'];

            // Encritar el slug de la factura
            $facturation->slug = SlugManager::encrypt($facturation->id);
        }
        
        // Retornar la vista con la lista de facturaciones
        return view("clients.facturation.index", compact('facturations'));
    }

    /**
     * @abstract Mostrar la informacion de la factura seleccionada segun su slug
     */
    public function show(string $slug)
    {
        // Obtener la informacion de la factura seleccionada segun su slug
        $facturation = self::get($slug);

        // Verificar si la factura no existe
        if($facturation == null){
            return redirect()->back()->with('message', [
                'status' => 'danger',
                'text' => '!La factura seleccionada no existe!'
            ]);
        }

        // Verificar si el cliente no tiene asociada esta compra
        if ($facturation->id_client != auth()->user()->id) {
            return redirect()->back()->with('message', [
                'status' => 'danger',
                'text' => '!Usted no tiene asociada esta compra!'
            ]);
        }

        // Obtener y separar como arreglo asociativo la fecha y hora de la factura
        $datetime = self::getDateTimeInArray($facturation->date_sale);
        $facturation->date = $datetime['date'];
        $facturation->time = $datetime['time'];

        // Calcular el porcentaje de impuestos
        $facturation->tax_percentage = self::getTaxPercentage($facturation);

        // Retornar la vista con la informacion de la factura
        return view('clients.facturation.show', compact('facturation'));
    }

}
