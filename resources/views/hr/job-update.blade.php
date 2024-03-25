<x-admin-layout>
    {{-- Success is as dangerous as failure. --}}
    <div class="flex justify-center w-full px-5 py-5 space-x-3">
        <div class="w-[550px] h-[600px] pt-7 pl-7 bg-white shadow shadow-gray-400 border rounded-xl border-black">
            <div class="min-w-max min-h-max inline-flex space-x-5">
                <h1 class="text-indigo-800 text-2xl font-bold font-inter">Available Careers</h1>
                <a href="https://www.plm.edu.ph/" class="mt-[7px] text-yellow-600 text-sm font-normal font-inter underline">PLM Website</a>
            </div>
            <div class="w-[500px] h-[490px]  overflow-auto mt-2 font-inter text-sm flex space-x-2 justify-center">
                <table class="w-60 table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
                    <tbody>
                        @foreach ($jobs_o as $job)
                        <tr class=" ">
                            <th scope="row" class="px-6 py-3 font-medium font-inter whitespace-normal ">
                                <span class="font-bold">{{ $job->college }}</span>
                                <span> - <a href="{{route('job-update', $job->id)}}">{{ $job->job_name }}</a></span><br>
                                <div class="ml-3 wrap">
                                    <span class="font-bold">Status: </span>
                                    <span> {{ $job->status }} </span><br>
                                    <span class="font-bold">Department: </span>
                                    <span> {{ $job->dept }} </span><br>
                                    <span class="font-bold">Salary: </span> 
                                    @if ($job->salary[1] == '.')
                                    @elseif ($job->salary[5] == '.')
                                        <span> Php {{$job->salary[0]}}{{$job->salary[1]}},
                                            {{$job->salary[2]}}{{$job->salary[3]}}{{$job->salary[4]}}</span>
                                    @elseif($job->salary[6] == '.')
                                        <span> Php {{$job->salary[0]}}{{$job->salary[1]}}{{$job->salary[2]}},
                                            {{$job->salary[3]}}{{$job->salary[4]}}{{$job->salary[5]}}</span>
                                    @endif
                                </div> 
                            </th>   
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
                <table class="w-60 table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
                    <tbody>
                        @foreach ($jobs_e as $job)
                        <tr class="">
                            <th scope="row" class="px-6 py-3 font-medium font-inter whitespace-normal">
                                <span class="font-bold">{{ $job->college }}</span>
                                <span> - <a href="{{route('job-update', $job->id)}}">{{ $job->job_name }}</a></span><br>
                                <div class="ml-3">
                                    <span class="font-bold">Status: </span>
                                    <span> {{ $job->status }} </span><br>
                                    <span class="font-bold">Department: </span>
                                    <span> {{ $job->dept }} </span><br>
                                    <span class="font-bold">Salary: </span> 
                                    @if ($job->salary[1] == '.')
                                    @elseif ($job->salary[5] == '.')
                                        <span> Php {{$job->salary[0]}}{{$job->salary[1]}},
                                            {{$job->salary[2]}}{{$job->salary[3]}}{{$job->salary[4]}}</span>
                                    @elseif($job->salary[6] == '.')
                                        <span> Php {{$job->salary[0]}}{{$job->salary[1]}}{{$job->salary[2]}},
                                            {{$job->salary[3]}}{{$job->salary[4]}}{{$job->salary[5]}}</span>
                                    @endif
                                </div> 
                            </th>   
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-[500px] h-[300px] bg-white shadow shadow-gray-400 border border-black">
            <p class="w-26 h-11 pt-2 text-indigo-800 text-2xl shadow text-center font-bold font-inter">Update Job</p>
            @if(session('message'))
            <div class="min-w-max h-8 text-blue-600 flex items-end italic">
                {{ session('message') }} 
            </div>
            @endif
            <form action="{{route('job-update-active')}}" method="post" class="py-3">
                @csrf
                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="job_id" value="{{ __('Job ID') }}" />
                    <x-input id="job_id" class="block mt-1 w-72 h-9 text-gray-500" type="text" name="job_id" value="{{$jobs->id}}" readonly />
                </div>

                <div class="mt-2 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="position" value="{{ __('Position') }}" />
                    <x-input id="position" class="block mt-1 w-72 h-9 text-gray-500" type="text" name="position" value="{{$jobs->job_name}}" readonly/>
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
