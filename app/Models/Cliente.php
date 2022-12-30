<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'empresa',
        'telefone',
        'email',
        'data_nascimento',
    ];

    public function endereco()
    {
        return $this->hasOne(ClienteEndereco::class, 'cliente_id');
    }
}
