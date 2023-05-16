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
        return $user?->email === 'savsin64@gmail.com';
    }

    public function view(User $user, Translation $translation)
    {
        return $user?->email === 'savsin64@gmail.com';
    }

    public function create(User $user)
    {
        return $user?->email === 'savsin64@gmail.com';
    }

    public function update(User $user)
    {
        return $user?->email === 'savsin64@gmail.com';
    }

    public function delete(User $user)
    {
        return $user?->email === 'savsin64@gmail.com';
    }

    public function restore(User $user)
    {
        return $user?->email === 'savsin64@gmail.com';
    }

    public function forceDelete(User $user)
    {
        return $user?->email === 'savsin64@gmail.com';
    }
}
