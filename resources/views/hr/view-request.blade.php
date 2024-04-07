<x-admin-layout>
    <div class="ml-3 mt-5">
        <div class="w-[1100px] h-20 rounded-lg shadow-md flex items-center justify-center space-x-96">
            <p class=" text-indigo-800 text-2xl font-extrabold font-inter">Employee Document Requests</p>
            <div class=" ">
                <img class="w-10 h-8 absolute" src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg">
                <input class="w-60 h-8 text-center bg-gray-100 rounded border-transparent shadow-md" placeholder="Search" >
            </div>
        </div>

        <div class="mt-5 w-[1100px] h-96 rounded-lg shadow-md">
            <div class="pt-5 ml-10 flex space-x-36 text-black text-sm font-medium font-inter">
                <p class="h-4">Employee ID</p>
                <p class="h-4">Name</p>
                <p class="h-4">Documents</p>
                <p class="pl-5 h-4">Purpose</p>
            </div>
            <div class="mt-3 ml-8">
                @foreach($requests as $req)
                    <div class="w-[1019px] py-2 border-b flex text-inter text-sm">
                        <p class="w-56 min-h-max px-2">{{$req->id}}</p>
                        <p class="w-48 min-h-max px-3">{{$req->name}}</p>
                        <p class="w-60 min-h-max px-1">{{$req->documents}}</p>
                        <p class="w-56 min-h-max px-1">{{$req->purpose}}</p>
                        <div class="w-32 ml-3 flex justify-end">
                            <button type="text" class="w-10 h-6 mr-3 bg-green-600 rounded flex justify-center items-center">
                            
                            </button>
                            <button type="text" class="w-10 h-6 mr-3 bg-purple-600 rounded flex justify-center items-center">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 18C16 16.6667 15.7778 15.5 15.5556 15.3333C15.3333 15.1667 13.7778 15 12 15C10.2222 15 8.66667 15.1667 8.44444 15.3333C8.22222 15.5 8 16.6667 8 18M16 18C16 19.3333 15.7778 20.5 15.5556 20.6667C15.3333 20.8333 13.7778 21 12 21C10.2222 21 8.66667 20.8333 8.44444 20.6667C8.22222 20.5 8 19.3333 8 18M16 18C16 18 19.5 17.75 20 17.5C20.5 17.25 21 15.5 21 13.5C21 11.5 20.5 9.75 20 9.5C19.6796 9.33977 18.1268 9.17955 16 9.08514M8 18C8 18 4.5 17.75 4 17.5C3.5 17.25 3 15.5 3 13.5C3 11.5 3.5 9.75 4 9.5C4.32045 9.33977 5.87316 9.17955 8 9.08514M8 9.08514C9.19168 9.03224 10.5636 9 12 9C13.4364 9 14.8083 9.03224 16 9.08514M8 9.08514V7C8 5.22222 8.22222 3.66667 8.44444 3.44444C8.66667 3.22222 10.2222 3 12 3C13.7778 3 15.3333 3.22222 15.5556 3.44444C15.7778 3.66667 16 5.22222 16 7V9.08514" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>    
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-admin-layout>