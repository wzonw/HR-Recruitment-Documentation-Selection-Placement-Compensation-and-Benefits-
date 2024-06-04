<x-admin-layout>
    <div class=" h-full ml-10 mt-0 m-5 ">
        <div class="flex">    
            <div class="w-[1014px] h-14 mt-10 mb-0 bg-indigo-800 flex items-center">
                <p class="ml-5 text-white text-3xl font-bold font-inter">Applicant List</p>
            </div>
        </div>
        @if(session('message'))
        <div class="mt-10 min-w-max h-8 mx-3 text-blue-600 items-end italic"
             x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
             x-init="setTimeout(() => how = false, 3000)">
            {{ session('message') }} 
        </div>
        @endif
        <div class="w-full flex flex-wrap"> 
            <div class="mt-10 w-full inline-flex items-center">
                    <p class=" px-5 text-indigo-800 text-sm font-semibold font-inter">ID</p>
                    <p class="w-1/6 px-3 text-indigo-800 text-sm font-semibold font-inter">Name</p>
                    <p class="w-1/5 pl-4 text-indigo-800 text-sm font-semibold font-inter">Position</p>
                    <p class="w-1/4 pl-2 text-indigo-800 text-sm font-semibold font-inter">Place of Assignment</p>
                    <p class="w-1/4 pl-6 text-indigo-800 text-sm font-semibold font-inter">Status</p>
            </div>

            <!-- Applicant Table -->
            <div class=" w-full flex ">
                    <table class="w-full bg-white shadow border-black border text-sm rtl:text-right text-gray-500 dark:text-gray-700">
                        <tbody>
                            @foreach ($data as $applicant)
                            <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                                <td scope="row" class="w-1/10 p-5">
                                    {{$applicant->id}}
                                </td>
                                <td class="w-1/6 px-5 font-medium hover:text-gray-400">
                                    <a href="{{ route('view-applicant-profile', $applicant->id) }}">
                                        {{$applicant->first_name}} {{$applicant->last_name}}
                                    </a>
                                </td>
                                <td class="w-1/5 px-5">
                                    {{$applicant->job_name}}
                                </td>
                                <td class="w-1/4 px-2">
                                    {{$applicant->college}}
                                </td>
                                <td class="w-1/8 px-6">
                                    {{$applicant->status}}
                                </td>
                                <td class="w-1/4 p-5 text-center">
                                    @if($applicant->remarks != "Declined")
                                        <p class="text-green-600">{{$applicant->remarks}}</p>
                                    @elseif($applicant->remarks == "Declined")
                                        <p class="text-red-500">{{$applicant->remarks}}</p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</x-admin-layout>