<?php

namespace App\Policies;

use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class OrdemServicoPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrdemServico  $ordemServico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, OrdemServico $ordemServico)
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false && auth()->user()->id != $ordemServico->cliente_id) return false;

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
     * @param  \App\Models\OrdemServico  $ordemServico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update()
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrdemServico  $ordemServico
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
     * @param  \App\Models\OrdemServico  $ordemServico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore()
    {
        $checkUser = $this->checkIsUserAuth();
        if ($checkUser === false) return false;

        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrdemServico  $ordemServico
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete()
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
