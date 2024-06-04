<x-admin-layout>
    <div class="ml-10 mt-5 h-screen">
        <div class="w-[1000px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-2xl font-bold font-inter">Daily Time Record</p>
        </div>

        <div class="w-[1000px] bg-slate-100 rounded-xl my-3 pb-5">
            @if(session('message'))
            <div class="ml-14 h-9 text-blue-600 flex items-end italic"
                    x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                    x-init="setTimeout(() => show = false, 3000)">
                {{ session('message') }} 
            </div>
            @endif
            <form action="{{ route('add-dtr-success') }}" method="post">
                @csrf
                <div class="flex justify-center pt-3">
                    <div class="mx-12 flex items-center space-x-3">
                        <x-label class="w-18" for="date" value="{{ __('Month') }}" />
                        <x-input id="date" class="block mt-1 w-36 bg-slate-100 font-bold" type="text" value="{{$month}}" name="date" readonly/>
                    </div>
                    <div class="mx-12 flex items-center">
                        <x-label class="w-24" for="id" value="{{ __('Employee ID') }}" />
                        <x-input id="id" class="block mt-1 w-44 font-bold" type="text" name="id" autofocus required/>
                    </div>
                    <div class="mx-12 h-10 flex justify-center">
                        <x-button-gold class="w-28 mt-1" onclick="return confirm('Are you sure?')">
                            Apply
                        </x-button-gold>
                    </div>
                </div>

                <div class="mt-5 ml-5">
                    <div class=" mx-12 flex items-center space-x-2">
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

                    <div class="flex">
                        <div class="mt-4 mx-12 flex items-center space-x-2">
                            <x-label class="w-24" for="overtime" value="{{ __('Overtime (No. of Hours)') }}" />
                            <x-input id="overtime" class="block mt-1 w-56 " type="number" name="overtime" />
                        </div>
                        <div class="mt-4 mx-12 flex items-center space-x-2">
                            <x-label class="w-24" for="remarks" value="{{ __('Remarks (if Rest Day)') }}" />
                            <x-input id="remarks" class="block mt-1 w-56 " type="text" name="remarks" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>