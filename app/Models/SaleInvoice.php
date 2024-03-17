<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'sales_invoices';
    
    protected $fillable = 
    [
        'date_sale',
        'id_client',
        'subtotal',
        'taxes',
        'total',
        'id_state'
    ];
}
