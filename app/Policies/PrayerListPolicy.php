<?php

namespace App\Policies;

use App\Models\PrayerList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrayerListPolicy
{
    use HandlesAuthorization;

    public function update(User $user, PrayerList $prayerList)
    {
        return $prayerList->user_id === $user->id;
    }

    public function delete(User $user, PrayerList $prayerList)
    {
        return $prayerList->user_id === $user->id;
    }
}
