<?php

namespace App\Policies;

use App\Models\Receipt;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReceiptPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (!$user->isCustomer()) {
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

    public function view(User $user, Receipt $model)
    {
        return $user->id == $model->cliente_id;
    }
}
