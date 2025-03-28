<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Atributos que podem ser preenchidos em massa (mass assignment).
     */
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'comentarios',
    ];
}
