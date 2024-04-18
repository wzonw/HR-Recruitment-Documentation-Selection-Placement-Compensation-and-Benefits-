<!-- file cabinet -->
<div>
    <div class="w-[729px] h-16 bg-white shadow border-l border-r border-t border-black inline-flex">
        <h class="w-52 h-7 pt-3 pl-5 text-indigo-800 text-3xl font-bold font-inter">File Cabinet</h> 
    </div>

    <table class="w-[729px] bg-white shadow border-black border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
        <thead class="h-7 text-sm text-gray-700 uppercase bg-slate-200 dark:bg-slate-200 dark:text-gray-700">
            <tr>
                <th scope="col" class="px-6 py-2 w-48">
                    Description
                </th>
                <th scope="col" class="px-6 py-2 w-80">
                    File Name
                </th>
                <th scope="col" class="text-center py-2 w-6">
                    Remarks
                </th>
                <th scope="col" class="">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($applicant->file as $index=> $value)
            <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                <th scope="row" class="px-6 py-3 font-medium  whitespace-nowrap">
                    {{ Str::between($value, '_', '.') }}
                </th>       
                <td class="px-6 py-3">
                    <a href="{{ route('view-file', ['file' => $value]) }}">{{ $value }} </a>
                </td>
                @if($applicant->file_remarks != null)
                    @if($applicant->file_remarks[$index] == 'declined')
                        <td class="py-3 text-center text-red-600">
                            {{ $applicant->file_remarks[$index] }}
                        </td>
                    @else
                        <td class="py-3 text-center text-blue-600">
                            {{ $applicant->file_remarks[$index] }}
                        </td>
                    @endif
                @else
                    <td class="pl-2 py-3 text-blue-600">
                    </td>
                @endif
                <!-- for recruitment -->
                <td class="pl-2 py-3  w-10">
                    <!-- if($applicant->status != null) -->
                    <div class="flex space-x-3">
                        <div class="bg-green-700 w-5 flex justify-center rounded">
                            <a href="{{route('approved-file', ['file' => $value])}}">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="bg-red-700 w-5 flex justify-center rounded">
                            <a href="{{route('declined-file', ['file' => $value])}}">
                                <svg fill="#ffffff" width="20" height="20" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <span>Sorry, empty!</span>
            @endforelse
        </tbody>
    </table>
</div>