<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

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
}
