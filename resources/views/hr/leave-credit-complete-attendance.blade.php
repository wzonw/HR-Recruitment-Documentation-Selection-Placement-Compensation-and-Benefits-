<x-admin-layout>
    <div class="h-full p-5">
        <div class="p-5 h-14 bg-indigo-800 flex items-center">
            <p class="text-white text-2xl font-bold font-inter">
                Leave Credit <span class="text-lg">(Complete Attendance)</span>
            </p>
        </div>
        
        <div class="w-full h-5/6 mt-5 overflow-auto">
            <form action="{{route('lc-complete-attendance-success')}}" method="post">
                @csrf
                <div class="mt-2 pr-1 flex justify-end">
                    <h1 class="w-5/6 text-xl text-center font-bold">
                        Month: {{date('F Y', strtotime(NOW()))}}
                    </h1>
                    <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                        Save
                    </x-button-gold>
                </div>

                <!-- LC Computation Table -->
                <h1 class="font-semibold">Leave Credit Computation</h1>
                <div class="h-7 flex items-end text-center font-medium text-base">
                    <p class="w-1/4 h-6 overflow-hidden border border-b-0 border-black"></p>
                    <p class="w-1/4 h-6 overflow-hidden border-t border-r border-black">Remaining Leave Credit</p>
                    <p class="w-1/4 h-6 overflow-hidden border-t border-black">Earned Leave Credit</p>
                    <p class="w-1/4 h-6 overflow-hidden border border-b-0 border-black"></p>
                </div>
                <table class="w-full table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                    <!-- Header  -->
                    <thead class="text-black">
                        <tr class="h-10">
                            <th class="w-0.5/8 overflow-hidden text-center border border-black">ID</th>
                            <th class="w-1.5/8 overflow-hidden text-center border border-black">Name</th>
                            <th class="w-1/8 overflow-hidden text-center border border-black">Vacation</th>
                            <th class="w-1/8 overflow-hidden text-center border border-black">Sick</th>
                            <th class="w-1/8 overflow-hidden text-center border border-black">Vacation</th>
                            <th class="w-1/8 overflow-hidden text-center border border-black">Sick</th>
                            <th class="w-1/8 overflow-hidden text-center border border-black">Total VL</th>
                            <th class="w-1/8 overflow-hidden text-center border border-black">Total SL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows -->
                        @foreach($employees as $emp)
                        <tr class="h-10 border border-black text-black">
                            <td class="w-0.5/8 text-center border-r border-black">{{$emp->id}}</td>
                            <td class="w-1.5/8 text-center border-r border-black">{{$emp->name}}</td>
                            <td class="w-1/8 text-center border-r border-black">{{$emp->vl_credit}}</td>
                            <td class="w-1/8 text-center border-r border-black">{{$emp->sl_credit}}</td>
                            <td class="w-1/8 text-center border-r border-black">1.25</td>
                            <td class="w-1/8 text-center border-r border-black">1.25</td>
                            <td class="w-1/8 text-center border-r border-black bg-green-50 font-semibold text-blue-700">
                                <input name="new_vl_{{$emp->id}}" type="number" readonly
                                    value="{{number_format($emp->vl_credit+1.25, 3, '.', '')}}"
                                    class="w-full h-9 text-center text-sm bg-green-50 border-none">
                            </td>
                            <td class="w-1/8 text-center border-r border-black bg-green-50 font-semibold text-blue-700">  
                                <input name="new_sl_{{$emp->id}}" type="number" readonly
                                    value="{{number_format($emp->sl_credit+1.25, 3, '.', '')}}"
                                    class="w-full h-9 text-center text-sm bg-green-50 border-none">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</x-admin-layout>