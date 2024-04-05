<x-admin-layout>
    <div class="bg-gray-100 w-[1119px]">
        <div class="ml-3 mt-5">
            <div class="w-[1100px] h-14 bg-white rounded-lg shadow-md flex items-center">
                <p class="ml-5 text-cyan-700 text-2xl font-extrabold font-inter">Leave Requests</p>
            </div>

            <div class="mt-5 w-[1100px] min-h-max py-5 bg-white rounded-lg shadow-md flex justify-center">
                <!-- Employee Leave Request Table -->
                <table class="w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                    <!-- Header  -->
                    <thead class="bg-slate-100 text-gray-400">
                        <tr class="h-10">
                        <th class="w-9"> </th>
                        <th class="w-36 pl-3">Employee Name</th>
                        <th class="w-24 pl-3">Status</th>
                        <th class="w-36 pl-3">Department</th>
                        <th class="w-28 pl-3">Date Start</th>
                        <th class="w-28 pl-3">End Start</th>
                        <th class="w-28 pl-3">Leave Type</th>
                        <th class="w-32 text-center border-l border-r border-black">View Leave Form</th>
                        <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows -->
                        @foreach ($leaves as $leave)
                        <tr class="h-10 shadow-sm">
                            <td class="w-9 text-center"><input type="checkbox" name="" id=""></td>
                            <td class="w-36 pl-3">{{ $leave->name }}</td>
                            <td class="w-24 pl-3">{{ $leave->status }}</td>
                            <td class="w-36 pl-3">{{ $leave->college }}</td>
                            <td class="w-28 pl-3">{{ $leave->start_date }}</td>
                            <td class="w-28 pl-3">{{ $leave->end_date }}</td>
                            <td class="w-28 pl-3">{{ $leave->type }}</td>
                            <td class="w-32 text-center border-l border-r border-black">
                                <a href="https://www.denr.gov.ph/images/Downloadable_Forms/Revised_Application_for_Leave_2020.pdf">Leave Form</a>
                            </td>
                            <td class="text-center text-green-500">{{ $leave->remarks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</x-admin-layout>