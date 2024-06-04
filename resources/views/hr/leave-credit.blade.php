<x-admin-layout>
    <div class="px-5 h-screen">
        <div class=" h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Leave Credit</p>
        </div>

        @if(session('message'))
        <div class="mx-5 min-w-max h-8 text-red-700 flex items-end italic"
                x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                x-init="setTimeout(() => show = false, 1500)">
            {{ session('message') }} 
        </div>
        @endif

        <div class="flex flex-wrap justify-center">

            <div class="m-2 w-[500px] rounded-md bg-white shadow shadow-gray-300 hover:bg-gray-100">
                <!-- complete attendance -->
                <a href="{{route('lc-complete-attendance')}}">
                    <div class="text-xl w-full h-full uppercase tracking-widest font-medium px-5 py-5">
                        <p>Complete Attendance</p>
                        <p class="text-sm tracking-wider text-indigo-800 mb-3">leave credit</p>
                    </div>
                </a>
            </div>

            <div class="m-2 w-[500px] rounded-md bg-white shadow shadow-gray-300 px-5 py-5">
                <!-- w/ Absences, Late, Undertime, Overtime -->
                <form action="{{ route('lc-computation') }}" method="post">
                    @csrf
                    <div class="text-xl uppercase tracking-widest font-medium">
                        <p>Summary - computation</p>
                        <p class="text-sm tracking-wider text-indigo-800 mb-3">leave credit</p>
                        <div class="w-full h-full flex flex-wrap justify-center m-3">
                            <x-input id="id" class="w-72 font-bold" type="text" name="id"
                            placeholder="Employee ID" autofocus required/>
                        </div>
                        <div class="flex justify-center">
                            <x-button-gold class="p-2">
                                Compute
                            </x-button-gold>    
                        </div>
                    </div>
                </form>
            </div>

            <div class="m-2 w-[500px] rounded-md bg-white shadow shadow-gray-300 px-5 py-5">
                <!-- w/ Absences, Late, Undertime, Overtime -->
                <form action="{{ route('lc-resignation') }}" method="post">
                    @csrf
                    <div class="text-xl uppercase tracking-widest font-medium">
                        <p>Resignation</p>
                        <p class="text-sm tracking-wider text-indigo-800 mb-3">leave credit</p>
                        <div class="w-full h-full flex flex-wrap justify-center m-3">
                            <x-input id="id" class="block mt-1 w-72 font-bold" type="text" name="id"
                            placeholder="Employee ID" autofocus required/>
                            <x-input id="first_name" class="block mt-1 w-72 font-bold" type="text" name="first_name"
                            placeholder="Employee First Name"/>
                            <x-input id="last_name" class="block mt-1 w-72 font-bold" type="text" name="last_name"
                            placeholder="Employee Last Name"/>
                            <x-input id="vl" class="block mt-1 w-72 font-bold" type="text" name="vl"
                            placeholder="Vacation Leave Credit"/>
                            <x-input id="sl" class="block mt-1 w-72 font-bold" type="text" name="sl"
                            placeholder="Sick Leave Credit"/>
                        </div>
                        <div class="flex justify-center">
                            <x-button-gold class="p-2">
                                Compute
                            </x-button-gold>    
                        </div>
                    </div>
                </form>
            </div>

            <div class="m-2 w-[500px] rounded-md bg-white shadow shadow-gray-300 px-5 py-5">
                <!-- for retirement -->
                <form action="{{ route('lc-retirement') }}" method="get">
                    @csrf
                    <div class="text-xl uppercase tracking-widest font-medium">
                        <p>Retirement</p>
                        <p class="text-sm tracking-wider text-indigo-800 mb-3">leave credit monetization</p>
                        <div class="w-full h-full flex flex-wrap justify-center m-3">
                            <x-input id="id" class="block mt-1 w-72 font-bold" type="text" name="id"
                            placeholder="Employee ID" autofocus required/>
                            <x-input id="name" class="block mt-1 w-72 font-bold" type="text" name="name"
                            placeholder="Employee Name" required/>
                        </div>
                        <div class="flex justify-center">
                            <x-button-gold class="p-2">
                                Compute
                            </x-button-gold>    
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>