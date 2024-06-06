
<div class="font-inter">
    <!--Success message-->
    @if(session('message') == 'Successfully updated.')
    <div class="w-full h-8 mx-3 text-green-600 items-end italic"
        x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
        x-init="setTimeout(() => show = false, 1500)">
        {{ session('message') }} 
    </div>
    @else <!--ongoing application message-->
    <div class="w-full min-h-max mx-3 text-red-500 items-end italic"
        x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
        x-init="setTimeout(() => show = false, 3000)">
        {{ session('message') }}
    </div>
    @endif

    <form action="{{route('personal-info-success')}}" method="post">
        @csrf

        <input type="text" value="{{Auth::user()->id}}" id="id" name="id" hidden>
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="first_name" value="{{ __('First Name') }}" />
            <x-input id="first_name" type="text" class="mt-1 block w-full" name="first_name" required autocomplete="first_name" />
            <x-input-error for="first_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="middle_name" value="{{ __('Middle Name') }}" />
            <x-input id="middle_name" type="text" class="mt-1 block w-full" name="middle_name" autocomplete="middle_name" />
            <x-input-error for="middle_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="last_name" value="{{ __('Last Name') }}" />
            <x-input id="last_name" type="text" class="mt-1 block w-full" name="last_name" required autocomplete="last_name" />
            <x-input-error for="last_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="suffix" value="{{ __('Suffix') }}" />
            <x-input id="suffix" type="text" class="mt-1 block w-full" name="suffix" autocomplete="suffix" />
            <x-input-error for="suffix" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="gender" value="{{ __('Gender (enter x if prefer not to say)') }}" />
            <x-input id="gender" type="text" class="mt-1 block w-full" name="gender" required autocomplete="gender" />
            <x-input-error for="gender" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="birthdate" value="{{ __('Birthdate') }}" />
            <x-input id="birthdate" type="date" class="mt-1 block w-full" name="birthdate" required />
            <x-input-error for="birthdate" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="age" value="{{ __('Age') }}" />
            <x-input id="age" type="text" class="mt-1 block w-full" name="age" required autocomplete="age" />
            <x-input-error for="age" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="religion" value="{{ __('Religion') }}" />
            <x-input id="religion" type="text" class="mt-1 block w-full" name="religion" required autocomplete="religion" />
            <x-input-error for="religion" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="civil_status" value="{{ __('Civil Status') }}" />
            <x-input id="civil_status" type="text" class="mt-1 block w-full" name="civil_status" required autocomplete="civil_status" />
            <x-input-error for="civil_status" class="mt-2" />
        </div>


        <!-- Email -->
        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="email" value="{{ __('Personal Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" name="email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Contact -->
        <div class="col-span-6 sm:col-span-4 mt-14 mb-2">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" name="address" required autocomplete="address" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 my-2">
            <x-label for="mobile" value="{{ __('Mobile Number') }}" />
            <x-input id="mobile" type="text" class="mt-1 block w-full" name="mobile" required/>
            <x-input-error for="mobile" class="mt-2" />
        </div> 

        <div class="my-2">
            <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                Update
            </x-button-gold>
        </div>
    </form>
    
</div>
