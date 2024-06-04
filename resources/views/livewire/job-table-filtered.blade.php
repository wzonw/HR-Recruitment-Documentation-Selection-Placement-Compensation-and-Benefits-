<x-guest-layout>
    <livewire:job-applicant-header />
    <div class="flex justify-center items-center my-5">
        <div class="inline-flex items-center justify-center space-x-16">
            <div class="w-[729px] h-[400px]">
                <div class="inline-flex space-x-64">
                    <p class=" w-100 h-8 text-indigo-800 text-3xl text-left font-bold font-inter">
                        Careers Available
                    </p>
                </div>
                <div>
                    <table class="mt-5 w-[729px] table-fixed shadow border-black border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black border">
                                <th scope="row" class="px-6 py-3 w-44 font-medium font-inter whitespace-nowrap">
                                    @if ($job->dept == '')
                                        @if ($job->status == 'COS/JO')
                                        
                                            <span class="font-bold"> {{$job->college}} </span>
                                            <span>- Part Time {{$job->job_name}} </span>
                                        
                                        @else
                                        
                                            <span class="font-bold"> {{$job->college}} </span>
                                            <span>&nbsp- Full Time {{$job->job_name}} </span>
                                        
                                        @endif
                                    @else
                                        @if ($job->status == 'COS/JO')
                                        
                                            <span class="font-bold"> {{$job->dept}} </span>
                                            <span>- Part Time {{$job->job_name}} </span>
                                        
                                        @else
                                        
                                            <span class="font-bold"> {{$job->dept}} </span>
                                            <span>&nbsp- Full Time {{$job->job_name}} </span>
                                        
                                        @endif
                                    @endif
                                    <div class="ml-5">
                                        <p> {{$job->status}} </p>
                                        <p> {{$job->college}} </p>
                                    </div> 
                                    @if ($job->salary[1] == '.')
                                    @elseif ($job->salary[5] == '.')
                                        <p class="ml-5"> P{{$job->salary[0]}}{{$job->salary[1]}},
                                            {{$job->salary[2]}}{{$job->salary[3]}}{{$job->salary[4]}}</p>
                                    @elseif($job->salary[6] == '.')
                                        <p class="ml-5"> P{{$job->salary[0]}}{{$job->salary[1]}}{{$job->salary[2]}},
                                            {{$job->salary[3]}}{{$job->salary[4]}}{{$job->salary[5]}}</p>
                                    @endif
                                </th>       
                                <td class="w-10 border-l border-black">
                                    <form action="{{ route('guest-application', $job->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                                        <x-button-gold class="mx-2 w-28" >
                                            Apply
                                        </x-button-gold>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$jobs->links()}}
                </div>
            </div>
            <div class="w-[392px] h-[450px]">
                <livewire:job-search />
            </div>
        </div>
    </div>
</x-guest-layout>