<x-admin-layout>
    <div class=" ml-10">
        <div class="w-[560px] h-14 mt-5 bg-indigo-800 flex items-center">
            <p class="ml-5 text-white text-3xl font-bold font-inter">Employee List</p>
        </div>

        <div class="mt-10 w-[1014px] inline-flex items-center">
            <p class="mx-7 text-indigo-800 text-sm font-semibold font-inter">Name</p>
            
            <!--status dropdown-->
           

            <!--employee type dropdown-->
            <div class="ml-36">
                <x-dropdown>
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white hover:text-yellow-500 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                Employee Type

                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <button type="text" class="w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            COS/JO
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            Plantilla
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            Contractual
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!--Position dropdown-->
            <div class="ml-20">
                <x-dropdown>
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white hover:text-yellow-500 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                Position

                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <button type="text" class="w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            Instructor I
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            Instructor II
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            Instructor III
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            Assistant Professor I
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            Assistant Professor II
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!--Department dropdown-->
            <div class="ml-40">
                <x-dropdown>
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white hover:text-yellow-500 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                Department

                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <button type="text" class="w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            College of Architecture
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            College of Education
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            College of Technology and Engineering
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            College of Humanities, Arts, and Social Sciences
                        </button>
                        <button type="text" class="mt-1 w-48 min-h-max text-center text-black text-sm font-semibold font-inter rounded border-hidden shadow hover:bg-gray-100">
                            College of Medicine
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <!-- Employee Table -->
        <table class="w-[1014px] bg-white shadow border-black border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
            <tbody>
                @foreach ($employees as $employee)
                <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                    <th scope="row" class="w-56 px-6 py-3 font-medium  whitespace-nowrap">
                        <a href="{{ route('view-employee-profile', $employee->id) }}">{{$employee->name}} </a>
                    </th>
                    <td class="px-7 py-3">
                        {{$employee->status}}
                    </td>
                    <td class="pl-[85px] py-3">
                        {{$employee->job_name}}
                    </td>
                    <td class="py-3">
                        {{$employee->dept}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
