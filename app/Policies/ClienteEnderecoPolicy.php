<?php

namespace App\Policies;

use App\Models\ClienteEndereco;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ClienteEnderecoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClienteEndereco  $clienteEndereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, ClienteEndereco $clienteEndereco)
    {
        $checkUser = $this->checkIsUserAuth();
        $authUser = auth()->user();

        if ($checkUser === false && $authUser->id != $clienteEndereco->cliente_id) return false;

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        $checkUser = $this->checkIsUserAuth();
        $authUser = auth()->user();

        if ($checkUser === false && $authUser->id != request()->input('cliente_id')) return false;

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClienteEndereco  $clienteEndereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, ClienteEndereco $clienteEndereco)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClienteEndereco  $clienteEndereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, ClienteEndereco $clienteEndereco)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClienteEndereco  $clienteEndereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, ClienteEndereco $clienteEndereco)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClienteEndereco  $clienteEndereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, ClienteEndereco $clienteEndereco)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    public function checkIsUserAuth()
    {
        if (Auth::guard('api')->check() == false) {
            return false;
        }
    }
}
