<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseUnit extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'purchase_units';

    // Campos autorizados para asignación masiva
    protected $fillable = 
    [
        'id_invoice',
        'id_product',
        'quantity',
        'unit_price'
    ];

    /**
     * @abstract Relación 1:N con el modelo Product (productos) FK: id_product
    */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
