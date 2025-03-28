<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method bool delete() Deleta o modelo no banco de dados
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Campos que devem ser ocultados no array JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversões de tipos de atributos.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Criptografa a senha automaticamente ao salvar no banco.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
