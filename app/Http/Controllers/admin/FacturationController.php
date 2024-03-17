<?php

namespace App\Http\Controllers\admin;

use App\Helpers\SlugManager;
use App\Http\Controllers\clients\FacturationController as ClientsFacturationController;
use App\Http\Controllers\Controller;
use App\Models\SaleInvoice;
use App\Models\State;
use Exception;
use Illuminate\Http\Request;

class FacturationController extends Controller
{
    /**
     * @abstract Obtener la factura segun el slug encriptado
     * 
     * @param string $slug
     * 
     * @return SaleInvoice|null
    */
    public static function get(string $slug): ?SaleInvoice
    {
        try{
            return SaleInvoice::find(SlugManager::decrypt($slug));
        }catch(Exception){
            return null;
        }
    }

    
    /**
     * @abstract Constructor de la clase
    */
    public function __construct()
    {
        // Actualizar middlewares especificos
        $this->middleware('can: delivery.read')->only('search');
    }

    /**
     * @abstract Buscar facturas segun el modo y el rol del usuario
    */
    public function search(Request $request)
    {
        $query = $request->name;
    
        $sales = SaleInvoice::search($query)->get()->first();

        if ($sales) return redirect()->route("product.show", $sales->slug);

        return "No hay resultados";
    }
    
    /**
     * @abstract Consultar y mostrar la lista de facturas
     */
    public function index()
    {
        # Obtener todas las facturas y paginarlas
        $facturations = SaleInvoice::paginate(10);

        foreach($facturations as $facturation){
            # Encriptar el id de la factura
            $facturation->slug = SlugManager::encrypt($facturation->id);

            # Separar la fecha y hora de la factura
            $facturation->datetime = ClientsFacturationController::getDateTimeInArray($facturation->date_sale);
        }

        # Retornar la vista con la informacion
        return view("admin.facturation.index", compact('facturations'));
    }

    /**
     * @abstract Ver la informacion detallada de una factura
     */
    public function show(string $slug)
    {
        // Obtener la factura segun el slug
        $facturation = self::get($slug);

        // Verificar si la factura existe
        if(is_null($facturation)){
            return redirect()->back()->with('message',[
                'status' => 'danger',
                'message' => '!Error, Factura no encontrada!'
            ]);
        }

        // Separar la fecha y hora de la factura
        $facturation->datetime = ClientsFacturationController::getDateTimeInArray($facturation->date_sale);

        // Calcular el porcentaje de impuestos
        $facturation->tax_percentage = ClientsFacturationController::getTaxPercentage($facturation);

        // Retornar la vista con la informacion
        return view("admin.facturation.show", compact('facturation'));
    }

    /**
     * @abstract Consultar y mostrar la lista de facturas pendientes por entregar
    */
    public function active()
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
            $facturation->datetime = ClientsFacturationController::getDateTimeInArray($facturation->date_sale);
        }

        # Retornar la vista con la informacion
        return view("admin.facturation.actives", compact('facturations'));
    }

}
