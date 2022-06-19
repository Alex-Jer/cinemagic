<?php

namespace App\Policies;

use App\Models\Screening;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScreeningPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyAdmin(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyEmployee(User $user)
    {
        return $user->isEmployee();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Screening $screening)
    {
        if ($user->isAdmin())
            return true;
        else
            return $this->validate($user, $screening);
    }

    public function validate(User $user, Screening $screening)
    {
        return ($user->isEmployee() && ($screening->data > now() ||
            ($screening->data->format('d/m/Y') == now()->format('d/m/Y')
                && $screening->horario_inicio->format('H:i') >= now()->subHours(2)->format('H:i') //pode entrar quando quiser até ao fim do filme (2 horas)
                && $screening->horario_inicio->format('H:i') < now()->addMinutes(15)->format('H:i') //pode entrar na sessão apenas 15 minutos antes do início da mesma
            )));
    }

    public function buy(User $user, Screening $screening)
    {
        return ($user->isCustomer() && ($screening->data > now() ||
            ($screening->data->format('d/m/Y') == now()->format('d/m/Y')
                && $screening->horario_inicio->format('H:i') >= now()->subMinutes(5)->format('H:i')
            )));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Screening $screening)
    {
        return $user->isAdmin() && $screening->tickets()->count() == 0;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Screening $screening)
    {
        return $this->update($user, $screening);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Screening $screening)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Screening $screening)
    {
        //
    }
}
