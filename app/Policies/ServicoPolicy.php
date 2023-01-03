<?php

namespace App\Policies;

use App\Models\Servico;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ServicoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Servico $servico)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Servico $servico)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Servico $servico)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Servico $servico)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Servico $servico)
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
