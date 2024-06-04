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
                <p class="text-sm tracking-wider text-indigo-800">monetization</p>
            </div>
            <!-- plm -->
            <div class="my-4">
                <p class="text-yellow-600">Pamantasan ng Lungsod ng Maynila</p>
                <p class="text-xs">General Luna, corner Muralla St, Intramuros, Manila, 1002 Metro Manila</p>
            </div>
            <!-- employee details -->
            <div class="text-sm">
                <p class="text-gray-400">Employee Details:</p>
                <p>{{$emp->name}}</p>
                <p>{{$emp->email}}</p>
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
                        <td class="text-right pr-10">{{$emp->vl_credit}}</td>
                    </tr>
                    <tr class="h-7">
                        <td class="pl-2">Sick Leave Credit</td>
                        <td class="text-right pr-10 border-b">{{$emp->sl_credit}}</td>
                    </tr>
                    <tr class="h-7">
                        <td class="pl-2"></td>
                        <td class="text-right pr-10 font-semibold">{{$lc = $emp->vl_credit + $emp->sl_credit}}</td>
                    </tr>
                </tbody>
            </table>
            <!-- computation -->
            <div class="mt-5 w-full text-sm">
                <p class="h-7 flex items-center pl-2 bg-gray-100 font-medium">Computation</p>
                <div class="w-full pl-2 mt-1">
                    <div class="flex">
                        <p class="w-24"> Salary </p>
                        <p class="w-full text-right pr-10">P {{number_format($job->salary, 2, '.', ',')}}</p>
                    </div>
                    <!-- used terminal leave formula -->
                    <div class="w-full pl-44 my-2 space-y-1">
                        <p class="text-gray-400">Salary x Accumulated Leave Credits x 0.0478087</p>
                        <p>{{number_format($job->salary, 2, '.', '')}} x {{$lc}} x 0.0478087</p>
                        <p class="font-bold text-indigo-800">= P {{number_format($job->salary*$lc*0.0478087, 2, '.', ',')}}</p>
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('download-lc', $emp->id) }}" class="text-blue-600 underline">Download</a>
            </div>
        </div>
    </div>
</x-admin-layout>