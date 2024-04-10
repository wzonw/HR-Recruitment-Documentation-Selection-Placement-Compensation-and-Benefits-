<x-admin-layout>
    <div class=" ml-10">
        <div class="w-[1014px] h-14 mt-5 mb-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-3xl font-bold font-inter">Applicant List</p>
        </div>

        <p class="w-[120px] pl-3 text-indigo-800 text-sm font-semibold font-inter"> Search </p>

        @if(session('message'))
        <div class="mt-10 min-w-max h-8 mx-3 text-blue-600 items-end italic"
             x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
             x-init="setTimeout(() => show = false, 3000)">
            {{ session('message') }} 
        </div>
        @endif
        
        <div class="mt-10 w-[1014px] ml-1 inline-flex items-center">
            <p class="w-[58px] text-indigo-800 text-sm text-center font-semibold font-inter">ID</p>
            <p class="w-[215px] pl-3 text-indigo-800 text-sm font-semibold font-inter">Name</p>
            <p class="w-[245px] pl-3  text-indigo-800 text-sm font-semibold font-inter">Position</p>
            <p class="w-[245px] pl-3 text-indigo-800 text-sm font-semibold font-inter">Place of Assignment</p>
            <p class="w-[125px] pl-3 text-indigo-800 text-sm font-semibold font-inter">Status</p>

        </div>

        <!-- Applicant Table -->
        <div class="w-[1040px] h-[500px] overflow-auto">
            <table class="w-[1014px] table-fixed text-left bg-white shadow border-black border text-sm rtl:text-right text-gray-500 dark:text-gray-700">
                <tbody>
                    @foreach ($data as $applicant)
                    <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                        <td scope="row" class="w-8 text-center">
                            {{$applicant->id}}
                        </td>
                        <td class="w-28 pl-3 py-3 font-medium hover:text-gray-400">
                            <a href="{{ route('view-applicant-profile', $applicant->id) }}">{{$applicant->name}}</a>
                        </td>
                        <td class="w-32 pl-3 py-3">
                            {{$applicant->job_name}}
                        </td>
                        <td class="w-32 pl-3 py-3">
                            {{$applicant->college}}
                        </td>
                        <td class="w-16 pl-3 py-3">
                            {{$applicant->status}}
                        </td>
                        <td class="w-16 py-3 text-center">
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
</x-admin-layout>