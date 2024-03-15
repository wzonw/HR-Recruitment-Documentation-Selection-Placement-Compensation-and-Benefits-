<x-admin-layout>
    <div class="ml-10 mt-5">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Leave Credit</p>
        </div>

        <div class="mt-5">
            <h1>Employee ID: {{$emp->id}}</h1>
            <h1>Name: {{$emp->name}}</h1>
            <table class="mt-1 w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                <!-- Header  -->
                <thead class="text-black">
                    <tr class="h-10">
                        <th class="w-20 text-center border border-black">VL</th>
                        <th class="w-20 text-center border border-black">SL</th>
                        <th class="w-20 text-center border border-black">Absent (days)</th>
                        <th class="w-20 text-center border border-black">Overtime (hrs)</th>
                        <th class="w-20 text-center border border-black">Undertime (hrs)</th>
                        <th class="w-20 text-center border border-black">Late time (hrs)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows -->
                    <tr class="h-10 border border-black text-black">
                        <td class="w-20 text-center border-r border-black">15.0</td>
                        <td class="w-20 text-center border-r border-black text-black">15.0</td>
                        <td class="w-20 text-center border-r border-black">
                            @if($absent == null)
                                <p></p>
                            @else
                                {{$absent}}
                            @endif
                        </td>
                        <td class="w-28 text-center border-r border-black">
                            @if($overtime == null)
                                <p></p>
                            @else
                                {{$overtime}}
                            @endif
                        </td>
                        <td class="w-28 text-center border-r border-black">
                            @if($undertime == null)
                                <p></p>
                            @else
                                {{$undertime}}
                            @endif
                        </td>
                        <td class="w-20 text-center border-r border-black">
                            @if($late == null)
                                <p></p>
                            @else
                                {{$late}}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 class="mt-3 font-semibold">Leave Credit Computation</h1>

            <table class="w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                <!-- Header  -->
                <thead class="text-black">
                    <tr class="h-10">
                        <th class="w-20 text-center border border-black">VL</th>
                        <th class="w-20 text-center border border-black">SL</th>
                        <th class="w-20 text-center border border-black">Absent (days)</th>
                        <th class="w-20 text-center border border-black">Overtime (hrs)</th>
                        <th class="w-20 text-center border border-black">Undertime (hrs)</th>
                        <th class="w-20 text-center border border-black">Late time (hrs)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows -->
                    <tr class="h-10 border border-black text-red-500">
                        <td class="w-20 text-center border-r border-black text-black">15.0</td>
                        <td class="w-20 text-center border-r border-black text-black">15.0</td>
                        <td class="w-20 text-center border-r border-black">
                            
                            
                        </td>
                        <td class="w-28 text-center border-r border-black">
                            @if($overtime == null)
                                <p></p>
                            @else
                                - {{$overtime = number_format((float)$overtime * 0.0052, 3, '.', '')}}
                            @endif
                        </td>
                        <td class="w-28 text-center border-r border-black">  
                            @if($undertime == null)
                                <p></p>
                            @else
                                - {{$undertime = number_format((float)$undertime * 0.0052, 3, '.', '')}}
                            @endif
                            
                        </td>
                        <td class="w-20 text-center border-r border-black">
                            @if($late == null)
                                <p></p>
                            @else
                                - {{$late = number_format((float)$late * 0.0052, 3, '.', '')}}
                            @endif
                        </td>
                    </tr>
                    <tr class="h-10 border border-t-2 border-black text-black bg-green-50">
                        <td class="w-20 text-center border-r border-black text-black font-bold">
                            {{15.0 - ($undertime + $late)}}
                        </td>
                        <td class="w-20 text-center border-r border-black text-black font-bold">15.0</td>
                        <td class="w-20 text-center border-r border-black"></td>
                        <td class="w-28 text-center border-r border-black"></td>
                        <td class="w-28 text-center border-r border-black"></td>
                        <td class="w-20 text-center border-r border-black"></td>
                    </tr>
                </tbody>
            </table>

            <h1 class="font-inter mt-3 font-semibold">Salary Deduction</h1>
            <div class="font-inter pl-5">
                <p> Salary: {{$salary = 20000}}</p>
                <p> Absent: {{$absent}}</p>
            </div>
        </div>
    </div>
</x-admin-layout>