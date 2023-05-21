<?php

namespace App\Policies;

use App\Models\Study;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Study $study): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Study $study): bool
    {
    }

    public function delete(User $user, Study $study): bool
    {
    }

    public function restore(User $user, Study $study): bool
    {
    }

    public function forceDelete(User $user, Study $study): bool
    {
    }
}
