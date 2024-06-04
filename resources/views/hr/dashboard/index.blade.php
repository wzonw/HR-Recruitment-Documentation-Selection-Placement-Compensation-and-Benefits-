<x-admin-layout>
    <div class="h-auto font-inter flex flex-wrap px-3">
        <div class="w-full h-4/5 flex flex-wrap py-2">
            <div class="w-[555px] h-[430px]">
                <div class="h-1/2 flex">
                    <!-- Profile -->
                    <div class="w-1/3 h-full shadow-md">
                        <div class="h-1/2">
                            <div class="relative">
                                <div class="h-1/4 bg-gradient-to-b from-yellow-600 to-white">
                                    <img class=" opacity-20 " src="https://www.plm.edu.ph/images/banners/2020-PLM-facade.jpg"/>
                                </div>
                                <div class="absolute w-full top-1/2 flex justify-center">
                                    <div class="w-fit h-1/4  rounded-full flex justify-center items-center">
                                        <div class="w-1/2 h-1/2 px-2 py-2 bg-zinc-300 rounded-full">
                                            <img class="w-auto h-auto" src="https://www.plm.edu.ph/images/Seal/PLM_Seal_BOR-approved_2014.png" />
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="h-1/2 py-7 px-3">
                            <div>
                                <!-- user's name -->
                                <p class="text-black text-base font-semibold"> NAME </p>
                                <p class="text-neutral-950 text-opacity-50 text-sm font-normal">Administrator</p>
                                <!-- user's section -->
                                <div class="text-black text-sm font-semibold">Section : HR Section</div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Num of requests -->
                    <div class="w-3/4 h-full px-3">
                        <div class="h-full overflow-auto">
                            <div class="h-1/3 py-1">
                                <div class="h-full bg-yellow-600 rounded-lg shadow flex items-center">
                                    <div class="w-3/4 rounded-lg flex items-center">
                                        <p class="h-1/2 pl-5 text-white text-base font-bold font-inter">Employee Document Requests</p>
                                    </div>
                                    <div class="w-1/4 h-3/4 bg-yellow-700 rounded-lg shadow-md flex justify-center items-center">
                                        <p class="h-8 text-center text-white text-2xl font-semibold font-inter">{{$num_reqs}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="h-1/3 py-1">
                                <div class="h-full bg-indigo-600 rounded-lg shadow flex items-center">
                                    <div class="w-3/4 rounded-lg flex items-center">
                                        <p class="h-1/2 pl-5 text-white text-lg font-bold font-inter">Current Applicants</p>
                                    </div>
                                    <div class="w-1/4 h-3/4 bg-indigo-700 rounded-lg shadow-md flex justify-center items-center">
                                        <p class="h-8 text-center text-white text-2xl font-semibold font-inter">{{$num_applicants}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="h-1/3 py-1">
                                <div class="h-full bg-red-600 rounded-lg shadow flex items-center">
                                    <div class="w-3/4 rounded-lg flex items-center">
                                        <p class="h-1/2 pl-5 text-white text-lg font-bold font-inter">Employees On Leaves</p>
                                    </div>
                                    <div class="w-1/4 h-3/4 bg-red-700 rounded-lg shadow-md flex justify-center items-center">
                                        <p class="h-8 text-center text-white text-2xl font-semibold font-inter">{{$num_onleave}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Number of Employees -->
                <div class="h-1/2 pr-2 pt-2">
                    <div class="w-full h-full p-2 border border-black overflow-y-auto">
                        <form class="w-full h-full" action="{{route('update-dashboard')}}" method="get">
                            <div class="flex h-1/4">
                                <p class="w-3/4 text-yellow-600 text-xl font-bold font-inter">
                                    Number of Employees
                                </p>
                                <div class="w-1/4 flex justify-end">
                                    <x-button-gold class="w-28 h-8">
                                        Update
                                    </x-button-gold>
                                </div>
                            </div>
                            <!-- dropdown option -->
                            <div class="h-3/4 flex">
                                <div class="w-1/2 h-full">
                                    <div class="h-1/2">
                                        <p class="h-1/4 font-inter">Place of Assignment</p>
                                        <select name="college" id="college"
                                                class="block mt-2 w-full text-sm border-gray-300 rounded-md font-inter">
                                            <option value="null"></option>
                                            <option class="uppercase" value="Accounting Office">Accounting Office</option>
                                            <option class="uppercase" value="Human Resources">Human Resources</option>
                                            <option class="uppercase" value="University Health Services">University Health Services</option>
                                            <option class="uppercase" value="University Security Office">University Security Office</option>
                                            <option disabled></option>
                                            <option class="font-bold text-blue-700 uppercase" disabled>Colleges</option>
                                            <option value="College of Architecture and Urban Planning">College of Architecture and Urban Planning</option>
                                            <option value="College of Education">College of Education</option>
                                            <option value="College of Engineering">College of Engineering</option>
                                            <option value="College of Humanities, Arts and Social Sciences">College of Humanities, Arts and Social Sciences</option>
                                            <option value="College of Information System and Technology Management">College of Information System and Technology Management</option>
                                            <option value="College of Medicine">College of Medicine</option>
                                            <option value="College of Nursing">College of Nursing</option>
                                            <option value="College of Physical Therapy">College of Physical Therapy</option>
                                            <option value="College of Science">College of Science</option>
                                            <option value="Graduate School of Law">Graduate School of Law</option>
                                            <option value="College of Law">College of Law</option>
                                            <option value="PLM Business School">PLM Business School</option>
                                            <option value="School of Public Health">School of Public Health</option>
                                        </select>
                                    </div>
                                    <div class="p-2 border border-black">
                                        @if($selected_college == 'null')
                                        
                                        @else
                                            {{$selected_college}}
                                        @endif
                                    </div>
                                </div>
                                <div class="w-1/2 h-full text-6xl font-bold flex justify-center items-center">
                                    <div class="w-1/3 h-4/5 flex justify-center items-center border-b border-black">
                                        {{$num_employees}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- careers -->
            <div class="w-[555px] h-[430px] overflow-y-auto border border-black p-3">
                <div class="h-14 bg-indigo-800 flex items-center">
                    <h1 class="text-indigo-50 text-2xl font-bold pl-5">PLM Careers!</h1>
                </div>
                <div class="flex">
                    <div class="w-1/2 px-4 py-3 text-black text-base font-semibold">
                        Part Time
                        <div class="font-normal mt-2">
                            @foreach($part_time as $pt)
                            <p class="mt-2">
                                <span class="font-bold">{{$pt->college}} | </span>
                                <span class="text-yellow-600 ">{{$pt->job_name}}</span>
                            </p>
                            <div class="ml-3">
                                        <p>Status: {{ $pt->status }} </p>
                                        <p>Deadline: {{ $pt->deadline }} </p>
                                    </div> 
                            @endforeach
                        </div>
                    </div>
                    <div class="w-1/2 px-4 py-3 text-black text-base font-semibold">
                        Full Time
                        <div class=" font-normal mt-2">
                            @foreach($full_time as $ft)
                            <p class="mt-2">
                                <span class="font-bold">{{$ft->college}} | </span>
                                <span class="text-yellow-600 ">{{$ft->job_name}}</span>
                            </p>
                            <div class="ml-3">
                                        <p>Status: {{ $ft->status }} </p>
                                        <p>Deadline: {{ $ft->deadline }} </p>
                                    </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quicklinks -->
        <div class="w-full h-1/5 px-5 py-5 shadow shadow-gray-300 bg-gradient-to-t from-red-300 to-red-700">
            <div class="h-1/4 mt-1 flex items-center space-x-3">
                <img class="w-14 h-14" src="https://plm.edu.ph/images/Seal/PLM_Seal_BOR-approved_2014.png"/>
                <p class="h-6 text-gray-200 text-xl font-extrabold font-inter">Quick Links</p>
            </div>
            <div class="h-3/4 flex flex-wrap">
                <a target="_blank" href="https://www.plm.edu.ph">
                    <x-button-blue class="w-60 h-12 m-4 text-base">
                        PLM Website
                    </x-button-blue>
                </a>
                <a target="_blank" href="">
                    <x-button-blue class="w-60 h-12 m-4 text-base">
                        HR Request Form
                    </x-button-blue>
                </a>
                <a target="_blank" href="{{ route('guest-jobs') }}">
                    <x-button-blue class="w-60 h-12 m-4 text-base">
                        PLM Application Site
                    </x-button-blue>
                </a>
            </div>
        </div>  
    </div>
</x-admin-layout>