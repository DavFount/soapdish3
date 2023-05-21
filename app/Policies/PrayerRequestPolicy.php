<?php

namespace App\Policies;

use App\Models\PrayerRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrayerRequestPolicy
{
    use HandlesAuthorization;

    public function view(User $user, PrayerRequest $prayerRequest): bool
    {
        return $user->current_team_id === $prayerRequest->team_id;
    }
    public function update(User $user, PrayerRequest $prayerRequest): bool
    {
        return $user->id === $prayerRequest->user_id;
    }

    public function delete(User $user, PrayerRequest $prayerRequest): bool
    {
        return $user->id === $prayerRequest->user_id || $user->hasTeamPermission($prayerRequest->team, 'delete');
    }
}
