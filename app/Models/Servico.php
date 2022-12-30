<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'servicos';

    protected $fillable = [
        'nome',
        'descricao',
        'valor'
    ];

    public function ordens_servicos()
    {
        return $this->hasMany(OrdemServico::class, 'servico_id');
    }
}
