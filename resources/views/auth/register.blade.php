<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone Number') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" maxlength="11" oninput="validatePhoneNumber(this)" />
            </div>

            <!-- Payment Method -->
            <div class="mt-4">
                <x-label for="payment_method" value="{{ __('Payment Method') }}" />
                <select id="payment_method" name="payment_method" class="block mt-1 w-full" required>
                    <option value="cashondelivery">{{ __('Cash On Delivery') }}</option>
                    {{-- <option value="easypaisa">{{ __('Easypaisa') }}</option>
                    <option value="mastercard">{{ __('Mastercard') }}</option>
                    <option value="visa">{{ __('Visa') }}</option> --}}
                </select>
            </div>

            <!-- User Type -->
            <div class="mt-4">
                <x-label for="requested_usertype" value="{{ __('Register As') }}" />
                <select id="requested_usertype" name="requested_usertype" class="block mt-1 w-full" required onchange="showAlert(this)">
                    <option value="customer">{{ __('Customer') }}</option>
                    <option value="seller">{{ __('Seller') }}</option>
                    <option value="delivery_agent">{{ __('Delivery Agent') }}</option>
                </select>
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" class="block mt-1 w-full" type="text" placeholder="e.g area name, street name, build name, floor no" name="address" :value="old('address')" required autocomplete="address" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
&nbsp;&nbsp;&nbsp;
                <x-button class="ml-4 btn btn-primary">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <!-- Leaflet JS and CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.9.8/dist/leaflet-search.min.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-search@2.9.8/dist/leaflet-search.min.js"></script>

    <script>
        function showAlert(select) {
            if (select.value === 'seller' || select.value === 'delivery_agent') {
                alert('Please kindly wait for approval from admin.');
            }
        }

        function validatePhoneNumber(input) {
            // Remove all non-digit characters
            input.value = input.value.replace(/\D/g, '');

            // Limit input to 11 characters
            if (input.value.length > 11) {
                input.value = input.value.slice(0, 11);
            }
        }
    </script>
</x-guest-layout>
