<x-admin-layout>
    <div class="h-screen mx-10">
        <div class="flex my-5">
            <div class="w-[700px] h-14 mt-5 bg-indigo-800 flex items-center">
                <p class="ml-5 text-white text-3xl font-bold font-inter">Employee List</p>
            </div>
            <form type="get" action=" {{ url('/view/employee/list/emp_search') }} " class="w-[315px] h-14 mt-5 flex items-center justify-center">
                <div class="w-56 h-9 bg-white rounded border border-gray-400 shadow-md flex justify-center items-center">
                    <button type="submit" class="flex justify-center items-center w-10 h-8 border-none rounded">
                        <img src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg" class="w-10 h-8">
                    </button>
                    <input type="search" name="query" placeholder="Search Employee" class="w-44 h-8 ml-1 border-none rounded" >
                </div>
            </form>
        </div>

        <div class="mt-10 w-[1014px] inline-flex items-center">
            <p class="mx-7 text-indigo-800 text-sm font-semibold font-inter">Name</p>
            <!--employee type-->
            <div class="ml-36 w-56">
                <p class="px-3 py-2 border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white">
                    Employee Type
                </p>
            </div>

            <!--Position-->
            <div class="w-64">
                <p class="px-7 py-2 border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white">
                    Position
                </p>
            </div>

            <!--Department-->
            <div class="w-72">
                <p class="px-6 py-2 border border-transparent text-sm leading-4 font-semibold font-inter rounded-md text-yellow-600 bg-white">
                    Place of Assignment
                </p>
            </div>
        </div>

        <!-- Employee Table -->
        <table class="w-[1014px] bg-white shadow border-black border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
            <tbody>
                @foreach ($employees as $employee)
                <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                    <th scope="row" class="w-60 px-6 py-3 font-medium whitespace-nowrap text-black hover:text-gray-400">
                        <a href="{{ route('view-employee-profile', $employee->id) }}">{{$employee->name}} </a>
                    </th>
                    <td class="w-56 px-3 py-3">
                        {{$employee->status}}
                    </td>
                    <td class="w-64 px-5 py-3">
                        {{$employee->job_name}}
                    </td>
                    <td class="px-6 py-3">
                        {{$employee->college}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
