<x-admin-layout>
    <div class=" h-full px-5">
        <div class="flex">
            <div class="w-[700px] h-14 mt-5 bg-indigo-800 flex items-center">
                <p class="ml-5 text-white text-3xl font-bold font-inter">Employee List</p>
            </div>
            <form type="get" action=" {{ url('/view/employee/list/emp_search') }} " class="w-[315px] p-2 h-14 mt-5 flex items-center justify-center">
                <div class="w-56 h-9 bg-white rounded border border-gray-400 shadow-md flex justify-center items-center">
                    <button type="submit" class="flex justify-center items-center w-10 h-8 border-none rounded">
                        <img src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg" class="w-10 h-8">
                    </button>
                    <input type="search" name="query" placeholder="Search Employee" class="w-44 h-8 ml-1 border-none rounded" >
                </div>
            </form>
        </div>

        <!-- table -->
        <div class="w-full flex flex-wrap">
            <div class="mt-10 w-full flex items-center ">
                <p class="w-1/4 px-7 text-indigo-800 text-sm font-semibold font-inter">Name</p>
                <!--employee type-->
                <div class="w-1/4 px-2">
                    <p class="border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white">
                        Employee Type
                    </p>
                </div>

                <!--Position-->
                <div class="w-1/4 px-5">
                    <p class="border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white">
                        Position
                    </p>
                </div>

                <!--Department-->
                <div class="w-1/4 px-5">
                    <p class="border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white">
                        Place of Assignment
                    </p>
                </div>
            </div>

            <!-- Employee Table -->
            <div class="w-full flex">
                <table class="w-full bg-white shadow border-black border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
                <tbody>
                    @foreach ($employees as $employee)
                    <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                        <th scope="row" class="w-1/4 p-5 font-medium text-black hover:text-gray-400">
                            <a href="{{ route('view-employee-profile', $employee->employee_id) }}">{{$employee->first_name}} {{$employee->last_name}} </a>
                        </th>
                        <td class="w-1/4 p-5">
                            {{$employee->status}}
                        </td>
                        <td class="w-1/4 p-5">
                            {{$employee->job_name}}
                        </td>
                        <td class="w-1/4 p-5">
                            {{$employee->college}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
