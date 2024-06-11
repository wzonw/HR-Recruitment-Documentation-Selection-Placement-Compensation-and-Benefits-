<x-admin-layout>
    <div class="flex h-screen">
        <div class="mx-10 my-5">
        <div class="w-[1014px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Daily Time Record</p>
        </div>

        <!-- Date Filter -->
        <form type="get" action=" {{ route('time-keeping-filter') }} " class="w-[1000px] inline-flex mt-5 space-x-3 font-inter justify-center">
            <p>Date:</p>
            <x-input name="date" class="block w-40 h-6 uppercase" type="date" />
            <button type="submit" class="w-20 h-6 bg-blue-600 rounded flex justify-center items-center">
                    <p class="text-white pl-1 font-bold text-xs font font-inter">filter</p>
            </button>
        </form>
        
        @if(session('message'))
        <div class="w-[1000px] mt-5 h-8 flex justify-center italic text-blue-500"
             x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
             x-init="setTimeout(() => show = false, 3000)">
            {{ session('message') }} 
        </div>
        @endif

        <!-- Employee Leave Request Table -->
        <table class="w-[1000px] mt-3 table-fixed shadow border-black border text-sm text-left whitespace-normal rtl:text-right text-gray-500">
            <!-- Header  -->
            <thead class="text-black">
                <tr class="h-10">
                    <th class="w-36 pl-5 border border-black">Employee Name</th>
                    <th class="w-20 text-center border border-black">Date</th>
                    <th class="w-20 text-center border border-black">Absent (days)</th>
                    <th class="w-20 text-center border border-black">Undertime (hrs)</th>
                    <th class="w-20 text-center border border-black">Overtime (hrs)</th>
                    <th class="w-20 text-center border border-black">Late time (hrs)</th>
                    <th class="w-10 text-center">CTO (hrs)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows -->
                <tr class="h-10 border border-black">
                    <td class="w-36 pl-5 border border-black"></td>
                    <td class="w-20 text-center border border-black"></td>
                    <td class="w-20 text-center border border-black"></td>
                    <td class="w-20 text-center border border-black"></td>
                    <td class="w-28 text-center border border-black"></td>
                    <td class="w-28 text-center border border-black"></td>
                    <td class="w-9 text-center border border-black"></td>
                </tr>
                @foreach($data as $data)
                <tr class="h-10 text-black">
                    <td class="w-36 pl-5 border-r border-black">{{$data->first_name}} {{$data->last_name}}</td>
                    <td class="w-20 text-center border-r border-black">{{$data->attendance_date}}</td>
                    <td class="w-20 text-center border-r border-black">{{$data->absent}}</td>
                    <td class="w-20 text-center border-r border-black">{{$data->undertime}}</td>
                    <td class="w-28 text-center border-r border-black">{{$data->overtime}}</td>
                    <td class="w-28 text-center border-r border-black">{{$data->late}}</td>
                    <td class="w-9 text-center border-r border-black">{{$data->cto}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    
</x-admin-layout>