<div submit="updateProfileInformation">
    <!-- Button -->
    <div wire:click="showModal" wire:loading.attr="disabled" class="inline-flex w-52 items-center px-4 py-2 bg-white border border-gray-400 rounded-md font-medium text-sm text-black font-inter tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer"> 
        Personal Information
    </div>

    <x-modal-profile wire:model="showingModal" >
        
        <x-slot name="title">   
            Personal Information
        </x-slot>


        <x-slot name="content" class="flex">
            <div class="space-x-10">
                <div class="inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="name" value="{{ __('First Name') }}" />
                    <x-input id="name" class="block mt-1 w-48" type="text" name="name" wire:model="state.name" required autofocus />
                </div>
                <div class="inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="gender" value="{{ __('Gender') }}" />
                    <x-input id="gender" class="block mt-1 w-44" type="text" name="gender" required/>
                </div>
            </div>

            <div class="space-x-10">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="middle_name" value="{{ __('Middle Name') }}" />
                    <x-input id="middle_name" class="block mt-1 w-48" type="text" name="middle_name" wire:model="state.middle_name" />
                </div>
                <div class="inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="birthdate" value="{{ __('Date of Birth') }}" />
                    <x-input id="birthdate" class="block mt-1 w-44" type="date" name="birthdate" required/>
                </div>
            </div>

            <div class="space-x-10">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <!--
                    <x-label class="w-22" for="lname" value="{{ __('Last Name') }}" />
                    <x-input id="lname" class="block mt-1 w-48" type="text" name="lname" :value="old('lname')" required />
                    -->
                    <x-label class="w-22" for="surname" value="{{ __('Surname') }}" />
                    <x-input id="surname" type="text" class="mt-1 block w-48" wire:model="state.surnname" required autocomplete="surname" />
                    <x-input-error for="surname" class="mt-2" />
                </div>
                <div class="inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="age" value="{{ __('Age') }}" />
                    <x-input id="age" class="block mt-1 w-44" type="number" name="age" />
                </div>
            </div>

            <div class="space-x-10">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="suffix" value="{{ __('Suffix') }}" />
                    <x-input id="suffix" class="block mt-1 w-48" type="text" name="suffix" />
                </div>
                <div class="inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="placeofbirth" value="{{ __('Place of Birth') }}" />
                    <x-input id="placeofbirth" class="block mt-1 w-44" type="text" name="placeofbirth" />
                </div>
            </div>

            <div class="">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="nationality" value="{{ __('Nationality') }}" />
                    <x-input id="nationality" class="block mt-1 w-[510px]" type="text" name="nationality" />
                </div>
            </div>
            <div class="">
                <div class="mt-4 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-22" for="civilstatus" value="{{ __('Civil Status') }}" />
                    <x-input id="civilstatus" class="block mt-1 w-[510px]  " type="text" name="civilstatus" />
                </div>
            </div>   
        </x-slot>


        <x-slot name="footer">
            <div class="space-x-5">
                <x-button-gold class="px-4 py-2 "  wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button-gold>
                <x-secondary-button wire:click="$set('showingModal', false)" wire:loading.attr="disabled">
                    {{ __('Cancel')  }}
                </x-secondary-button>
            </div>
        </x-slot>

    </x-modal-profile>

    

</div>