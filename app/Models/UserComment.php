<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'comentario',
    ];

    // Relacionamento com o modelo Client
    public function cliente()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
