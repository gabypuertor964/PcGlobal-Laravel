<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'names',
        'surnames',
        'gender_id',
        'document_type_id',
        'document_number',
        'phone_number',
        'date_birth',
        'email',
        'password',
        'state_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @abstract Obtener los campos autorizados para ser llenados a través de asignación masiva
     * 
     * @return array
    */
    public static function inputs()
    {
        return (new self())->getFillable();
    }

    /**
     * @abstract Declara la relacion 1:1 con el modelo Gender (Géneros) FK: gender_id (Default)
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * @abstract Declara la relacion 1:1 con el modelo DocumentType (Tipos de Documentos) FK: document_type_id (Default)
    */
    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
