<x-admin-layout>
    <div class="ml-10 mt-5">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Leave Credit</p>
        </div>

        <div class="mt-5">
            <form action="{{route('leave-computation-save')}}" method="post">
                @csrf
                <input name="id" type="number" value="{{$emp->id}}" readonly hidden>
                <div class="flex items-center">
                    <div class="w-[850px]">
                        <h1>Employee ID: {{$emp->id}}</h1>
                        <h1>Name: {{$emp->name}}</h1>
                    </div>
                    <x-button-gold class="w-28 h-8" onclick="return confirm('Are you sure?')">
                        Save
                    </x-button-gold>
                </div>
                <table class="mt-1 w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                    <!-- Header  -->
                    <thead class="text-black">
                        <tr class="h-10">
                            <th class="w-20 text-center border border-black">VL Credit Used</th>
                            <th class="w-20 text-center border border-black">SL Credit Used</th>
                            <th class="w-20 text-center border border-black">Undertime (hrs)</th>
                            <th class="w-20 text-center border border-black">Late time (hrs)</th>
                            <th class="w-20 text-center border border-black">Absent (days)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows -->
                        <tr class="h-10 border border-black text-black">
                            <td class="w-20 text-center border-r border-black text-red-600">{{$vl_used}}</td>
                            <td class="w-20 text-center border-r border-black text-red-600">{{$sl_used}}</td>
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
                            <td class="w-20 text-center border-r border-black">
                                @if($absent == null)
                                    <p></p>
                                @else
                                    {{$absent}}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

            
                <!-- LC Computation Table -->
                <h1 class="mt-3 font-semibold">Leave Credit Computation</h1>
                <table class="w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                    <!-- Header  -->
                    <thead class="text-black">
                        <tr class="h-10">
                            <th class="w-20 text-center border border-black">VL</th>
                            <th class="w-20 text-center border border-black">SL</th>
                            <th class="w-20 text-center border border-black">Undertime (hrs)</th>
                            <th class="w-20 text-center border border-black">Late time (hrs)</th>
                            <th class="w-20 text-center border border-black">Absent (days)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows -->
                        <tr class="h-10 border border-black text-red-500">
                            <td class="w-20 text-center border-r border-black text-black">{{$vl}}</td>
                            <td class="w-20 text-center border-r border-black text-black">{{$sl}}</td>
                            <td class="w-28 text-center border-r border-black">  
                                @if($undertime == null)
                                    <p></p>
                                @else
                                    - {{number_format($undertime = (float)$undertime * 0.005209, 3, '.', '')}}
                                @endif
                                
                            </td>
                            <td class="w-20 text-center border-r border-black">
                                @if($late == null)
                                    <p></p>
                                @else
                                    - {{number_format($late = (float)$late * 0.005209, 3, '.', '')}}
                                @endif
                            </td>
                            <td class="w-20 text-center border-r border-black"></td>
                        </tr>
                        <tr class="h-10 border border-t-2 border-black text-black bg-green-50">
                            <td class="w-20 text-center border-r border-black text-black font-bold">
                                <input name="new_vl" type="number" readonly
                                    value="{{number_format($vl += - ($undertime + $late + $vl_used), 3, '.', '')}}"
                                    class="w-28 h-8 ml-3 text-center text-sm bg-green-50 border-none">
                            </td>
                            <td class="w-20 text-center border-r border-black text-black font-bold">
                                <input name="new_sl" type="number" readonly
                                    value="{{number_format($sl += - $sl_used, 3, '.', '')}}"
                                    class="w-28 h-8 ml-3 text-center text-sm bg-green-50 border-none">
                            </td>
                            <td class="w-20 text-center border-r border-black"></td>
                            <td class="w-28 text-center border-r border-black"></td>
                            <td class="w-28 text-center border-r border-black"></td>
                        </tr>
                    </tbody>
                </table>

                <!-- CTO Table -->
                <h1 class="mt-3 font-semibold">Compensatory Time Off (Overtime)</h1>
                <table class="w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                    <!-- Header  -->
                    <thead class="text-black">
                        <tr class="h-10">
                            <th class="w-20 text-center border border-black">Remaining CTO</th>
                            <th class="w-20 text-center border border-black">Overtime (hrs)</th>
                            <th class="w-20 text-center border border-black">Equivalent CTO</th>
                            <th class="w-20 text-center border border-black">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows -->
                        <tr class="h-10 border border-black text-black">
                            <td class="w-20 text-center border-r border-black text-black">
                                @if($cto == null)
                                    <p>0.0</p>
                                @else
                                    {{$cto}}
                                @endif
                            </td>
                            <td class="w-28 text-center border-r border-black">
                                @if($overtime == null)
                                    <p></p>
                                @else
                                    {{$overtime}}
                                @endif
                            </td>
                            <td class="w-20 text-center border-r border-black text-black">
                                @if(strtolower($remarks) == 'rest day')
                                    <p>{{$add_cto = $overtime*1.5}}</p>
                                @else
                                    {{$add_cto = $overtime}}
                                @endif
                            </td>
                            <td class="w-20 text-center border-r border-black text-black">{{$remarks}}</td>
                        </tr>
                        <tr class="h-10 border border-t-2 border-black text-black bg-green-50">
                            <td class="w-20 text-center border-r border-black text-black font-bold">
                                <input name="new_cto" type="number" readonly
                                    value="{{number_format($cto += $add_cto, 2, '.', '')}}"
                                    class="w-28 h-8 ml-4 text-center text-sm bg-green-50 border-none">
                            </td>
                            <td class="w-20 text-center border-r border-black"></td>
                            <td class="w-20 text-center border-r border-black"></td>
                            
                            <td class="w-20 text-center border-r border-black"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <!-- LWOP or No enough VL -->
            <h1 class="font-inter mt-3 font-semibold">Salary Deduction (LWOP)</h1>
                <div class="font-inter pl-5 border-b">
                @if($vl < 0)
                    <p> VL Credit: {{number_format($vl, 3, '.', '')}}</p>
                    <p> LC Deduction: {{number_format($undertime + $late, 3, '.', '')}}</p>
                    <p class="text-red-600"> Remaining Balance: {{number_format($lc_deduc = abs($vl), 3, '.', '')}}</p>
                    <p>Equivalent Working Hours: 
                            {{$eqwh = number_format($lc_deduc/0.005208, 2, '.', '')}}
                    </p>

                    <div class="absolute ml-[600px] mt-[-96px]">
                        <p> Salary: {{$salary = 20000}}</p>
                        <p>Hourly Wage = Salary / 176 Hours </p>
                        <p>Hourly Wage = {{$hw = number_format($salary/176, 2, '.', ',')}}</p>
                        
                    </div>

                    <div class="pt-2 pb-3 pl-72">
                        <p>Deduction: hourly wage * EQWH</p>
                        <p class="text-red-600">Deduction: {{number_format($deduction1 = $hw * $eqwh, 2, '.', ',')}}</p>
                    </div>
                @else
                    <div class="pt-2 pb-3 pl-72">
                        <p>Deduction: hourly wage * EQWH</p>
                        <p class="text-red-600">Deduction: {{number_format($deduction1 = 0 * 0, 2, '.', ',')}}</p>
                    </div>
                @endif
                </div>
            

            <!-- Absent no approved leave -->
            <h1 class="font-inter mt-3 font-semibold">Salary Deduction (Absent w/o Approved Leave)</h1>
            <div class="font-inter pl-5 border-b">
                <p> Salary: {{$salary = 20000}}</p>
                <p> Absent: {{$absent}} day(s)</p>

                <div class="pt-2 pb-3 pl-72 ">
                    <p>Deduction = (Monthly Salary/Calendar days) * No. days of absences</p>
                    <p>Deduction = ({{$salary}}/{{NOW()->month()->daysInMonth}}) * {{$absent}}</p>
                    <p class="text-red-600">
                        Deduction = {{number_format($deduction2 = ($salary/NOW()->month()->daysInMonth) * $absent, 2, '.', ',')}}
                    </p>
                </div>
            </div>

            <!-- Total Salary -->
            <h1 class="font-inter mt-3 font-semibold">Salary After Deductions ({{date("F", mktime(0, 0, 0, NOW()->month))}})</h1>
            <div class="font-inter pl-5 border-b">
                <p> Monthly Salary = {{$salary = 20000}}</p>
                <p> Days Worked: {{22-$absent}}</p>
                <p class="text-red-600"> Total Salary Deduction: {{number_format($totalsd = $deduction1 + $deduction2, 2, '.', ',')}}</p>

                <div class="pt-2 pb-3 pl-72 bg-slate-100">
                    <p class="font-bold">Salary: {{number_format($salary - $totalsd, 2, '.', ',')}}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>