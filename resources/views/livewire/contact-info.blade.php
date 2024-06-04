<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Contact Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your contact information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model="state.address" required autocomplete="address" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="mobile" value="{{ __('Mobile Number') }}" />
            <x-input id="mobile" type="text" class="mt-1 block w-full" wire:model.defer="state.mobile" autocomplete="mobile" />
            <x-input-error for="mobile" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

<!--div>
     Button 
    <div wire:click="showModal" wire:loading.attr="disabled" class="inline-flex w-52 items-center px-4 py-2 bg-white border border-gray-400 rounded-md font-medium text-sm text-black font-inter tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer"> 
        Contact Information
    </div>

    <x-modal-profile wire:model="showingModal" >
        
        <x-slot name="title">   
            Contact Information
        </x-slot>


        <x-slot name="content" class="flex">
            <div class="">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-[510px]" type="email" name="email" :value="old('email')" required autofocus />
                </div>
            </div>

            <div class="">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="address" value="{{ __('Address') }}" />
                    <x-input id="address" class="block mt-1 w-[510px]" type="text" name="address" :value="old('address')" required/>
                </div>
            </div>

            <div class="">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="mobilenum" value="{{ __('Mobile Number') }}" />
                    <x-input id="mobilenum" class="block mt-1 w-[510px]" type="text" name="mobilenum" :value="old('mobilenum')" required />
                </div>
            </div>
        </x-slot>


        <x-slot name="footer">
            <div class="space-x-5">
                <button class="inline-flex items-center px-4 py-2 bg-gold-100 border-transparent rounded-md font-medium text-sm text-white font-inter tracking-widest hover:bg-gold focus:bg-gold active:bg-gold focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Save') }}
                </button>
                <x-secondary-button wire:click="$set('showingModal', false)" wire:loading.attr="disabled">
                    {{ __('Cancel')  }}
                </x-secondary-button>
            </div>
        </x-slot>

    </x-modal-profile>

    

</div-->