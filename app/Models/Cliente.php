<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente
extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

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
