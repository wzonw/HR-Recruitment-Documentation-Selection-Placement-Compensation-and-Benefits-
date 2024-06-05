<x-admin-layout>
    <div class="flex h-screen">
        <div class="mx-10 my-5">
        <div class="w-[1014px] h-14 mt-5 mb-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">List of Employees on Leave</p>
        </div>
        <form type="get" action=" {{ url('/compensation/leave/list/leave_search') }} ">
            <div class="w-56 h-9 bg-white rounded border border-gray-400 shadow-md flex justify-center items-center">
                <button type="submit" class="flex justify-center items-center w-10 h-8 border-none rounded">
                    <img src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg" class="w-10 h-8">
                </button>
                <input type="search" name="query" placeholder="Search Employee" class="w-44 h-8 ml-1 border-none rounded" >
            </div>               
        </form>

        <!-- Employee Leave Request Table -->
        <table class="w-[1000px] mt-5 table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
            <!-- Header  -->
            <thead class="bg-slate-100 text-gray-400">
                <tr class="h-10">
                <th class="w-36 pl-3">Employee Name</th>
                <th class="w-24 pl-3">Status</th>
                <th class="w-36 pl-3">Department</th>
                <th class="w-28 pl-3">Date Start</th>
                <th class="w-28 pl-3">End Start</th>
                <th class="w-28 pl-3">Leave Type</th>
                <th class="w-32 pl-3 border-l border-gray-500">View Leave Form</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows -->
                @foreach ($leaves as $leave)
                <tr class="h-10 shadow-sm">
                    <td class="w-36 pl-3">{{ $leave->first_name }} {{ $leave->last_name }}</td> 
                    <td class="w-24 pl-3">{{ $leave->status }}</td>
                    <td class="w-36 pl-3">
                        @if($leave->dept == null)
                            {{ $leave->college }}
                        @else
                            {{ $leave->dept }}
                        @endif
                    </td>
                    <td class="w-28 pl-3">{{ date('d F y', strtotime($leave->inclusive_start_date)) }}</td>
                    <td class="w-28 pl-3">{{ date('d F y', strtotime($leave->inclusive_end_date))}}</td>
                    <td class="w-28 pl-3">{{ $leave->type_of_leave }}</td>
                    <td class="w-32 text-center border-l border-r border-black">
                        <a href="https://www.denr.gov.ph/images/Downloadable_Forms/Revised_Application_for_Leave_2020.pdf">Leave Form</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    
</x-admin-layout>