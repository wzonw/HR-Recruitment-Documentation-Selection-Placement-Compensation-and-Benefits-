<x-admin-layout>
    <div class="ml-10 mt-5 h-screen">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">
                Leave Credit <span class="text-lg">(Complete Attendance)</span>
            </p>
        </div>
        
        <div class="h-[530px] mt-5 overflow-auto">
            <h1 class="text-xl text-center font-bold">Month: {{date('F Y', strtotime(NOW()))}}</h1>

            <!-- LC Computation Table -->
            <h1 class="font-semibold">Leave Credit Computation</h1>
            <table class="w-[1000px] table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                <!-- Header  -->
                <thead class="text-black">
                    <tr class="h-10">
                        <th class="w-20 text-center border border-black">ID</th>
                        <th class="w-36 text-center border border-black">Name</th>
                        <th class="w-20 text-center border border-black">Vacation</th>
                        <th class="w-20 text-center border border-black">Sick</th>
                        <th class="w-20 text-center border border-black">CTO</th>
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
                        <td class="w-20 text-center border-r border-black">
                            @if($emp->cto == null)
                            @else
                                {{$emp->cto}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>