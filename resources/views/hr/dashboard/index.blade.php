<x-admin-layout>
    <div class="w-full h-full">
        <div class="flex relative">
            <div>
                <div class="flex">
                    <!-- Profile -->
                    <div class="w-[209px] h-[332px] my-4 mx-4 relative">
                        <div class="w-[209px] h-[337px] left-0 top-0 absolute bg-white shadow shadow-gray-400"></div>
                        <div class="w-[209px] h-[134px] left-0 top-0 absolute bg-gradient-to-b from-yellow-600">
                            <img class=" opacity-20 " src="https://www.plm.edu.ph/images/banners/2020-PLM-facade.jpg"/>
                        </div>
                        <div class="ml-4">
                            <!-- user's name -->
                            <div class="min-w-max h-10 top-[200px] absolute text-black text-base font-semibold font-'Inter'"> NAME </div>
                            <!-- user's section -->
                            <div class="w-[190px] h-6 top-64 absolute text-black text-sm font-semibold font-'Inter'">Section : HR Section</div>
                            <div class="w-[115px] h-[21px] top-[230px] absolute text-neutral-950 text-opacity-50 text-[13px] font-normal font-'Inter'">Administrator</div>
                        </div>
                        <div class="w-[125px] h-[125px] left-[36px] top-[54px] absolute bg-zinc-300 rounded-full"></div>
                        <div class="w-[93px] h-[95px] left-[52px] top-[69px] absolute">
                            <img class="w-[93px] h-[95px] left-0 top-0 absolute" src="https://www.plm.edu.ph/images/Seal/PLM_Seal_BOR-approved_2014.png" />
                        </div>
                    </div>

                    <!-- Num of requests -->
                    <div>
                        <div class="w-[308px] h-[102px] my-4 relative">
                            <div class="w-[306px] h-[102px] left-0 top- absolute bg-yellow-600 rounded-[10px] shadow"></div>
                            <div class="w-[94px] h-[63px] left-[214px] top-[17px] absolute bg-yellow-700 rounded-[10px] shadow-md "></div>
                            <div class="w-[94px] h-[31px] left-[214px] top-[35px] absolute text-center text-white text-2xl font-semibold font-'Inter'">{{ $num_reqs }}</div>
                            <div class="w-[191px] h-[45px] left-[17px] top-[24px] absolute text-white text-lg font-bold font-['Inter'">Employee Document Requests</div>
                        </div>

                        <div class="w-[309px] h-[102px] mb-4 relative">
                            <div class="w-[306px] h-[102px] left-0 top-0 absolute bg-indigo-700 rounded-[10px] shadow"></div>
                            <div class="w-[94px] h-[63px] left-[215px] top-[19px] absolute bg-indigo-800 rounded-[10px] shadow-md"></div>
                            <div class="w-[94px] h-[27px] left-[215px] top-[37px] absolute text-center text-white text-2xl font-semibold font-'Inter'">{{ $num_applicants }}</div>
                            <div class="w-[191px] h-[33px] left-[17px] top-[37px] absolute text-white text-lg font-bold font-'Inter'">Current Applicants</div>
                        </div>

                        <div class="w-[308px] h-[102px] relative">
                            <div class="w-[306px] h-[102px] left-0 top-0 absolute bg-red-700 rounded-[10px] shadow"></div>
                            <div class="w-[94px] h-[63px] left-[214px] top-[19px] absolute bg-red-800 rounded-[10px] shadow-md"></div>
                            <div class="w-[94px] h-[27px] left-[214px] top-[37px] absolute text-center text-white text-2xl font-semibold font-'Inter'">{{ $num_onleave }}</div>
                            <div class="w-[191px] h-[33px] left-[17px] top-[32px] absolute text-white text-lg font-bold font-'Inter'">Employees On Leaves</div>
                        </div>
                    </div>
                </div>

                <form action="{{route('update-dashboard')}}" method="get">
                    <!-- Number of Employees -->
                    <div class="mx-4 shadow shadow-gray-300 border border-black py-2 px-2">
                        <div class="flex">
                            <p class="w-56 h-9 text-yellow-600 text-xl font-bold font-inter">
                                Number of Employees
                            </p>
                            <div class="w-72 flex justify-end">
                                <x-button-gold class="w-28">
                                    Update
                                </x-button-gold>
                            </div>
                        </div>
                        <!-- dropdown option -->
                        <div class="flex space-x-20 h-44 mt-4">
                            <div class="w-60">
                                <p class="font-inter">Place of Assignment</p>
                                <select name="college" id="college"
                                        class="block mt-1 w-60 h-9 text-sm border-gray-300 rounded-md font-inter">
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
                                    <option value="School of Government">School of Government</option>
                                    <option value="School of Public Health">School of Public Health</option>
                                </select>
                                <div class="mt-5 py-2 px-2 border border-black">
                                    @if($selected_college == 'null')
                                    
                                    @else
                                        {{$selected_college}}
                                    @endif
                                </div>
                            </div>
                            <div class="w-32 h-32 text-6xl font-bold border-b border-black flex justify-center items-center">
                                {{$num_employees}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Careers -->
            <div class="w-[599px] h-[594px] my-4 relative">
                <div class="w-[599px] h-[594px] left-0 top-0 absolute bg-white shadow shadow-gray-400 border 
                        border-black font-inter overflow-y-scroll overflow-x-hidden">
                    <div class="w-[558px] h-[57px] left-[16px] top-[17px] absolute bg-indigo-800 flex items-center">
                        <h1 class="text-indigo-50 text-2xl font-bold pl-9">PLM Careers!</h1>
                    </div>
                    <div class="w-64 left-[33px] top-[93px] absolute text-black text-[15px] font-semibold over">
                        Part Time
                        <div class=" font-normal mt-2">
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
                    <div class="w-64 left-[322px] top-[93px] absolute text-black text-[15px] font-semibold">
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
        <div class="w-full h-[250px] mx-4 shadow shadow-gray-300 bg-gradient-to-t from-red-300 to-red-700">
            <img class="w-full h-full object-none object-center opacity-5" src="https://www.plm.edu.ph/images/banners/2020-PLM-facade.jpg"/>
            <div class="relative bottom-[240px] left-5 w-80 h-14 flex items-center space-x-3">
                <img class="w-14 h-14" src="https://plm.edu.ph/images/Seal/PLM_Seal_BOR-approved_2014.png"/>
                <p class="h-6 text-gray-200 text-xl font-extrabold font-inter">Quick Links</p>
            </div>
            <div class="relative bottom-[235px] left-28 w-80">
                <a href="https://www.plm.edu.ph">
                    <x-button-blue class="w-60 h-12 text-base">
                        PLM Website
                    </x-button-blue>
                </a>
                <a href="">
                    <x-button-blue class="mt-3 w-60 h-12 text-base">
                        HR Request Form
                    </x-button-blue>
                </a>
                <a href="">
                    <x-button-blue class="mt-3 w-60 h-12 text-base">
                        PLM Application Site
                    </x-button-blue>
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>