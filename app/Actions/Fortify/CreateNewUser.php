<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'requested_usertype' => ['required', 'in:customer,seller,delivery_agent,admin'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:11'],
            'payment_method' => ['required', 'in:easypaisa,visa,mastercard,cashondelivery,jasscash'],
            'address' => 'required|string|max:255',
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'requested_usertype' => $input['requested_usertype'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'payment_method' => $input['payment_method'],
            'address' => $input['address'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
