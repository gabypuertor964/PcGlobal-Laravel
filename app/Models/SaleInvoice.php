<?php

namespace App\Models;

use App\Http\Controllers\clients\FacturationController;
use App\Helpers\SlugManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SaleInvoice extends Model
{
    use HasFactory, Searchable;

    // Nombre tabla
    protected $table = 'sales_invoices';
    
    // Campos autorizados para asigancion masiva
    protected $fillable = [
        'date_sale',
        'id_client',
        'subtotal',
        'taxes',
        'total',
        'id_state'
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->client->fullName(),
            'date' => FacturationController::getDateTimeInArray($this->date_sale)["date"],
            'slug' => SlugManager::encrypt($this->id),
            'document' => $this->client->document_number,
            'state' => $this->state->name,
        ];
    }

    /**
     * @abstract Relación uno a muchos con el modelo PurchaseUnit (detalles de la factura de compra) FK: id_invoice
    */
    public function details()
    {
        return $this->hasMany(PurchaseUnit::class, 'id_invoice');
    }

    /**
     * @abstract Relacion 1:1 con el modelo States (estados) FK: id_state
    */
    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

    /**
     * @abstract Relacion 1:1 con el modelo Clients (clientes) FK: id_client
    */
    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }
}
