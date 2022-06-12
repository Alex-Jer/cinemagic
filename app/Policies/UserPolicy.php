<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return ($user->tipo != 'C');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return UserPolicy::canView($user, $model);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return ($user->tipo == 'A');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return UserPolicy::canEdit($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return UserPolicy::canDelete($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function block(User $user, User $model)
    {
        return UserPolicy::canBlock($user, $model);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }

    public static function canEdit(User $user, User $model)
    {
        switch ($model->tipo) {
            case 'A':
                return ($user->tipo == 'A');
            case 'F':
                return ($user->tipo == 'A');
            case 'C':
                return ($user->id == $model->id);
        }
        return false;
    }

    public static function canDelete(User $user, User $model)
    {
        return $user->tipo == 'A' && $user->id != $model->id;
    }

    public static function canBlock(User $user, User $model)
    {
        return $user->tipo == 'A' && $user->id != $model->id;
    }

    public static function canView(User $user, User $model)
    {
        switch ($model->tipo) {
            case 'A':
                return ($user->tipo == 'A');
            case 'F':
                return ($user->tipo == 'A');
            case 'C':
                return ($user->tipo == 'F' || ($user->id == $model->id));
        }
        return false;
    }
}
