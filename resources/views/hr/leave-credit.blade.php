<x-admin-layout>
    <div class="ml-10 mt-5 h-screen">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Leave Credit</p>
        </div>

        @if(session('message'))
        <div class="mx-5 min-w-max h-8 text-red-700 flex items-end italic"
                x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                x-init="setTimeout(() => show = false, 1500)">
            {{ session('message') }} 
        </div>
        @endif

        <div class="w-[1000px] bg-slate-100 rounded-xl my-3 py-5 flex justify-center font-inter text-base">
            <div class="w-[420px] flex flex-wrap justify-center border-r border-black">
                <p>For Employees w/ Complete Attendance</p>
                <a href="{{route('lc-complete-attendance')}}">
                    <x-button-gold class="w-56 h-12 py-2">
                        Compute Earned Leave Credits
                    </x-button-gold>
                </a>
            </div>
            <form action="{{ route('lc-computation') }}" method="post">
                @csrf
                <div class="w-[450px] ml-5 flex flex-wrap justify-center">
                    <p>For Employees w/ Absences, Late, Undertime, Overtime</p>
                    <div class="mt-2 mx-12">
                        <x-input id="id" class="block mt-1 w-72 font-bold" type="text" name="id"
                        placeholder="Employee ID" autofocus/>
                    </div>
                    <div class="mt-2 mx-12 min-h-max flex justify-center">
                        <x-button-gold class="w-28 mt-2">
                            Apply
                        </x-button-gold>
                    </div>
                </div>
            </form>
        </div>

        
    </div>
</x-admin-layout>