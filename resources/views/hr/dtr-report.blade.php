<x-admin-layout>
    <div class="h-screen p-10">
        <div class="h-14 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Daily Time Record</p>
        </div>

        @if(session('message'))
        <div class="w-[1000px] h-8 mt-5 flex justify-center italic text-blue-500"
             x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
             x-init="setTimeout(() => show = false, 3000)">
            {{ session('message') }} 
        </div>
        @endif

        <div class="flex justify-center py-5 space-x-10">
            <a href="{{ route('dtr-report-full-time',  30) }}">
                <div class="w-[450px] h-fit rounded-md shadow shadow-gray-300 p-5 hover:bg-gray-200">
                    <div class="text-xl uppercase tracking-widest font-medium">
                        <div class="flex">
                            <p class="w-96">Full time</p>
                            <p class="w-full ml-5 normal-case font-normal text-right text-sm tracking-normal text-gray-400">
                                Every 15th & 30th day
                            </p>  
                        </div>
                        <p class="text-sm tracking-wider text-indigo-800">DTR Report</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('dtr-report-part-time', NOW()->day) }}">
                <div class="w-[450px] h-fit rounded-md shadow shadow-gray-300 p-5 hover:bg-gray-200">
                    <div class="text-xl uppercase tracking-widest font-medium">
                        <div class="flex">
                            <p class="w-96">Part time</p>
                            <p class="w-full ml-5 normal-case font-normal text-right text-sm tracking-normal text-gray-400">
                                Every 30th day
                            </p>  
                        </div>
                        <p class="text-sm tracking-wider text-indigo-800">DTR Report</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
</x-admin-layout>