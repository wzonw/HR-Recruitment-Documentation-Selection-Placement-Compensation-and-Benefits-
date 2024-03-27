<!-- add file form -->
<div class="w-[420px] min-h-max font-inter bg-white rounded border-gray-300 border shadow-md">
    <!--error messages-->
    @if ($errors->any())
    <div class="mx-3 alert alert-danger text-red-600 italic">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- add file form -->
    <h1 class="h-10 px-10 pt-2 text-indigo-800 text-xl font-inter shadow">Add File Here</h1>
    
    <!-- success message -->
    @if(session('message'))
    <div class="min-w-max h-8 mx-3 text-blue-600 items-end italic">
        {{ session('message') }} 
    </div>
    @endif
    
    <form action="{{route('add-file-success')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-4 mx-10 inline-flex justify-center items-center space-x-2">
            <x-label class="w-24" for="file" value="{{ __('Upload File(s)') }}" />
            <x-input id="file" class="block mt-1 w-72" type="file" name="file[]" multiple required/>
        </div>
        
        <div class="py-4 mx-10 min-h-max text-black text-sm text-left font-normal font-inter">
            <x-button-gold class="w-24 h-8" onclick="return confirm('Are you sure?')">
                Upload
            </x-button-gold>
        </div>
    </form>
</div>
