<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'requested_usertype' => ['required', 'in:customer,seller,delivery_agent,admin'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:11'],
            'payment_method' => ['required', 'in:easypaise,visa,mastercard,cashondelivery,jazzcash'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $updatedData = [
            'name' => $input['name'],
            'requested_usertype' => $input['requested_usertype'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'payment_method' => $input['payment_method'],
            'address' => $input['address'],
        ];

        if ($input['email'] !== $user->email) {
            $updatedData['email_verified_at'] = null;
            $user->forceFill($updatedData)->save();
            $user->sendEmailVerificationNotification();
        } else {
            $user->forceFill($updatedData)->save();
        }
    }
}
