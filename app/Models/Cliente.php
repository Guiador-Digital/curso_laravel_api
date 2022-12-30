<?php

namespace App\Models;

use Carbon\Carbon;
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
        'password',
        'data_nascimento',
    ];

    protected $hidden = ['password'];

    protected $appends = ['possui_os_no_mes_vigente'];

    public function endereco()
    {
        return $this->hasOne(ClienteEndereco::class, 'cliente_id');
    }

    public function ordens_servicos()
    {
        return $this->hasMany(OrdemServico::class, 'cliente_id');
    }

    public function getPossuiOsNoMesVigenteAttribute($model)
    {
        $now = Carbon::now();
        $os = OrdemServico::where([
            ['cliente_id', $this->id]
        ])->whereMonth('created_at', $now->month)->count();

        if ($os > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmpresaAttribute($value)
    {
        return $value ?? '';
    }
}
