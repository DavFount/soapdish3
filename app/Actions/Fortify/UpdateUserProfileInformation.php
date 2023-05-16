<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['NULLABLE', 'mimes:jpg,jpeg,png', 'max:1024'],
            'title' => ['nullable', 'string', 'max:150'],
            'language_id' => ['nullable', Rule::exists('languages', 'id')],
            'translation_id' => ['nullable', Rule::exists('translations', 'id')],
            'description' => ['nullable', 'string', 'max:150'],
            'facebook' => ['nullable', 'string', 'min:5', 'max:50'],
            'twitter' => ['nullable', 'string', 'min:4', 'max:15'],
            'instagram' => ['nullable', 'string', 'min:5', 'max:30'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'title' => $input['title'],
                'description' => $input['description'],
                'language_id' => $input['language_id'],
                'translation_id' => $input['translation_id'],
                'facebook' => $input['facebook'],
                'twitter' => $input['twitter'],
                'instagram' => $input['instagram'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
