<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseUnit extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'purchase_units';

    protected $fillable = 
    [
        'id_invoice',
        'id_product',
        'quantity'
    ];
}
