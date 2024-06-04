<x-admin-layout>
    <div class="px-5 h-full">
        <div class="w-[1100px] h-20 mt-5 flex items-center space-x-96 rounded-lg border shadow-md">
            <div class="flex">
                <p class="ml-5 text-indigo-800 text-2xl font-extrabold font-inter">Employee Document Requests</p>
            </div>
            <form type="get" action=" {{ url('/view/request/emp_search') }} ">
                <div class="w-56 h-9 bg-white rounded border border-gray-400 shadow-md flex justify-center items-center">
                    <button type="submit" class="flex justify-center items-center w-10 h-8 border-none rounded">
                        <img src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg" class="w-10 h-8">
                    </button>
                    <input type="search" name="query" placeholder="Search Employee" class="w-44 h-8 ml-1 border-none rounded" >
                </div>               
            </form>
        </div>

        <div class="mt-5 w-[1100px] min-h-max pb-3 rounded-lg border shadow-lg">
            @if(session('message'))
            <div class="min-w-max h-8 ml-10 text-blue-600 flex items-end italic"
                 x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                 x-init="setTimeout(() => show = false, 3000)">
                {{ session('message') }} 
            </div>
            @endif
            <div class="pt-5 ml-10 flex space-x-36 text-black text-sm font-medium font-inter">
                <p class="h-4">Employee ID</p>
                <p class="h-4">Name</p>
                <p class="h-4">Documents</p>
                <p class="pl-5 h-4">Purpose</p>
            </div>
            <div class="mt-3 ml-8">
                @foreach($requests as $req)
                    <div class="w-[1019px] py-2 border-b flex text-inter text-sm">
                        <p class="w-56 min-h-max px-2">{{$req->emp_id}}</p>
                        <p class="w-48 min-h-max px-3">{{$req->first_name}} {{$req->last_name}}</p>
                        <p class="w-60 min-h-max px-1">{{$req->documents}}</p>
                        <p class="w-56 min-h-max px-1">{{$req->purpose}}</p>
                        <!-- for pm -->
                        <div class="w-32 ml-3 flex justify-end">
                            <a href="{{route('notify-employee', $req->emp_id)}}" class="w-10 h-6 mr-3 bg-green-600 border border-gray-500 rounded flex justify-center items-center">
                                <svg class="ms-0 -me-0 h-4 w-4" fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 611.999 611.999" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M570.107,500.254c-65.037-29.371-67.511-155.441-67.559-158.622v-84.578c0-81.402-49.742-151.399-120.427-181.203 C381.969,34,347.883,0,306.001,0c-41.883,0-75.968,34.002-76.121,75.849c-70.682,29.804-120.425,99.801-120.425,181.203v84.578 c-0.046,3.181-2.522,129.251-67.561,158.622c-7.409,3.347-11.481,11.412-9.768,19.36c1.711,7.949,8.74,13.626,16.871,13.626 h164.88c3.38,18.594,12.172,35.892,25.619,49.903c17.86,18.608,41.479,28.856,66.502,28.856 c25.025,0,48.644-10.248,66.502-28.856c13.449-14.012,22.241-31.311,25.619-49.903h164.88c8.131,0,15.159-5.676,16.872-13.626 C581.586,511.664,577.516,503.6,570.107,500.254z M484.434,439.859c6.837,20.728,16.518,41.544,30.246,58.866H97.32 c13.726-17.32,23.407-38.135,30.244-58.866H484.434z M306.001,34.515c18.945,0,34.963,12.73,39.975,30.082 c-12.912-2.678-26.282-4.09-39.975-4.09s-27.063,1.411-39.975,4.09C271.039,47.246,287.057,34.515,306.001,34.515z M143.97,341.736v-84.685c0-89.343,72.686-162.029,162.031-162.029s162.031,72.686,162.031,162.029v84.826 c0.023,2.596,0.427,29.879,7.303,63.465H136.663C143.543,371.724,143.949,344.393,143.97,341.736z M306.001,577.485 c-26.341,0-49.33-18.992-56.709-44.246h113.416C355.329,558.493,332.344,577.485,306.001,577.485z"></path> <path d="M306.001,119.235c-74.25,0-134.657,60.405-134.657,134.654c0,9.531,7.727,17.258,17.258,17.258 c9.531,0,17.258-7.727,17.258-17.258c0-55.217,44.923-100.139,100.142-100.139c9.531,0,17.258-7.727,17.258-17.258 C323.259,126.96,315.532,119.235,306.001,119.235z"></path>
                                </svg>
                            </a>
                            @if(strtolower($req->documents) == 'certificate of employment')
                            <a href="{{route('export-document', $req->emp_id)}}" class="w-10 h-6 mr-3 bg-purple-600 rounded flex justify-center items-center">
                                <svg class="ms-0 -me-0 h-6 w-6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 18C16 16.6667 15.7778 15.5 15.5556 15.3333C15.3333 15.1667 13.7778 15 12 15C10.2222 15 8.66667 15.1667 8.44444 15.3333C8.22222 15.5 8 16.6667 8 18M16 18C16 19.3333 15.7778 20.5 15.5556 20.6667C15.3333 20.8333 13.7778 21 12 21C10.2222 21 8.66667 20.8333 8.44444 20.6667C8.22222 20.5 8 19.3333 8 18M16 18C16 18 19.5 17.75 20 17.5C20.5 17.25 21 15.5 21 13.5C21 11.5 20.5 9.75 20 9.5C19.6796 9.33977 18.1268 9.17955 16 9.08514M8 18C8 18 4.5 17.75 4 17.5C3.5 17.25 3 15.5 3 13.5C3 11.5 3.5 9.75 4 9.5C4.32045 9.33977 5.87316 9.17955 8 9.08514M8 9.08514C9.19168 9.03224 10.5636 9 12 9C13.4364 9 14.8083 9.03224 16 9.08514M8 9.08514V7C8 5.22222 8.22222 3.66667 8.44444 3.44444C8.66667 3.22222 10.2222 3 12 3C13.7778 3 15.3333 3.22222 15.5556 3.44444C15.7778 3.66667 16 5.22222 16 7V9.08514" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            @elseif(strtolower($req->documents) == 'certificate of employment w/ compensation')
                            <a href="{{route('export-document-w-compensation', $req->emp_id)}}" class="w-10 h-6 mr-3 bg-purple-600 rounded flex justify-center items-center">
                                <svg class="ms-0 -me-0 h-6 w-6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 18C16 16.6667 15.7778 15.5 15.5556 15.3333C15.3333 15.1667 13.7778 15 12 15C10.2222 15 8.66667 15.1667 8.44444 15.3333C8.22222 15.5 8 16.6667 8 18M16 18C16 19.3333 15.7778 20.5 15.5556 20.6667C15.3333 20.8333 13.7778 21 12 21C10.2222 21 8.66667 20.8333 8.44444 20.6667C8.22222 20.5 8 19.3333 8 18M16 18C16 18 19.5 17.75 20 17.5C20.5 17.25 21 15.5 21 13.5C21 11.5 20.5 9.75 20 9.5C19.6796 9.33977 18.1268 9.17955 16 9.08514M8 18C8 18 4.5 17.75 4 17.5C3.5 17.25 3 15.5 3 13.5C3 11.5 3.5 9.75 4 9.5C4.32045 9.33977 5.87316 9.17955 8 9.08514M8 9.08514C9.19168 9.03224 10.5636 9 12 9C13.4364 9 14.8083 9.03224 16 9.08514M8 9.08514V7C8 5.22222 8.22222 3.66667 8.44444 3.44444C8.66667 3.22222 10.2222 3 12 3C13.7778 3 15.3333 3.22222 15.5556 3.44444C15.7778 3.66667 16 5.22222 16 7V9.08514" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            @endif    
                        </div>
                        <!-- -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-admin-layout>