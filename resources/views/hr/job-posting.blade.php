<x-admin-layout>
    {{-- Success is as dangerous as failure. --}}
    <div class="flex justify-center w-full px-5 py-5 space-x-3">
        <!-- Jobs Available -->
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

        @can('for-recruitment')
        <!-- Add Job Form-->
        <div class="w-[500px] h-[510px] bg-white shadow shadow-gray-400 border border-black">
            <p class="w-26 h-11 pt-2 text-indigo-800 text-2xl shadow text-center font-bold font-inter">Add Vacancies</p>
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
                    <x-input id="position" class="block mt-1 w-72 h-9" type="text" name="position" :value="old('position')" required />
                </div>

                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="college" value="{{ __('Place of Assignment') }}" />
                    <x-input id="college" class="block mt-1 w-72 h-9" type="text" name="college" :value="old('college')" required />
                </div>

                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="dept" value="{{ __('Department') }}" />
                    <x-input id="dept" class="block mt-1 w-72 h-9" type="text" name="dept" :value="old('dept')" />
                </div>


                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="status" value="{{ __('Status') }}" />
                    <x-input id="status" class="block mt-1 w-72 h-9" type="text" name="status" :value="old('status')" required />
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
                    <x-label class="w-24" for="description" value="{{ __('Description') }}" />
                    <textarea id="description" class="block mt-1 w-72 h-20 border" type="text" name="description"></textarea>
                </div>
                
                <div class="w-[500px] mt-4 flex justify-center min-h-max text-black text-base text-left font-normal font-inter">
                    <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                        Apply
                    </x-button-gold>
                </div>
            </form>
        </div>
        @endif
    </div>
</x-admin-layout>
