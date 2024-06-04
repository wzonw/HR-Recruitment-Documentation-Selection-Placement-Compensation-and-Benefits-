<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">
            <div class="flex">


                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('applicant-dashboard') }}" :active="request()->routeIs('applicant-dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @can('for-applicants')
                    <x-nav-link href="{{ route('application-section') }}" :active="request()->routeIs('application-section')">
                        {{ __('Application') }}
                    </x-nav-link>
                    @endif
                </div>

                @can('for-applicants')
                <div class="flex items-center ml-5">
                    <x-dropdown align="right" width="72">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    <svg class="ms-2 -me-0.5 h-4 w-4" fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 611.999 611.999" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M570.107,500.254c-65.037-29.371-67.511-155.441-67.559-158.622v-84.578c0-81.402-49.742-151.399-120.427-181.203 C381.969,34,347.883,0,306.001,0c-41.883,0-75.968,34.002-76.121,75.849c-70.682,29.804-120.425,99.801-120.425,181.203v84.578 c-0.046,3.181-2.522,129.251-67.561,158.622c-7.409,3.347-11.481,11.412-9.768,19.36c1.711,7.949,8.74,13.626,16.871,13.626 h164.88c3.38,18.594,12.172,35.892,25.619,49.903c17.86,18.608,41.479,28.856,66.502,28.856 c25.025,0,48.644-10.248,66.502-28.856c13.449-14.012,22.241-31.311,25.619-49.903h164.88c8.131,0,15.159-5.676,16.872-13.626 C581.586,511.664,577.516,503.6,570.107,500.254z M484.434,439.859c6.837,20.728,16.518,41.544,30.246,58.866H97.32 c13.726-17.32,23.407-38.135,30.244-58.866H484.434z M306.001,34.515c18.945,0,34.963,12.73,39.975,30.082 c-12.912-2.678-26.282-4.09-39.975-4.09s-27.063,1.411-39.975,4.09C271.039,47.246,287.057,34.515,306.001,34.515z M143.97,341.736v-84.685c0-89.343,72.686-162.029,162.031-162.029s162.031,72.686,162.031,162.029v84.826 c0.023,2.596,0.427,29.879,7.303,63.465H136.663C143.543,371.724,143.949,344.393,143.97,341.736z M306.001,577.485 c-26.341,0-49.33-18.992-56.709-44.246h113.416C355.329,558.493,332.344,577.485,306.001,577.485z"></path> <path d="M306.001,119.235c-74.25,0-134.657,60.405-134.657,134.654c0,9.531,7.727,17.258,17.258,17.258 c9.531,0,17.258-7.727,17.258-17.258c0-55.217,44.923-100.139,100.142-100.139c9.531,0,17.258-7.727,17.258-17.258 C323.259,126.96,315.532,119.235,306.001,119.235z"></path>
                                    </svg>

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>
                        <x-slot name="contentClasses">bg-white w-80</x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-base font-bold text-gray-400">
                                {{ __('Notifications') }}
                            </div>
                            @forelse (Auth::user()->notifications as $notification)
                                <!-- For application status -->
                                @if(isset($notification->data['remarks']))
                                <p class="px-4 py-2 font-inter text-sm">
                                    Your status has been changed into: <span class="italic">{{$notification->data['remarks']}}</span> 
                                    <br>
                                    <!-- time difference -->
                                    <span class="text-xs">
                                        @if( NOW()->diffInHours($notification->created_at) == 0)
                                            @if(NOW()->diffInMinutes($notification->created_at) >= 1)
                                                <!-- mins -->
                                                {{NOW()->diffInMinutes($notification->created_at)}} minutes ago
                                            @else
                                                <!-- sec -->
                                                A few seconds ago
                                            @endif
                                        @elseif( NOW()->diffInHours($notification->created_at) == 1)
                                            <!-- 1hr --> 
                                            {{ NOW()->diffInHours($notification->created_at) }} hour ago
                                        @elseif( NOW()->diffInHours($notification->created_at) > 1 && NOW()->diffInHours($notification->created_at) < 24)
                                            <!-- 1 to 23hrs -->
                                            {{ NOW()->diffInHours($notification->created_at) }} hours ago
                                        @else
                                            <!-- day(s) -->
                                            @if(NOW()->diffInDays($notification->created_at) == 1)
                                                {{NOW()->diffInDays($notification->created_at)}} day ago
                                            @else
                                                {{NOW()->diffInDays($notification->created_at)}} days ago
                                            @endif
                                        @endif
                                    </span>
                                </p>
                                @endif
                                <!-- For file remarks/status -->
                                @if(isset($notification->data['file_remark']))
                                <p class="px-4 py-2 font-inter text-sm">
                                    @if($notification->data['file_remark'] == 'declined')
                                        Your file: <span class="italic"> {{$notification->data['file']}} </span> is now 
                                        <span class="font-bold">{{$notification->data['file_remark']}}</span>. Make sure to 
                                        upload new file.
                                    @else
                                        Your file: <span class="italic"> {{$notification->data['file']}} </span> is now 
                                        <span class="font-bold">{{$notification->data['file_remark']}}</span> 
                                    @endif
                                    <br>
                                    <!-- time difference -->
                                    @if( NOW()->diffInHours($notification->created_at) == 0)
                                        @if(NOW()->diffInMinutes($notification->created_at) >= 1)
                                            <!-- mins -->
                                            {{NOW()->diffInMinutes($notification->created_at)}} minutes ago
                                        @else
                                            <!-- sec -->
                                            A few seconds ago
                                        @endif
                                    @elseif( NOW()->diffInHours($notification->created_at) == 1)
                                        <!-- 1hr --> 
                                        {{ NOW()->diffInHours($notification->created_at) }} hour ago
                                    @elseif( NOW()->diffInHours($notification->created_at) > 1 && NOW()->diffInHours($notification->created_at) < 24)
                                        <!-- 1 to 23hrs -->
                                        {{ NOW()->diffInHours($notification->created_at) }} hours ago
                                    @else
                                        <!-- day(s) -->
                                        @if(NOW()->diffInDays($notification->created_at) == 1)
                                            {{NOW()->diffInDays($notification->created_at)}} day ago
                                        @else
                                            {{NOW()->diffInDays($notification->created_at)}} days ago
                                        @endif
                                    @endif
                                </p>
                                @endif
                            @empty
                            <p>
                                Sorry, empty
                            </p>
                            @endforelse
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif
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
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />

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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('applicant-dashboard') }}" :active="request()->routeIs('applicant-dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
