<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pqrs extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden llenar de forma masiva
    */
    protected $fillable = [
        'client_id',
        'pqrs_type_id',
        'title',
        'description',
        'date_ocurrence',
        'worker_id',
        'response',
        'state_id'
    ];

    /**
     * @abstract Obtener los campos que se pueden llenar de forma masiva
     * 
     * @var array
    */
    public static function inputs()
    {
        return (new self())->getFillable();
    }

    /**
     * @abstract Establecer la relacion 1:1 con el modelo User (Usuario) -> Obtener el cliente que realizo la PQRS
    */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * @abstract Establecer la relacion 1:1 con el modelo User (Usuario) -> Obtener el empleado que respondio la pqrs
    */
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    /**
     * @abstract Establecer la relacion 1:1 con el modelo PqrsType (Tipo de PQRS)
    */
    public function type()
    {
        return $this->belongsTo(PqrsType::class, 'pqrs_type_id');
    }

    /**
     * @abstract Establecer la relacion 1:1 con el modelo States (Estados)
    */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
