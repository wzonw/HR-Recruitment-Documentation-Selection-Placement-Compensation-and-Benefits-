<x-app-layout>
    <div class=" ml-16 mt-14 mb-4">
        <div class="w-[729px] min-h-max">
            <div class="">
                @if ($job->status == 'COS/JO')
                <p class="min-w-max h-8 text-indigo-800 text-2xl text-left font-bold font-inter">
                    Part-Time {{ $job->job_name}}
                </p>
                @else
                <p class="min-w-max h-8 text-indigo-800 text-2xl text-left font-bold font-inter">
                    Full-Time {{ $job->job_name}}
                </p>
                @endif
                
                <p class="min-w-max h-8 text-indigo-800 text-lg text-left font-normal font-inter">
                    {{ $job->college}}
                </p>
                <p class="min-w-max h-8 text-black text-base text-left font-normal font-inter">
                    Department: {{ $job->dept}}
                </p>
                
            </div>
        </div>
        <div class="w-[729px]">
            <div class="min-h-max text-black text-base text-left font-normal font-inter">
                <p class="text-wrap">
                    Description: <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                    non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class=" w-[729px] mt-5">
            <livewire:job-apply-button :job="$job" />
        </div>
    </div>
</x-app-layout>