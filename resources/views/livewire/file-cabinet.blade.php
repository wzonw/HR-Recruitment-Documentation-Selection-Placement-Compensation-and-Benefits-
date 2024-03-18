<!-- file cabinet -->
<div>
    <div class="w-[729px] h-16 bg-white shadow border-l border-r border-t border-black inline-flex">
        <h class="w-52 h-7 pt-3 pl-5 text-indigo-800 text-3xl font-bold font-inter">File Cabinet</h> 
    </div>
    
    @can('for-applicants')
    <div class="absolute mt-[-48px] ml-[550px]">
        <a href="#" class="w-10 h-7 pt-4 text-black text-base font-medium font-inter underline leading-loose">Add</a>
        <a href="#" class="w-10 h-7 pt-4 pl-12 text-black text-base font-medium font-inter underline leading-loose">Delete</a>
    </div>
    @endif

    <table class="w-[729px] bg-white shadow border-black border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
        <thead class="h-7 text-sm text-gray-700 uppercase bg-slate-200 dark:bg-slate-200 dark:text-gray-700">
            <tr>
                <th scope="col" class="px-6 py-2 w-80">
                    Description
                </th>
                <th scope="col" class="px-6 py-2">
                    File Name
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
            </tr>
            @empty
            <span>Sorry. Is empty!</span>
            @endforelse
        </tbody>
    </table>
</div>