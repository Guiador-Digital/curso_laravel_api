<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ClientePolicy
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
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Cliente $cliente)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false && auth()->user()->id !== $cliente->id) return false;

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
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Cliente $cliente)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false && auth()->user()->id !== $cliente->id) return false;

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete()
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Cliente $cliente)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Cliente $cliente)
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
