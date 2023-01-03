<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait AutoEmbedClienteId
{
    protected static function bootAutoEmbedClienteId()
    {
        if (auth()->check()) {
            if (Auth::guard('api')->check() == false) {
                $authUser = auth()->user();

                static::addGlobalScope('cliente_owner_id', function (Builder $builder) use ($authUser) {
                    $builder->where('cliente_id', $authUser->id);
                });
            }
        }
    }
}
