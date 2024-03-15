<div class="flex space-x-1">
    <div>
        <div class="w-80 h-10 bg-yellow-600 rounded shadow">
            <p class="text-center text-white text-3xl font-semibold font-">
                About
            </p>
        </div>
        <div class="w-80 h-56 border-l border-r border-b border-black">
            <div class="flex space-x-3">
                <p class="w-32 text-indigo-800 text-base text-right font-medium font-inter leading-loose">
                    Full Name:
                </p>
                <p class="w-32 min-h-max text-black text-base font-medium font-inter leading-loose">
                    {{ $user->name }}
                </p> 
            </div>
            <div class="flex space-x-3">
                <p class="w-32 text-indigo-800 text-base text-right font-medium font-inter leading-loose">
                    Employee ID:
                </p>
                <p class="w-32 min-h-max text-black text-base font-medium font-inter leading-loose">
                    {{ $user->id }}
                </p>                   
            </div>
            <div class="flex space-x-3">
                <p class="w-32 text-indigo-800 text-base text-right font-medium font-inter leading-loose">
                    Salary Grade:
                </p>
                <p class="w-32 min-h-max text-black text-base font-medium font-inter leading-loose">
                    Salary Grade
                </p>
            </div>
            <div class="flex space-x-3">
                <p class="w-32 text-indigo-800 text-base text-right font-medium font-inter leading-loose">
                    Monthly Salary:
                </p> 
                <p class="w-32 min-h-max text-black text-base font-medium font-inter leading-loose">
                    {{ $job->salary }}
                </p> 
            </div>
        </div>
    </div>
    <div>
        <div class="w-80 h-10 bg-indigo-900 rounded shadow">
            <p class="text-center text-white text-3xl font-semibold font-">
                Documents
            </p>
        </div>
        <div class="w-80 h-56 border-l border-r border-b border-black">
            <table class="ml-4 w-72 bg-white shadow border-black border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
                <thead class="bg-white h-2"></thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                        <th scope="row" class="px-6 py-3 font-medium  whitespace-nowrap">
                            Resume.pdf
                        </th>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 dark:border-black">
                        <th scope="row" class="px-6 py-3 font-medium  whitespace-nowrap">
                            text
                        </th>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-white even:bg-gray-50 even:dark:bg-slate-100 border-b dark:border-black">
                        <th scope="row" class="px-6 py-3 font-medium  whitespace-nowrap">
                            text
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <div class="w-80 h-10 bg-yellow-600 rounded shadow">
            <p class="text-center text-white text-3xl font-semibold font-">
                History of Leaves
            </p>
        </div>
        <div class="w-80 h-56 border-l border-r border-b border-black flex justify-center space-x-2">
            <p class="mt-3 text-black text-base font-semibold font-inter">Date:</p>
            <div class="mt-2">
                <x-input class="block mt-1 w-40 h-6" type="date" />
            </div>
            <div class="mt-3">
                <button type="text" class="w-20 h-6 bg-blue-600 rounded flex justify-center items-center">
                        <p class="text-white pl-1 text-xs font font-inter">filter</p>
                        <svg viewBox="-3 -3 32 32" fill="#ffffff" stroke="#ffffff">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> 
                            <line x1="4" y1="5" x2="16" y2="5" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line>
                            <line x1="4" y1="12" x2="10" y2="12" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> 
                            <line x1="14" y1="12" x2="20" y2="12" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> 
                            <line x1="8" y1="19" x2="20" y2="19" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> 
                            <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="18" cy="5" r="2"> </circle> 
                            <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="12" cy="12" r="2"> </circle> 
                            <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="6" cy="19" r="2">
                        </svg>
                </button>   
            </div>
        </div>
    </div>
</div>
