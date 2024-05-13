<x-admin-layout>
    <div class="h-full w-[1111px] pl-2 pt-3 flex flex-wrap">
        <div class="w-[545px]">
            <!-- name, num of emp, num of emp on leave -->
            <div class="w-[545px] h-[246px] shadow flex">
                <!-- card name -->
                <div class="w-[218px] h-[246px]">
                    <div class="w-[218px] h-32 bg-gradient-to-b from-yellow-600 to-black">
                        <img class=" opacity-25 w-[218px] h-32" src="https://plm.edu.ph/images/news/press-releases/Pamantasa--ng-Lungsod-ng-Maynila-facade.jpg"/>
                    </div>
                    <div class="ml-4 mt-7">
                        <!-- name -->
                        <div class="w-48 h-6 text-black text-xl font-semibold font-inter">NAME</div>
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
            <div class="w-[545px] h- bg-white shadow mt-5 py-5 px-5 ">
                <p class="h-9 text-yellow-600 text-xl font-bold font-inter">
                    Employee Leave Requests
                </p>
                <div class="mt-2 h-44 overflow-y-auto">
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
                                    <td class="w-24 text-center text-green-700 uppercase">{{$leave->remarks}}</td>
                                @elseif(strtolower($leave->remarks) == 'on hold')
                                    <td class="w-24 text-center text-blue-700 uppercase">{{$leave->remarks}}</td>
                                @else
                                    <td class="w-24 text-center text-red-700 uppercase">{{$leave->remarks}}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-[545px]">
            <!-- Jobs Applications -->
            <div class="h-min ml-3 bg-white shadow py-5">
                <div class=" px-5 h-9 text-yellow-600 text-xl font-bold font-inter flex items-center">
                    <p>Job Applications</p>
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

            <!-- Number of Employees by Role -->
            <form action="{{route('update-dashboard-chief')}}" method="get">
                <!-- Number of Employees -->
                <div class="mt-5 ml-3 shadow py-2 px-2">
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
                    <div class="flex space-x-20 h-64 text-sm">
                        <div class="w-60">
                            <p class="font-inter">Position</p>
                            <select name="position" id="position"
                                    class="block mt-1 w-60 h-9 text-xs border-gray-300 rounded-md font-inter">
                                <option value="null"></option>
                                <option value="Accountant">Accountant</option>
                                <option value="Administrative Assistant">Administrative Assistant</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Assistant Department Head">Assistant Department Head</option>
                                <option value="Business Manager">Business Manager</option>
                                <option value="Dentist">Dentist</option>
                                <option value="Department Head">Department Head</option>
                                <option value="Registrar">Registrar</option>
                                <option value="Security Officer">Security Officer</option>
                                <option disabled></option>
                                <option class="font-bold text-blue-700" disabled>Teaching</option>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Instructor">Instructor</option>
                                <option value="Professor">Professor</option>
                            </select>
                            <p class="font-inter">Place of Assignment</p>
                            <select name="college" id="college"
                                    class="block mt-1 w-60 h-9 text-xs border-gray-300 rounded-md font-inter">
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
                            <p class="font-inter">Status</p>
                            <select name="status" id="status"
                                    class="block mt-1 w-60 h-9 text-xs border-gray-300 rounded-md font-inter">
                                <option value="null"></option>
                                <option value="Plantilla">Plantilla</option>
                                <option value="COS/JO">COS/JO</option>
                            </select>
                            <div class="mt-5 py-2 px-2 border border-black">
                                @if($selected_position == 'null' && $selected_college == 'null' && $selected_status == 'null')
                                @elseif($selected_position != 'null' && $selected_college != 'null' && $selected_status == 'null')   
                                    <p class="font-bold">{{$selected_college}}</p>
                                    <p>{{$selected_position}}</p>
                                @elseif($selected_position != 'null' && $selected_college == 'null' && $selected_status != 'null')   
                                    <p>{{$selected_position}} ({{$selected_status}})</p>
                                @elseif($selected_position == 'null' && $selected_college != 'null' && $selected_status != 'null')   
                                    <p class="font-bold">{{$selected_college}}</p>
                                    <p>({{$selected_status}})</p>
                                @elseif($selected_position == 'null' && $selected_college == 'null' && $selected_status != 'null')   
                                    <p>({{$selected_status}})</p>
                                @elseif($selected_position == 'null' && $selected_college != 'null' && $selected_status == 'null')   
                                    <p class="font-bold">{{$selected_college}}</p>
                                @elseif($selected_position != 'null' && $selected_college == 'null' && $selected_status == 'null')   
                                    <p>{{$selected_position}} </p>
                                @else
                                    <p class="font-bold">{{$selected_college}}</p>
                                    <p>{{$selected_position}} ({{$selected_status}})</p>
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
    </div>
</x-admin-layout>