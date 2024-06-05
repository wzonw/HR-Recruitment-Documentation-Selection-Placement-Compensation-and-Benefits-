<x-admin-layout>
<div class="w-full h-screen flex justify-center font-inter">
        <div>
            <a href="{{ route('lc-resignation-monetization', $emp->employee_id) }}">
                <div class="min-w-[650px] h-fit rounded-md shadow shadow-gray-300 mt-5 px-5 py-5 mx-48 hover:bg-gray-200">
                    <!-- header -->
                    <div class="text-xl uppercase tracking-widest font-medium">
                        <div class="flex">
                            <p class="w-64">leave credit</p>
                            <p class="w-full ml-5 normal-case font-normal text-right text-sm tracking-normal text-gray-400">
                                Created: {{date('j F Y', strtotime(NOW()))}}
                            </p>  
                        </div>
                        <p class="text-sm tracking-wider text-indigo-800">monetization</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('lc-resignation-transfer', $emp->employee_id) }}">
                <div class="min-w-[650px] h-fit rounded-md shadow shadow-gray-300 mt-5 px-5 py-5 mx-48 hover:bg-gray-200">
                    <!-- header -->
                    <div class="text-xl uppercase tracking-widest font-medium">
                        <div class="flex">
                            <p class="w-64">leave credit</p>
                            <p class="w-full ml-5 normal-case font-normal text-right text-sm tracking-normal text-gray-400">
                                Created: {{date('j F Y', strtotime(NOW()))}}
                            </p>  
                        </div>
                        <p class="text-sm tracking-wider text-indigo-800">transfer</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-admin-layout>