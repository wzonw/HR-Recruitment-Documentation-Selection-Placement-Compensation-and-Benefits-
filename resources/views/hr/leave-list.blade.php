<x-admin-layout>
    <div class="ml-10 mt-0 h-screen">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">List of Employees on Leave</p>
        </div>

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
                    <td class="w-36 pl-3">{{ $leave->name }}</td>
                    <td class="w-24 pl-3">{{ $leave->status }}</td>
                    <td class="w-36 pl-3">
                        @if($leave->dept == null)
                            {{ $leave->college }}
                        @else
                            {{ $leave->dept }}
                        @endif
                    </td>
                    <td class="w-28 pl-3">{{ date('d F y', strtotime($leave->start_date)) }}</td>
                    <td class="w-28 pl-3">{{ date('d F y', strtotime($leave->end_date))}}</td>
                    <td class="w-28 pl-3">{{ $leave->type }}</td>
                    <td class="w-32 text-center border-l border-r border-black">
                        <a href="https://www.denr.gov.ph/images/Downloadable_Forms/Revised_Application_for_Leave_2020.pdf">Leave Form</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-admin-layout>