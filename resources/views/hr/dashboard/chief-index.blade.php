<x-admin-layout>
    <div class="h-screen w-[1111px] pl-2 pt-3 flex flex-wrap">
        <div class="w-[545px]">
            <!-- name, num of emp, num of emp on leave -->
            <div class="w-[545px] h-[246px] bg-white shadow flex">
                <!-- card name -->
                <div class="w-[218px] h-[246px]">
                    <div class="w-[218px] h-32 bg-gradient-to-b from-yellow-600 to-black">
                        <img class=" opacity-25 w-[218px] h-32" src="https://plm.edu.ph/images/news/press-releases/Pamantasa--ng-Lungsod-ng-Maynila-facade.jpg"/>
                    </div>
                    <div class="ml-4 mt-7">
                        <div class="w-48 h-6 text-black text-xl font-semibold font-inter">{{Auth::user()->name.Auth::user()->suffix}}</div>
                        <div class="w-36 h-4 text-neutral-950 text-opacity-50 text-base font-normal font-inter">HR CHIEF</div>
                    </div>
                </div>
                <div class="w-[337px] h-[246px] shadow-inner pl-5 pt-5">
                    <!-- num of employees -->
                    <div class="w-72 h-20 bg-gold-100 rounded-lg shadow flex items-center">
                        <div class="w-48 h-24 pl-5 bg-opacity-0 rounded-lg flex items-center">
                            <p class="w-60 h-12 text-white text-base font-bold font-inter">Total Number of Employees</p>
                        </div>
                        <div class="w-20 h-12 ml-5 bg-gold-200 rounded-lg shadow-md flex items-center">
                            <p class="w-24 h-8 text-center text-white text-2xl font-semibold font-inter">{{$num_employees}}</p>
                        </div>
                    </div>
                    <!-- num of employees on leave -->
                    <div class="w-72 h-20 mt-3 bg-red-700 rounded-lg shadow flex items-center">
                        <div class="w-48 h-24 pl-5 bg-opacity-0 rounded-lg flex items-center">
                            <p class="w-60 h-7 text-white text-base font-bold font-inter">Employees on Leave</p>
                        </div>
                        <div class="w-20 h-12 ml-5 bg-red-800 rounded-lg shadow-md flex items-center">
                            <p class="w-24 h-8 text-center text-white text-2xl font-semibold font-inter">{{$num_onleave}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Employee Leave Request -->
            <div class="w-[545px] h-64 bg-white shadow mt-5 py-5 px-5 ">
                <p class="h-9 text-yellow-600 text-xl font-bold font-inter">
                    Employee Leave Requests
                </p>
                <div class="mt-2">
                    <table class="font-inter text-sm">
                        <thead class="font-bold text-left">
                            <tr>
                                <th class="w-36 pl-3">Name</th>
                                <th class="w-36 text-center">Period</th>
                                <th class="w-32 pl-3">Type</th>
                                <th class="w-24 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaves as $leave)
                            <tr class="border-t h-8 ">
                                <td class="w-36 pl-3">{{$leave->name}}</td>
                                <td class="w-36 text-center">{{$leave->start_date}} - {{$leave->end_date}}</td>
                                <td class="w-32 pl-3">{{$leave->type}}</td>
                                @if(strtolower($leave->remarks) == 'approved')
                                    <td class="w-24 text-center text-green-700">{{$leave->remarks}}</td>
                                @elseif(strtolower($leave->remarks) == 'on hold')
                                    <td class="w-24 text-center text-blue-700">{{$leave->remarks}}</td>
                                @else
                                    <td class="w-24 text-center text-red-700">{{$leave->remarks}}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Jobs Applications -->
        <div class="w-[545px] h-min ml-3 bg-white shadow py-5">
            <div class=" px-5 h-9 text-yellow-600 text-xl font-bold font-inter flex items-center">
                <p>Job Applications</p>
                <button class="text-zinc-500 text-sm font-light font-inter ml-64">View all</button>
            </div>
            <div class="flex flex-wrap overflow-auto">
                @foreach($applications as $application)
                    @if(strtolower($application->remarks) == 'inactive' || strtolower($application->remarks) == 'employee')
                    @else
                        <div class="w-60 min-h-max bg-neutral-100 rounded shadow text-sm mt-4 ml-5 px-2 py-2">
                            <p class="font-bold">{{$application->name}}</p>
                            <p class="text-neutral-400">Applied for 
                                <span class="font-bold text-black">{{$application->college}} {{$application->job_name}}</span>
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        
        <!-- Quicklinks -->
        <div class="w-[1100px] h-[90px] bg-whie shadow pl-5">
            <p class="text-yellow-600 text-base font-bold font-inter">
                Quicklinks
            </p>
            <div>
                <div class="flex">
                    <p class="w-72 text-right text-neutral-950 text-sm font-normal font-inter">
                        PLM Website <span class="pl-3">|</span>
                    </p>
                    <p class="w-36 pl-7 text-left text-yellow-600 text-sm font-normal font-inter ">
                        <a href="https://plm.edu.ph/">plm.edu.ph</a>
                    </p> 
                </div>
                <div class="flex">
                    <p class="w-72 text-right text-neutral-950 text-sm font-normal font-inter">
                        HR Request Form <span class="pl-3">|</span>
                    </p>
                    <p class="w-36 pl-7 text-left text-yellow-600 text-sm font-normal font-inter ">
                        <a href="#">HR Request Form</a>
                    </p> 
                </div>
                <div class="flex">
                    <p class="w-72 text-right text-neutral-950 text-sm font-normal font-inter">
                        PLM Application Site <span class="pl-3">|</span>
                    </p>
                    <p class="w-36 pl-7 text-left text-yellow-600 text-sm font-normal font-inter ">
                        <a href="https://plm.edu.ph/careers-hrdo">Careers</a>
                    </p> 
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>