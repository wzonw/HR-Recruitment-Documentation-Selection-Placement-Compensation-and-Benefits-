<x-admin-layout>
    {{-- Success is as dangerous as failure. --}}
    <div class="flex flex-wrap h-full">
        <!-- Jobs Available -->
        <div class="px-2 py-2">
            <div class="w-[550px] h-[600px] pt-7 bg-white shadow shadow-gray-400 border rounded-xl border-black">
                <div class="ml-6 min-w-max min-h-max inline-flex space-x-5">
                    <h1 class="text-indigo-800 text-2xl font-bold font-inter">Available Careers</h1>
                    <a href="https://www.plm.edu.ph/" class="mt-[7px] text-yellow-600 text-sm font-normal font-inter underline">PLM Website</a>
                </div>
                <div class=" font-inter text-sm text-left flex flex-wrap overflow-auto h-[520px]">
                    @foreach($jobs as $job)
                        <div class="w-60 min-h-max font-bold rounded shadow px-2 py-2 mt-2 mb-2 ml-5">
                            <p> {{$job->college}} <span class="font-normal"> -  {{$job->job_name}} </span></p>
                            <div class="ml-5">
                                <p>Status: <span class="font-normal"> {{$job->status}} </span></p>
                                <p>Department: <span class="font-normal"> {{$job->dept}} </span></p>
                                <p>Salary: <span class="font-normal"> Php {{number_format($job->salary, 0, '.', ',')}} </span></p>  
                            </div>
                        </div>  
                    @endforeach 
                </div>
            </div>
        </div>

        <!-- for recruitment -->
        <!-- Add Job Form-->
        <div class="px-3 py-2">
            <div class="w-[500px] h-[600px] bg-white shadow shadow-gray-400 border border-black">
                <div class="flex justify-end items-center shadow">
                    <p class="w-80 h-11 mr-1 pt-2 text-indigo-800 text-2xl text-center font-bold font-inter">Add Vacancies</p>
                    <a href="{{route('job-posting-2')}}" class="px-2 py-1 h-7 mr-2 text-sm opacity-50 border-b-2 text-indigo-800 focus:ring-2 focus:rounded-md">
                        Others
                    </a>
                </div>
                @if(session('message'))
                <div class="mx-5 min-w-max h-8 text-blue-600 flex items-end italic"
                        x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                        x-init="setTimeout(() => show = false, 3000)">
                    {{ session('message') }} 
                </div>
                @endif
                
                <form action="{{route('job-post')}}" method="post" class="py-3">
                    @csrf
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <x-label class="w-24" for="position" value="{{ __('Position') }}" />
                        <!-- dropdown option -->
                        <select name="position" id="position" autofocus required
                                class="block mt-1 w-72 h-9 text-sm uppercase border-gray-300 rounded-md">
                            <option></option>
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
                    </div>
    
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <x-label class="w-24 text-neutral-300 italic" for="position_num" value="{{ __('(optional)') }}" />
                        {{-- 
                            <x-input id="position_num" class="block mt-1 w-72 h-9" type="text" 
                            name="position_num" :value="old('position')" required />
                        --}}
                        <!-- dropdown option -->
                        <select name="position_num" id="position_num"
                                class="block mt-1 w-72 h-9 uppercase text-sm border-gray-300 rounded-md">
                            <option></option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>
    
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <x-label class="w-24" for="college" value="{{ __('Place of Assignment') }}" />
                        {{--<x-input id="college" class="block mt-1 w-72 h-9" type="text" name="college" :value="old('college')" required />--}}
                        <!-- dropdown option -->
                        <select name="college" id="college" required
                                class="block mt-1 w-72 h-9 text-sm border-gray-300 rounded-md font-inter">
                            <option></option>
                            <option class="uppercase" value="Accounting Office">Accounting Office</option>
                            <option class="uppercase" value="Human Resources">Human Resources</option>
                            <option class="uppercase" value="University Health Services">University Health Services</option>
                            <option class="uppercase" value="University Security Office">University Security Office</option>
                            <option disabled></option>
                            <option class="font-bold text-blue-700 uppercase" disabled>Colleges</option>
                            <option value="College of Architecture and Urban Planning">
                                CAUP
                            </option>
                            <option value="College of Education">CEd</option>
                            <option value="College of Engineering">CEng</option>
                            <option value="College of Humanities, Arts and Social Sciences">
                                CHASS
                            </option>
                            <option value="College of Information Technology and System Management">
                                CISTM
                            </option>
                            <option value="College of Medicine">CM</option>
                            <option value="College of Nursing">CN</option>
                            <option value="College of Physical Therapy">CPT</option>
                            <option value="College of Science">CS</option>
                            <option value="PLM Business School">PLMBS</option>
                            <option value="College of Law">College of Law</option>
                        </select>
                    </div>
    
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <label class="w-24 font-medium text-sm text-gray-700" for="dept">
                            Department <span class="italic text-neutral-300">(optional)</span>
                        </label>
                        <x-input id="dept" class="block mt-1 w-72 h-9" type="text" name="dept" :value="old('dept')" />
                    </div>
    
    
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <x-label class="w-24" for="status" value="{{ __('Status') }}" />
                        <!-- dropdown option -->
                        <select name="status" id="status" required
                                class="block mt-1 w-72 h-9 uppercase text-sm border-gray-300 rounded-md">
                            <option></option>
                            <option value="Plantilla">plantilla</option>
                            <option value="COS/JO">cos/jo</option>
                        </select>
                    </div>
    
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <x-label class="w-24" for="salary" value="{{ __('Salary') }}" />
                        <x-input id="salary" class="block mt-1 w-72 h-9" type="number" name="salary" :value="old('salary')" required />
                    </div>
    
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <x-label class="w-24" for="deadline" value="{{ __('Deadline') }}" />
                        <x-input id="deadline" class="block mt-1 w-72 h-9" type="date" name="deadline" :value="old('deadline')" required />
                    </div>
    
                    <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                        <label class="w-24 font-medium text-sm text-gray-700" for="description">
                            Description <span class="italic text-neutral-300">(optional)</span>
                        </label>
                        <textarea id="description" class="block mt-1 w-72 h-20 border" type="text" name="description"></textarea>
                    </div>
                    
                    <div class="w-[500px] mt-4 flex justify-center min-h-max text-black text-base text-left font-normal font-inter">
                        <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                            Apply
                        </x-button-gold>
                    </div>
                </form>
            </div>
        </div>
        <!-- -->
    </div>
</x-admin-layout>