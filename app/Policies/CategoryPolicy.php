<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'create');
    }

    public function update(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'update');
    }

    public function delete(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'delete');
    }
}
