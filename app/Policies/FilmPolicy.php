<?php

namespace App\Policies;

use App\Models\Film;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmPolicy
{
    use HandlesAuthorization;

    //Esta policy so está a ser utilizada nas rotas de filmes relacionadas aos admins
    public function before($user, $ability)
    {
        if (!$user->isAdmin()) {
            return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Film $film)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Film $film)
    {
        return (Screening::where('filme_id', $film->id)->count() == 0);
    }
}
