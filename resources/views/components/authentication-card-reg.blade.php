<div class="space-y-5 min-h-screen">
    <livewire:JobApplicantHeader />
    <div class="flex justify-center pb-4">
        <div class="absolute w-[600px] flex flex-col sm:justify-center items-center sm:pt-0 bg-white rounded-[3px] shadow shadow-black">
            <div class="pt-3">
                {{ $logo }}
            </div>

            <div class="w-[500px] px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
    
</div>