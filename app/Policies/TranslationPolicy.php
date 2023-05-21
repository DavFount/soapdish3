<?php

namespace App\Policies;

use App\Models\Translation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TranslationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin;
    }

    public function view(User $user)
    {
        return $user->isAdmin;
    }

    public function create(User $user)
    {
        return $user->isAdmin;
    }

    public function update(User $user)
    {
        return $user->isAdmin;
    }

    public function delete(User $user)
    {
        return $user->isAdmin;
    }
}
