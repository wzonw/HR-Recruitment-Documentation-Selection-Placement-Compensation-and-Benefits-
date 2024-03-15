<div class="w-56 h-screen bg-indigo-800">
    @can('for-admins')
    <a class="w-56 h-16 flex hover:bg-indigo-650" href="{{ route('hr.dashboard.index') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-7 -8 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path d="M13 12C13 11.4477 13.4477 11 14 11H19C19.5523 11 20 11.4477 20 12V19C20 19.5523 19.5523 20 19 20H14C13.4477 20 13 19.5523 13 19V12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 5C4 4.44772 4.44772 4 5 4H9C9.55228 4 10 4.44772 10 5V12C10 12.5523 9.55228 13 9 13H5C4.44772 13 4 12.5523 4 12V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 17C4 16.4477 4.44772 16 5 16H9C9.55228 16 10 16.4477 10 17V19C10 19.5523 9.55228 20 9 20H5C4.44772 20 4 19.5523 4 19V17Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M13 5C13 4.44772 13.4477 4 14 4H19C19.5523 4 20 4.44772 20 5V7C20 7.55228 19.5523 8 19 8H14C13.4477 8 13 7.55228 13 7V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <p class="mt-5 ml-[-5px] w-36 text-white text-sm font-bold font-inter "> Dashboard </p>
    </a>

    <p class="mt-9 ml-4 text-slate-200 text-opacity-70 text-sm font-normal font-inter">
        Personnel Management
    </p>

    <a class="mt-5 w-56 h-14 flex hover:bg-indigo-650" href="{{ route('view-employee-list') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> View Employee List </p>
    </a>

    <a class="w-56 h-14 flex hover:bg-indigo-650" href="{{ route('view-request') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> View Request </p>
    </a>
    @endif

    @can('for-recruitment')
    <a class="w-56 h-16 flex hover:bg-indigo-650" href="{{ route('r.dashboard.index') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-7 -8 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path d="M13 12C13 11.4477 13.4477 11 14 11H19C19.5523 11 20 11.4477 20 12V19C20 19.5523 19.5523 20 19 20H14C13.4477 20 13 19.5523 13 19V12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 5C4 4.44772 4.44772 4 5 4H9C9.55228 4 10 4.44772 10 5V12C10 12.5523 9.55228 13 9 13H5C4.44772 13 4 12.5523 4 12V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 17C4 16.4477 4.44772 16 5 16H9C9.55228 16 10 16.4477 10 17V19C10 19.5523 9.55228 20 9 20H5C4.44772 20 4 19.5523 4 19V17Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M13 5C13 4.44772 13.4477 4 14 4H19C19.5523 4 20 4.44772 20 5V7C20 7.55228 19.5523 8 19 8H14C13.4477 8 13 7.55228 13 7V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <p class="mt-5 ml-[-5px] w-36 text-white text-sm font-bold font-inter "> Dashboard </p>
    </a>

    <p class="mt-9 ml-4 text-slate-200 text-opacity-70 text-sm font-normal font-inter">
        Talent Acquisition
    </p>

    <a class="mt-5 w-56 h-14 flex hover:bg-indigo-650" href="{{ route('job-posting') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> Job Posting </p>
    </a>

    <a class="w-56 h-14 flex hover:bg-indigo-650" href="{{ route('applicant-list') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> Applicant List </p>
    </a>
    @endif

    @can('for-compensation')
    <a class="w-56 h-16 flex hover:bg-indigo-650" href="{{ route('c.dashboard.index') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-7 -8 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path d="M13 12C13 11.4477 13.4477 11 14 11H19C19.5523 11 20 11.4477 20 12V19C20 19.5523 19.5523 20 19 20H14C13.4477 20 13 19.5523 13 19V12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 5C4 4.44772 4.44772 4 5 4H9C9.55228 4 10 4.44772 10 5V12C10 12.5523 9.55228 13 9 13H5C4.44772 13 4 12.5523 4 12V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 17C4 16.4477 4.44772 16 5 16H9C9.55228 16 10 16.4477 10 17V19C10 19.5523 9.55228 20 9 20H5C4.44772 20 4 19.5523 4 19V17Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M13 5C13 4.44772 13.4477 4 14 4H19C19.5523 4 20 4.44772 20 5V7C20 7.55228 19.5523 8 19 8H14C13.4477 8 13 7.55228 13 7V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <p class="mt-5 ml-[-5px] w-36 text-white text-sm font-bold font-inter "> Dashboard </p>
    </a>

    <p class="mt-9 ml-4 text-slate-200 text-opacity-70 text-sm font-normal font-inter">
        Compensation and Benefits
    </p>

    <a class="mt-5 w-56 h-14 flex hover:bg-indigo-650" href="{{ route('leave-request') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> Leave Request </p>
    </a>

    <a class="w-56 h-14 flex hover:bg-indigo-650" href="{{ route('leave-list') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> Leave List </p>
    </a>

    <a class="w-56 h-14 flex hover:bg-indigo-650" href="{{ route('time-keeping') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> Time Keeping </p>
    </a>

    <a class="w-56 h-14 flex hover:bg-indigo-650" href="{{ route('leave-credit') }}" :active="request()->routeIs('dashboard')">
        <svg viewBox="-5 -4 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <path id="Vector" d="M21 19.9999C21 18.2583 19.3304 16.7767 17 16.2275M15 20C15 17.7909 12.3137 16 9 16C5.68629 16 3 17.7909 3 20M15 13C17.2091 13 19 11.2091 19 9C19 6.79086 17.2091 5 15 5M9 13C6.79086 13 5 11.2091 5 9C5 6.79086 6.79086 5 9 5C11.2091 5 13 6.79086 13 9C13 11.2091 11.2091 13 9 13Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <p class="mt-4 w-36 text-white text-sm font-bold font-inter "> Leave Credit </p>
    </a>
    @endif


</div>

