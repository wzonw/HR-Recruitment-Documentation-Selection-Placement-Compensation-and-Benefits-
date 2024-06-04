<x-guest-layout>
    <livewire:job-applicant-header />
    <div class="w-screen flex justify-center">
        <div class="w-[500px] min-h-max mt-16 px-5 py-5 rounded-md border border-gray-100 shadow bg-slate-200 font-inter">
            <h1 class="text-2xl font-bold text-indigo-800">Verify Application</h1>
            @if(session('message'))
            <div class="min-w-max mt-2 h-8 mx-3 text-blue-500 items-end italic"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                {{ session('message') }}
            </div>
            @endif
            <form action="{{route('send-otp')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="ml-10 mt-3 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="id" value="{{ __('Application ID') }}" />
                    <x-input id="id" class="block mt-1 w-64" type="text" name="id" required autofocus/>
                </div>

                <div class="ml-10 mt-3 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="job_id" value="{{ __('Job ID') }}" />
                    <x-input id="job_id" class="block mt-1 w-64" type="text" name="job_id" required/>
                </div>

                <div class="ml-10 mt-3  inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-64" type="email" name="email" :value="old('email')" required />
                </div>
                
                <div class="flex justify-center mt-5 min-h-max text-black text-sm text-left font-normal font-inter">
                    <x-button-gold class="w-24 h-8" onclick="return confirm('Are you sure?')">
                        Verify
                    </x-button-gold>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>