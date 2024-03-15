<nav x-data="{ open: false }" class="h-20 bg-white border-b border-black ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-1">
        <div class="flex justify-between h-12 ">
            <div class="flex mt-1 ">
                <!-- Logo -->
                <div>
                    <div class="relative h-16 ml-[-55px]">
                        <img class="h-16" src="https://www.plm.edu.ph/images/ui/plm-logo--with-header.png"/>
                    </div>
                    <p class="absolute top-12 left-[70px] px-1 py-1 h-3 uppercase text-yellow-550 font-black text-[10px] font-inter">
                        Human Resources Information System
                    </p>
                </div>  
                
                <div class="w-[450px] h-8 object-center top-6 px-8 left-1/3 mx-5 absolute">
                    <img class="w-8 h-8 absolute left-0" src="https://icon-library.com/images/arrow-left-icon/arrow-left-icon-14.jpg">
                    <input class="w-96 h-[34px] absolute text-center bg-gray-200 rounded-[15px]" placeholder="Search">
                        <img class="w-10 h-8 absolute" src="https://icon-library.com/images/black-search-icon-png/black-search-icon-png-12.jpg">
                    <img class="w-8 h-8 absolute right-1" src="https://cdn2.iconfinder.com/data/icons/arrows-part-1/32/tiny-arrow-right-1-512.png">
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Settings Dropdown -->
                <div class="ms-3 relative start-9">
                    <x-dropdown align="right" width="48" class="">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py- mt-6 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white focus:outline-none transition ease-in-out duration-150">
                                        <img class="h-8 w-8 mt-3 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        <div class="ml-2 text-black font-bold">
                                            {{ Auth::user()->name ." ". Auth::user()->surname }}               
                                        </div>
                                        @if(Auth::user()->role_id != 2)
                                        <p class="ml-10 absolute mt-9">Administrator</p>
                                        @endif
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-base font-bold text-indigo-800 leading-loose">
                                {{ Auth::user()->name . " " . Auth::user()->surname }}
                            </div>
                            
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Employee Portal') }}
                            </div>

                            <x-dropdown-link href="{{ route('dashboard') }}">
                                {{ __('Go To Employee Portal') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();" class="text-red-700 font-bold font-inter">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
