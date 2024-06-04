<x-guest-layout>
    <x-authentication-card-reg>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="">
            @csrf
            <p class="w-26 h-9 text-indigo-800 text-[28px] text-center font-bold font-inter">Create A New Account</p>
            <div class="mt-3 inline-flex justify-center items-center space-x-2">
                <x-label class="w-24" for="name" value="{{ __('First Name') }}" />
                <x-input id="name" class="block mt-1 w-88 " type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4 inline-flex justify-center items-center space-x-2">
                <x-label class="w-24" for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-88" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4 inline-flex justify-center items-center space-x-2">
                <x-label class="w-24" for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-88" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4 inline-flex justify-center items-center space-x-2">
                <x-label class="w-24" for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-88" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex justify-center pt-4">
                <x-button-blue class="ms-4 w-40 h-10">
                    {{ __('Create') }}
                </x-button-blue>
            </div>
            <div class="flex justify-center mt-4 pl-5">
                <a class="underline text-center w-48 text-base text-blue-900 font-medium hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already Have an Account?') }}
                </a>
            </div>
        </form>
    </x-authentication-card-reg>
</x-guest-layout>
