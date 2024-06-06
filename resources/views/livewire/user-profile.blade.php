<!--Profile-->
<div class="justify-center items-center inline-flex space-x-3">
    <!--profile pic-->
    <div class="inline-flex justify-center items-center">
        <div class="relative w-40 h-40 bg-gray-100 rounded-full"></div>
        <div class="absolute w-36 h-36 flex-col justify-center items-center inline-flex">
            <img class="w-36 h-36" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/1024px-Windows_10_Default_Profile_Picture.svg.png" />
        </div>
    </div>
    <div class="inline-flex pt-16">
        <!-- Applicant name, status button -->
        <div class="items-baseline">
            <p class="w-fit min-h-max  text-indigo-800 text-3xl font-bold font-inter">
                {{ $applicant->first_name.' '.$applicant->middle_name.' '.$applicant->last_name }}
            </p>
            <p class="w-20 h-5 text-neutral-950 text-opacity-50 text-base font-normal font-inter">
                Applicant
            </p>
        </div>

        <!-- applicant details(number, email, loc) -->
        <div class="ml-5 space-x-6">
            <div class="ml-3 items-center inline-flex space-x-3">
                <img class="w-6 h-5 relative" src="https://uxwing.com/wp-content/themes/uxwing/download/communication-chat-call/email-envelop-open-icon.png">
                <p class="text-left text-black text-base font-semibold font-inter leading-10">
                    {{ $applicant->email }}
                </p>
            </div>
            <div class="ml-3 items-center inline-flex space-x-3">
                <img class="w-6 h-5 relative" src="https://cdn-icons-png.flaticon.com/512/126/126523.png">
                <p class="text-left text-black text-base font-semibold font-inter leading-10">
                    {{ $applicant->contact_number }}
                </p>
            </div>
            <div class="ml-3 items-center inline-flex space-x-3">
                <img class="w-6 h-5 relative" src="https://cdn-icons-png.flaticon.com/512/535/535239.png">
                <p class="text-left text-black text-base font-semibold font-inter leading-10">
                    {{ $applicant->address }}
                </p>
            </div>
        </div>
    </div>
    
</div>