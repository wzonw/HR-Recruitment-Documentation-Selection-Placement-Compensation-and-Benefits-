<x-admin-layout>
    <div class="ml-10 mt-5">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Daily Time Record</p>
        </div>

        <div class="w-[1000px] bg-slate-100 rounded-xl my-3 pb-5">
            <form action="{{ route('manage-dtr-success') }}" method="post">
                @csrf
                <div class="flex justify-center">
                    <div>
                        <div class="mt-4 mx-12 flex items-center space-x-3">
                            <x-label class="w-18" for="date" value="{{ __('Month') }}" />
                            <x-input id="date" class="block mt-1 w-36 bg-slate-100 font-bold" type="text" value="{{$month}}" name="date" disabled/>
                        </div>
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

                    <div>
                        <div class="mt-[92px] mx-12 flex items-center space-x-2">
                            <x-label class="w-24" for="absent" value="{{ __('No. of Days Absent') }}" />
                            <x-input id="absent" class="block mt-3 w-56 " type="number" name="absent" />
                        </div>
                        <div class="mt-4 mx-12 flex items-center space-x-2">
                            <x-label class="w-24" for="undertime" value="{{ __('Undertime (No. of Hours)') }}" />
                            <x-input id="undertime" class="block mt-1 w-56 " type="number" name="undertime" />
                        </div>

                        <div class="mt-4 mx-12 flex items-center space-x-2">
                            <x-label class="w-24" for="late" value="{{ __('Late (No. of Hours)') }}" />
                            <x-input id="late" class="block mt-1 w-56 " type="number" name="late" />
                        </div>

                        <div class="mt-4 mx-12 flex items-center space-x-2">
                            <x-label class="w-24" for="overtime" value="{{ __('Overtime (No. of Hours)') }}" />
                            <x-input id="overtime" class="block mt-1 w-56 " type="number" name="overtime" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>