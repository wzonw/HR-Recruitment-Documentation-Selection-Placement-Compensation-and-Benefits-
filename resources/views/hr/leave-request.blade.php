<x-admin-layout>
    <div class=" flex h-screen">
        <div class="mx-10 my-5">
            <div class="w-[1014px] h-14 mt-5 mb-5 bg-indigo-800 flex items-center">
                <p class="ml-5 text-white text-2xl font-bold font-inter">Leave Requests</p>
            </div>
            <form type="get" action=" {{ url('/compensation/leave/request/lr_search') }} ">
                <div class="w-56 h-9 bg-white rounded border border-gray-400 shadow-md flex justify-center items-center">
                    <button type="submit" class="flex justify-center items-center w-10 h-8 border-none rounded">
                        <img src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg" class="w-10 h-8">
                    </button>
                    <input type="search" name="query" placeholder="Search Employee" class="w-44 h-8 ml-1 border-none rounded" >
                </div>               
            </form>

            @if(session('message'))
            <div class="pl-5 min-w-max h-8 text-blue-600 flex items-end italic"
                x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                x-init="setTimeout(() => show = false, 3000)">
                {{ session('message') }} 
            </div>           
            @endif
             
            <div class="w-[1014px] h-screen overflow-y-auto">
                <!-- For HR Chief Only -->
                <div class="flex justify-end py-2 mr-1">
                    <a href="{{route('leave-request-not-hr')}}">
                        <x-button-blue class="w-28">
                            Outside HR
                        </x-button-blue>    
                    </a>   
                </div>

                <!-- Employee Leave Request Table -->
                <table class="w-full mb-5 table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                    <!-- Header  -->
                    <thead class="bg-slate-100 text-gray-400">
                        <tr class="h-10">
                            <th class="w-36 pl-3">Employee Name</th>
                            <th class="w-24 pl-3">Status</th>
                            <th class="w-36 pl-3">Department</th>
                            <th class="w-28 pl-3">Date Start</th>
                            <th class="w-28 pl-3">End Start</th>
                            <th class="w-28 pl-3">Leave Type</th>
                            <th class="w-28 text-center border-l border-r border-black">View Leave Form</th>
                            <th class="w-32"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows -->
                        @foreach ($leaves as $leave)
                        <tr class="h-10 shadow-sm text-black">
                            <!-- for hr chief -->
                            <td class="w-36 pl-3 hover:text-gray-400">
                                <a href="{{route('leave-request-id', [$leave->emp_id, $leave->type])}}">{{ $leave->first_name }} {{ $leave->last_name }}</a>
                            </td>
                            <!-- for compe 
                            <td class="w-36 pl-3">{{ $leave->first_name }} {{ $leave->last_name }}</td>
                            -->
                            <td class="w-24 pl-3">{{ $leave->status }}</td>
                            <td class="w-36 pl-3">{{ $leave->college }}</td>
                            <td class="w-28 pl-3">{{ date('d M Y', strtotime($leave->start_date)) }}</td>
                            <td class="w-28 pl-3">{{ date('d M Y', strtotime($leave->end_date)) }}</td>
                            <td class="w-28 pl-3 uppercase">{{ $leave->type }}</td>
                            <td class="w-28 text-center border-l border-r border-black">
                                <a href="https://www.denr.gov.ph/images/Downloadable_Forms/Revised_Application_for_Leave_2020.pdf">Leave Form</a>
                            </td>
                            <td class="text-center uppercase">
                                @if(strtolower($leave->remarks) == 'approved')
                                    <p class="text-green-600">{{ $leave->remarks }}</p>
                                @elseif(strtolower($leave->remarks) == 'authorized')
                                    <p class="text-blue-600">{{ $leave->remarks }}</p>
                                @else
                                    <p class="text-red-600">{{ $leave->remarks }}</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</x-admin-layout>