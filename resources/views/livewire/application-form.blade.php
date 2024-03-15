<x-guest-layout>
    <livewire:job-applicant-header />
    <div class="w-screen flex justify-center">
        <div class="w-[500px] h-full bg-slate-100 rounded-xl py-3 my-5 items-center">
            <form method="GET" action="{{ route('landing-page') }}" class="">
                <p class="w-26 h-9 text-indigo-800 text-[28px] text-center font-bold font-inter">Create A New Account</p>
                <div class="mt-3 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="name" value="{{ __('First Name') }}" />
                    <x-input id="name" class="block mt-1 w-88 " type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-88" type="email" name="email" :value="old('email')" required />
                </div>

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
        </div>
    </div>
</x-guest-layout>