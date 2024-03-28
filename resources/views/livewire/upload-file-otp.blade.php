<x-guest-layout>
    <livewire:job-applicant-header />
    <div class="w-screen flex justify-center">
        <div class="w-[500px] min-h-max mt-16 px-5 py-5 rounded-md border border-gray-100 shadow bg-slate-200 font-inter">
            <h1 class="text-2xl font-bold text-indigo-800">Upload File</h1>
            @if ($errors->any())
            <div class="mx-3 alert alert-danger text-red-600 italic">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('upload-file-success', $id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="hidden ml-10 mt-3 justify-center items-center space-x-2">
                    <x-label class="w-24" for="id" value="{{ __('Application ID') }}" />
                    <x-input id="id" class="block mt-1 w-64" type="text" name="id" value="{{$id}}" required/>
                </div>

                <div class="ml-10 mt-3 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-36" for="otp" value="{{ __('One-Time Password') }}" />
                    <x-input id="otp" class="block mt-1 w-56" type="text" name="otp" required autofocus/>
                </div>

                <div class="mt-4 mx-12 inline-flex justify-center items-center space-x-2">
                    <x-label class="w-24" for="file" value="{{ __('Upload File(s)') }}" />
                    <x-input id="file" class="block mt-1 w-72" type="file" name="file[]" multiple required/>
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