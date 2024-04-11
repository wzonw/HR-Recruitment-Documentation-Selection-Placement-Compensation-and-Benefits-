<x-admin-layout>
    <div class="h-screen">
        <div class="ml-10 mt-5">
            <div class="w-[1000px] h-14 mt-5 mb-5 bg-indigo-800 flex items-center">
                <p class="ml-5 text-white text-2xl font-bold font-inter">Leave Requests</p>
            </div>
            <form type="get" action=" {{ url('/compensation/leave/request/lr_search') }} ">
                <div class="w-56 h-9 bg-white rounded border border-gray-400 shadow-md flex justify-center items-center">
                    <button type="submit" class="flex justify-center items-center w-10 h-8 border-none rounded">
                        <img src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg" class="w-10 h-8">
                    </button>
                    <input type="search" name="query" placeholder="Search Employee" class="w-44 h-8 ml-1 border-none rounded" >
                </div>               
            </form>

            <form action="{{route('leave-request-success', $req->emp_id)}}" method="post" class="py-3">
                @csrf
                <div class="mt-0 w-[1100px] min-h-max py-5 bg-white rounded-lg shadow-md  justify-center">
                    <div class="mb-3 pr-12 flex justify-end h-8 text-black text-base text-left font-normal font-inter">
                        <div class="inline-flex justify-center items-center space-x-2 mr-5">
                            <x-label class="w-24" for="id" value="{{ __('Employee ID') }}" />
                            <x-input id="id" class="block mt-1 w-24 h-8 text-gray-500" type="text" name="id" value="{{$req->emp_id}}" readonly />
                        </div>
                        <div class="justify-center items-center space-x-2 mr-5 hidden">
                            <x-label class="w-24" for="type" value="{{ __('Type') }}" />
                            <x-input id="type" class="block mt-1 w-24 h-8 text-gray-500" type="text" name="type" value="{{$req->type}}" readonly />
                        </div>
                        <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                            Save
                        </x-button-gold>    
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
                                <th class="w-32 text-center border-l border-r border-black">View Leave Form</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows -->
                            @foreach ($leaves as $leave)
                            <tr class="h-10 shadow-sm text-black">
                                <td class="w-36 pl-3 hover:text-gray-400">
                                    <a href="{{route('leave-request-id', [$leave->emp_id, $leave->type])}}">{{ $leave->name }}</a>
                                </td>
                                <td class="w-24 pl-3">{{ $leave->status }}</td>
                                <td class="w-36 pl-3">{{ $leave->college }}</td>
                                <td class="w-28 pl-3">{{ $leave->start_date }}</td>
                                <td class="w-28 pl-3">{{ $leave->end_date }}</td>
                                <td class="w-28 pl-3 uppercase">{{ $leave->type }}</td>
                                <td class="w-32 text-center border-l border-r border-black">
                                    <a href="https://www.denr.gov.ph/images/Downloadable_Forms/Revised_Application_for_Leave_2020.pdf">Leave Form</a>
                                </td>
                                <td class="text-center uppercase">
                                    @if($leave->remarks == null && $req->emp_id == $leave->emp_id && $req->type == $leave->type)
                                    <select name="remarks" id="remarks" class="uppercase text-sm border-none" autofocus>
                                        <option value="approved" class="text-green-600">approved</option>
                                        <option value="denied" class="text-red-600">denied</option>
                                    </select>
                                    @else
                                        @if(strtolower($leave->remarks) == 'approved')
                                            <p class="text-green-600">{{ $leave->remarks }}</p>
                                        @else
                                            {{ $leave->remarks }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        
    </div>
    
</x-admin-layout>