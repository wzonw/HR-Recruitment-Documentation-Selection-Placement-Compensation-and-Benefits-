<x-admin-layout>
    <div class="ml-10 mt-5 h-screen">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">
                Leave Credit <span class="text-lg">(Complete Attendance)</span>
            </p>
        </div>
        
        <div class="h-[530px] mt-5 overflow-auto">
            <form action="{{route('lc-complete-attendance-success')}}" method="post">
                @csrf
                <div class="flex justify-end">
                    <h1 class="w-[800px] text-xl text-center font-bold">
                        Month: {{date('F Y', strtotime(NOW()))}}
                    </h1>
                    <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                        Save
                    </x-button-gold>
                </div>

                <!-- LC Computation Table -->
                <h1 class="font-semibold">Leave Credit Computation</h1>
                <div class="w-[1000px] h-7 flex items-end text-center font-medium">
                    <p class="w-[348px] h-6 border border-b-0 border-black"></p>
                    <p class="w-[248px] h-6 border-t border-r border-black">Remaining Leave Credit</p>
                    <p class="w-[247px] h-6 border-t border-black">Earned Leave Credit</p>
                    <p class="w-[249px] h-6 border border-b-0 border-black"></p>
                </div>
                <table class="w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                    <!-- Header  -->
                    <thead class="text-black">
                        <tr class="h-10">
                            <th class="w-20 text-center border border-black">ID</th>
                            <th class="w-36 text-center border border-black">Name</th>
                            <th class="w-20 text-center border border-black">Vacation</th>
                            <th class="w-20 text-center border border-black">Sick</th>
                            <th class="w-20 text-center border border-black">Vacation</th>
                            <th class="w-20 text-center border border-black">Sick</th>
                            <th class="w-20 text-center border border-black">Total VL</th>
                            <th class="w-20 text-center border border-black">Total SL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows -->
                        @foreach($employees as $emp)
                        <tr class="h-10 border border-black text-black">
                            <td class="w-20 text-center border-r border-black">{{$emp->employee_id}}</td>
                            <td class="w-36 text-center border-r border-black">{{$emp->first_name}} {{$emp->last_name}}</td>
                            <td class="w-20 text-center border-r border-black">{{$emp->vacation_credits}}</td>
                            <td class="w-20 text-center border-r border-black">{{$emp->sick_credits}}</td>
                            <td class="w-20 text-center border-r border-black">1.25</td>
                            <td class="w-20 text-center border-r border-black">1.25</td>
                            <td class="w-20 text-center border-r border-black bg-green-50 font-semibold text-blue-700">
                                <input name="new_vl_{{$emp->employee_id}}" type="number" readonly
                                    value="{{number_format($emp->vacation_credits+1.25, 3, '.', '')}}"
                                    class="w-24 h-9 text-center text-sm ml-3 bg-green-50 border-none">
                            </td>
                            <td class="w-28 text-center border-r border-black bg-green-50 font-semibold text-blue-700">  
                                <input name="new_sl_{{$emp->employee_id}}" type="number" readonly
                                    value="{{number_format($emp->sick_credits+1.25, 3, '.', '')}}"
                                    class="w-24 h-9 text-center text-sm ml-3 bg-green-50 border-none">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</x-admin-layout>