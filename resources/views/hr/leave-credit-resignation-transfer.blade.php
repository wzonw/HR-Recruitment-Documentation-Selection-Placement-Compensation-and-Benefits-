<x-admin-layout>
    <div class="w-full h-screen flex justify-center font-inter">
        <div class="min-w-[650px] h-fit rounded-md shadow shadow-gray-300 mt-5 px-5 py-5 mx-48">
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
            <!-- plm -->
            <div class="my-4">
                <p class="text-yellow-600">Pamantasan ng Lungsod ng Maynila</p>
                <p class="text-xs">General Luna, corner Muralla St, Intramuros, Manila, 1002 Metro Manila</p>
            </div>
            <!-- employee details -->
            <div class="text-sm">
                <p class="text-gray-400">Employee Details:</p>
                <p>{{$emp->first_name}} {{$emp->last_name}}</p>
                <p>{{$emp->personal_email}}</p>
                <p>{{$job->job_name}}</p>
            </div>
            <!-- table -->
            <table class="mt-10 w-full table-fixed text-sm text-left">
                <tbody>
                    <!-- Rows -->
                    <tr class="h-7 bg-gray-100">
                        <td class="pl-2 font-medium">Accumulated Vacation and Sick Leave Credits</td>
                        <td class="text-center"></td>
                    </tr>
                    <tr class="h-7">
                        <td class="pl-2">Vacation Leave Credit</td>
                        <td class="text-right pr-10">{{$emp->vacation_credits}}</td>
                    </tr>
                    <tr class="h-7">
                        <td class="pl-2">Sick Leave Credit</td>
                        <td class="text-right pr-10 border-b">{{$emp->sick_credits}}</td>
                    </tr>
                    <tr class="h-7">
                        <td class="pl-2"></td>
                        <td class="text-right pr-10 font-semibold">{{$lc = $emp->vacation_credits + $emp->sick_credits}}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="{{ route('download-lc-transfer', $emp->employee_id) }}" target="_blank" class="text-blue-600 underline">Download</a>
            </div>
        </div>
    </div>
</x-admin-layout>