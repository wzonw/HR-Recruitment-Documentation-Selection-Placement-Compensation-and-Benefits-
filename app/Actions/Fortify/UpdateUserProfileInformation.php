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
            'surname' => ['nullable', 'string', 'max:255'], 
            'surname' => ['nullable', 'string', 'min:3', 'max:255'], 
            'suffix' => ['nullable', 'string', 'max:3'],
            'gender' => ['nullable', 'string', 'max:20'], 
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'int', 'max:100'], 
            'place_of_birth' => ['nullable', 'string', 'max:30'],
            'nationality' => ['required', 'string', 'max:30'], 
            'civil_status' => ['required', 'string', 'max:20'], 
            'address' => ['required', 'string', 'max:50'], 
            'mobile' => ['required', 'string', 'max:11'], 
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
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
                'middle_name' => $input['middle_name'],
                'surname' => $input['surname'],
                'suffix' => $input['suffix'],
                'gender' => $input['gender'],
                'birthdate' => $input['birthdate'],
                'age' => $input['age'],
                'place_of_birth' => $input['place_of_birth'],
                'nationality' => $input['nationality'],
                'civil_status' => $input['civil_status'],
                'address' => $input['address'],
                'mobile' => $input['mobile'],
                'email' => $input['email'],
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
            'middle_name' => $input['middle_name'],
            'surname' => $input['surname'], 
            'suffix' => $input['suffix'],
            'gender' => $input['gender'],
            'birthdate' => $input['birthdate'],
            'age' => $input['age'],
            'place_of_birth' => $input['place_of_birth'],
            'nationality' => $input['nationality'],
            'civil_status' => $input['civil_status'],
            'address' => $input['address'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
