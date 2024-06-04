<x-app-layout>
    <livewire:user-profile-cover />

    <div class="font-inter mt-20 ml-20">
        {{-- Stop trying to control. --}}
        <h1 class="text-indigo-800 text-lg font-bold font-inter">Application Details</h1>
        <div>
            <p>Applicant ID: {{ Auth::user()->id }}</p>
            <p>Application ID: {{$application->id}}</p> <br>
            <p class="font-bold">{{$job->job_name}} - {{$job->college}}</p>
            <p>Dept: {{$job->dept}}</p>
            <p>Status: {{$job->status}}</p>
            <p>Date applied: {{$application->created_at->toDateString()}}</p>
        </div>
    </div>
</x-app-layout>