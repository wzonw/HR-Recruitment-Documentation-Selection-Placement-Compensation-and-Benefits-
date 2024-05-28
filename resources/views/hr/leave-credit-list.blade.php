<x-admin-layout>
    <div class="h-full p-5">
        <div class="p-5 h-14 bg-indigo-800 flex items-center">
            <p class="text-white text-2xl font-bold font-inter">
                Leave Credit <span class="text-lg">(Complete Attendance)</span>
            </p>
        </div>
        
        <div class="w-full h-5/6 mt-5 overflow-auto">
            <h1 class="text-xl text-center font-bold">Month: {{date('F Y', strtotime(NOW()))}}</h1>

            <!-- LC Computation Table -->
            <h1 class="font-semibold">Leave Credit Computation</h1>
            <table class="w-full table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
                <!-- Header  -->
                <thead class="text-black">
                    <tr class="h-10">
                        <th class="w-5 text-center border border-black">ID</th>
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
                        <td class="w-5 text-center border-r border-black">{{$emp->id}}</td>
                        <td class="w-36 text-center border-r border-black">{{$emp->name}}</td>
                        <td class="w-20 text-center border-r border-black">{{$emp->vl_credit}}</td>
                        <td class="w-20 text-center border-r border-black">{{$emp->sl_credit}}</td>
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