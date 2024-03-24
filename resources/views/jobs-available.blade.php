<x-guest-layout>
    <livewire:job-applicant-header />
    <div class="flex justify-center items-center my-5">
        <div class="inline-flex items-center justify-center space-x-16">
            <div class="w-[729px] h-[400px]">
                <div class="inline-flex space-x-64">
                    <p class="w-56 h-8 text-indigo-800 text-2xl text-left font-bold font-inter">
                        Careers Available
                    </p>
                </div>
                <livewire:jobs-table />
            </div>
            <div class="w-[392px] h-[450px]">
                <livewire:job-search />
            </div>
        </div>
    </div>
</x-guest-layout>