<?php

namespace App\Models;

use App\Traits\AutoEmbedClienteId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemServico extends Model
{
    use HasFactory, SoftDeletes, AutoEmbedClienteId;

    protected $table = 'ordens_servicos';

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'servico_id',
        'cliente_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id');
    }
}
