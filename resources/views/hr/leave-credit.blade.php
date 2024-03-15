<x-admin-layout>
    <div class="ml-10 mt-5">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Leave Credit</p>
        </div>

        <div class="w-[1000px] bg-slate-100 rounded-xl my-3 pb-5">
            <form action="{{ route('lc-computation') }}" method="post">
                @csrf
                <div class="flex justify-center">
                    <div class="mt-4 mx-12">
                        <x-label class="w-24" for="ida" value="{{ __('Employee ID') }}" />
                        <x-input id="ida" class="block mt-1 w-72 font-bold" type="text" name="ida" autofocus/>
                    </div>
                    <div class="mt-8 mx-12 min-h-max flex justify-center">
                        <x-button-gold class="w-28 mt-2">
                            Apply
                        </x-button-gold>
                    </div>
                </div>
            </form>
        </div>

        
    </div>
</x-admin-layout>