<x-admin-layout>
    <div class="pt-2 space-y-10">
        <!--Profile-->
        <div class="w-screen inline-flex">
            <div class="relative opacity-30">
                <img class="relative h-36 w-screen object-cover object-top" src="https://plm.edu.ph/images/banners/hero-banner-facade.jpg" />
            </div>
            <div class="absolute px-8 py-14">
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
                                {{ $applicant->name. " ". $applicant->surname }}
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
            </div>
            <div class="absolute end-5 pt-24">
                <p class="w-32 h-9 inline-flex items-center justify-center px-4 py-2 bg-white border 
                border-gray-400 rounded-md font-medium text-sm text-gray-400 font-inter">
                    @if($applicant->remarks == "")
                        Status
                    @else
                        {{ $applicant->remarks }}
                    @endif
                </p>
            </div>
        </div>

        <!-- File Cabinet -->
        <div class="flex">
            <div class="pt-10 px-8">
                <!-- message -->
                @if(session('message'))
                <div class="min-w-max h-8 mx-3 text-blue-600 items-end italic">
                    {{ session('message') }} 
                </div>
                @endif
                <livewire:FileCabinet :applicant="$applicant" />
            </div>
            <div class="mt-14">
                <h1 class="text-indigo-800 text-2xl font-bold font-inter">Application Status</h1>
                <a  onclick="return confirm('Are you sure?')" href="{{route('email-proceed', $applicant->id)}}" 
                    class="inline-flex mt-7 px-3 py-2 items-center justify-center bg-green-700 border border-transparent rounded-md 
                    font-semibold text-xs text-white text-center font-inter uppercase">Proceed</a>
                <a  onclick="return confirm('Are you sure?')" href="{{route('email-reject', $applicant->id)}}" 
                    class="inline-flex mt-7 px-3 py-2 items-center justify-center bg-red-700 border border-transparent rounded-md 
                    font-semibold text-xs text-white text-center font-inter uppercase">Rejected</a>
            </div>
        </div>
    </div>
</x-admin-layout>