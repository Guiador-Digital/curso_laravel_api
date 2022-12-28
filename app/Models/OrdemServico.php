<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemServico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ordens_servicos';

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'servico_id',
        'cliente_id'
    ];
}
