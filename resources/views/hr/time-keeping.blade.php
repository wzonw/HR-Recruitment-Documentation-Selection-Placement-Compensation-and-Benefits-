<x-admin-layout>
    <div class="ml-10 mt-5">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Daily Time Record</p>
        </div>

        <!-- Date Filter -->
        <div class="w-[1000px] inline-flex mt-5 space-x-3 font-inter justify-center">
            <p>Date:</p>
            <x-input class="block w-40 h-6 uppercase" type="date" />
            <button type="text" class="w-20 h-6 bg-blue-600 rounded flex justify-center items-center">
                    <p class="text-white pl-1 text-xs font font-inter">filter</p>
                    <svg viewBox="-3 -3 32 32" fill="#ffffff" stroke="#ffffff">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> 
                        <line x1="4" y1="5" x2="16" y2="5" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line>
                        <line x1="4" y1="12" x2="10" y2="12" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> 
                        <line x1="14" y1="12" x2="20" y2="12" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> 
                        <line x1="8" y1="19" x2="20" y2="19" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> 
                        <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="18" cy="5" r="2"> </circle> 
                        <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="12" cy="12" r="2"> </circle> 
                        <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="6" cy="19" r="2">
                    </svg>
            </button>
        </div>

        <!-- Add record btn -->
        <div class="flex justify-end">
            <a href="{{ route('add-dtr') }}" class="inline-flex items-center px-3 py-2 border-0 text-sm leading-4 font-medium rounded-md text-gray-500">
                Add Record
                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>
        
        @if(session('message'))
        <div class="w-[1000px] h-8 flex justify-center italic">
            {{ session('message') }} 
        </div>
        @endif

        <!-- Employee Leave Request Table -->
        <table class="w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
            <!-- Header  -->
            <thead class="text-black">
                <tr class="h-10">
                    <th class="w-36 pl-5 border border-black">Employee Name</th>
                    <th class="w-20 text-center border border-black">Date</th>
                    <th class="w-20 text-center border border-black">Absent (days)</th>
                    <th class="w-20 text-center border border-black">Undertime (hrs)</th>
                    <th class="w-20 text-center border border-black">Overtime (hrs)</th>
                    <th class="w-20 text-center border border-black">Late time (hrs)</th>
                    <th class="w-10 text-center border border-black">LC</th>
                    <th class="w-10"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows -->
                <tr class="h-10 border border-black">
                    <td class="w-36 pl-5 border border-black"></td>
                    <td class="w-20 text-center border border-black"></td>
                    <td class="w-20 text-center border border-black"></td>
                    <td class="w-20 text-center border border-black"></td>
                    <td class="w-28 text-center border border-black"></td>
                    <td class="w-28 text-center border border-black"></td>
                    <td class="w-9 pl-2.5 border border-black"></td>
                    <td class="w-9 pl-2.5">
                        <button type="text" class="w-10 h-6 bg-purple-600 rounded flex justify-center items-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 18C16 16.6667 15.7778 15.5 15.5556 15.3333C15.3333 15.1667 13.7778 15 12 
                            15C10.2222 15 8.66667 15.1667 8.44444 15.3333C8.22222 15.5 8 16.6667 8 18M16 18C16 19.3333 
                            15.7778 20.5 15.5556 20.6667C15.3333 20.8333 13.7778 21 12 21C10.2222 21 8.66667 20.8333 
                            8.44444 20.6667C8.22222 20.5 8 19.3333 8 18M16 18C16 18 19.5 17.75 20 17.5C20.5 17.25 21 
                            .5 21 13.5C21 11.5 20.5 9.75 20 9.5C19.6796 9.33977 18.1268 9.17955 16 9.08514M8 18C8 18 
                            4.5 17.75 4 17.5C3.5 17.25 3 15.5 3 13.5C3 11.5 3.5 9.75 4 9.5C4.32045 9.33977 5.87316 
                            9.17955 8 9.08514M8 9.08514C9.19168 9.03224 10.5636 9 12 9C13.4364 9 14.8083 9.03224 16 
                            9.08514M8 9.08514V7C8 5.22222 8.22222 3.66667 8.44444 3.44444C8.66667 3.22222 10.2222 3 12 
                            3C13.7778 3 15.3333 3.22222 15.5556 3.44444C15.7778 3.66667 16 5.22222 16 7V9.08514" 
                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </td>
                    
                </tr>
                @foreach($data as $data)
                <tr class="h-10 text-black">
                    <td class="w-36 pl-5 border-r border-black">{{$data->name}}</td>
                    <td class="w-20 text-center border-r border-black">{{$data->date}}</td>
                    <td class="w-20 text-center border-r border-black">{{$data->absent}}</td>
                    <td class="w-20 text-center border-r border-black">{{$data->undertime}}</td>
                    <td class="w-28 text-center border-r border-black">{{$data->overtime}}</td>
                    <td class="w-28 text-center border-r border-black">{{$data->late}}</td>
                    <td class="w-9 pl-2.5 border-r border-black"></td>
                    <td class="w-9 pl-2.5"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-admin-layout>