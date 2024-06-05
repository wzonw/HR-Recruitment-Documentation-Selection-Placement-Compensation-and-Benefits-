<x-admin-layout>
    <div class="h-full  ">
        <div class="mx-10 my-5">
            <div class="w-full h-14 mt-5 mb-5 bg-indigo-800 flex items-center">
                <p class="ml-5 mr-5 text-white text-2xl font-bold font-inter">Leave Requests (Outside HR)</p>
            </div>
            <form type="get" action="">
                <div class="w-56 h-9 bg-white rounded border border-gray-400 shadow-md flex justify-center items-center">
                    <button type="submit" class="flex justify-center items-center w-10 h-8 border-none rounded">
                        <img src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg" class="w-10 h-8">
                    </button>
                    <input type="search" name="query" placeholder="Search Employee" class="w-44 h-8 ml-1 border-none rounded" >
                </div>               
            </form>

            <form action="{{route('leave-request-not-hr-success')}}" method="post" class="py-3">
                @csrf
                <div class="w-full h-screen pt-2 pb-5 bg-white rounded-lg shadow-md  justify-center">
                    <div class="mb-3 pr-6 flex justify-end h-8 text-black text-base text-left font-normal font-inter">
                        <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                            Save
                        </x-button-gold>    
                    </div>
                    <div class="max-h-[575px] overflow-y-auto ">
                        <!-- Employee Leave Request Table -->
                        <table class="mx-6 table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                            <!-- Header  -->
                            <thead class="bg-slate-100 text-gray-400">
                                <tr class="h-10">
                                    <th class="w-36 pl-3">Employee Name</th>
                                    <th class="w-24 pl-3">Status</th>
                                    <th class="w-36 pl-3">Department</th>
                                    <th class="w-28 pl-3">Date Start</th>
                                    <th class="w-28 pl-3">End Start</th>
                                    <th class="w-28 pl-3">Leave Type</th>
                                    <th class="w-32 text-center border-l border-r border-black">View Leave Form</th>
                                    <th class="w-32"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows -->
                                @foreach ($leaves as $leave)
                                <tr class="h-10 shadow-sm text-black">
                                    <td class="w-36 pl-3 hover:text-gray-400">
                                        <a href="{{route('leave-request-id', [$leave->employee_id, $leave->type_of_leave])}}">{{ $leave->first_name }} {{ $leave->last_name }}</a>
                                    </td>
                                    <td class="w-24 pl-3">{{ $leave->status }}</td>
                                    <td class="w-36 pl-3">{{ $leave->college }}</td>
                                    <td class="w-28 pl-3">{{ date('d M Y', strtotime($leave->inclusive_start_date)) }}</td>
                                    <td class="w-28 pl-3">{{ date('d M Y', strtotime($leave->inclusive_end_date)) }}</td>
                                    <td class="w-28 pl-3 uppercase">{{ $leave->type_of_leave }}</td>
                                    <td class="w-32 text-center border-l border-r border-black">
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
            </form>
        </div> 
    </div>
    
</x-admin-layout>