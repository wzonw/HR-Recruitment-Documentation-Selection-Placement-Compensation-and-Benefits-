<div class="">
    <div class="w-96 h-12">
        <p class="w-52 h-7 pl-5 text-indigo-800 text-3xl font-bold font-inter">Information</p>
    </div>
    
    <!-- Buttons -->
    <div class="space-y-3 pl-4">
        <div>
            <livewire:personal-info :wire:key="'custom-modal-'.time()">
            <!--a href="{{ route('user-personal-info') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-400 rounded-md font-medium text-sm text-black font-inter tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Personal Information
            </a-->
        </div>
        <div>
            <a href="{{ route('applicant-dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-400 rounded-md font-medium text-sm text-black font-inter tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Career Application
            </a>
        </div>
        <div>
            <livewire:contact-info :wire:key="'custom-modal-'.time()">
        </div>
    </div>

</div>
