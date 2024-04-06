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
                @foreach($jobs as $jobs)
                    @if($jobs->active == 'Y')
                    <div class="w-60 min-h-max font-bold rounded shadow px-2 py-2 mt-2 mb-2 ml-5">
                        <a href="{{route('job-update-id', $jobs->id)}}"> {{$jobs->college}} 
                            <span class="font-normal"> -  {{$jobs->job_name}} </span>
                        </a>
                        <div class="ml-5">
                            <p>Status: <span class="font-normal"> {{$jobs->status}} </span></p>
                            <p>Department: <span class="font-normal"> {{$jobs->dept}} </span></p>
                            <p>Salary: <span class="font-normal"> Php {{number_format($jobs->salary, 0, '.', ',')}} </span></p>  
                        </div>
                    </div>
                    @else
                    <div class="bg-red-50 w-60 min-h-max font-bold rounded shadow px-2 py-2 mt-2 mb-2 ml-5">
                        <a href="{{route('job-update-id', $jobs->id)}}"> {{$jobs->college}} 
                            <span class="font-normal"> -  {{$jobs->job_name}} </span>
                        </a>
                        <div class="ml-5">
                            <p>Status: <span class="font-normal"> {{$jobs->status}} </span></p>
                            <p>Department: <span class="font-normal"> {{$jobs->dept}} </span></p>
                            <p>Salary: <span class="font-normal"> Php {{number_format($jobs->salary, 0, '.', ',')}} </span></p>  
                        </div>
                    </div>
                    @endif
                @endforeach 
            </div>
        </div>
        <!-- Update Job Form -->
        <div class="w-[500px] h-[300px] bg-white shadow shadow-gray-400 border border-black">
            <p class="w-26 h-11 pt-2 text-indigo-800 text-2xl shadow text-center font-bold font-inter">Update Job</p>
            @if(session('message'))
            <div class="min-w-max h-8 text-blue-600 flex items-end italic"
                 x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                 x-init="setTimeout(() => show = false, 3000)">
                {{ session('message') }} 
            </div>
            @endif
            <form action="{{route('job-update-id-success')}}" method="post" class="py-3">
                @csrf
                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="job_id" value="{{ __('Job ID') }}" />
                    <x-input id="job_id" class="block mt-1 w-72 h-9 text-gray-500" type="text" name="job_id" value="{{$job->id}}" readonly />
                </div>

                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="position" value="{{ __('Position') }}" />
                    <x-input id="position" class="block mt-1 w-72 h-9 text-gray-500" type="text" name="position" value="{{$job->job_name}}" readonly/>
                </div>

                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="active" value="{{ __('Active') }}" />
                    <label><x-input id="active" type="radio" name="active" value="Y" />Yes</label>
                    <label><x-input id="active" type="radio" name="active" value="N" />No</label>
                </div>
                
                <div class="w-[500px] mt-4 flex justify-center min-h-max text-black text-base text-left font-normal font-inter">
                    <x-button-gold class="w-28" onclick="return confirm('Are you sure?')">
                        Update
                    </x-button-gold>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
