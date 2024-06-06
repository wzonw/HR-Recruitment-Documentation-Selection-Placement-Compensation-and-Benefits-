<x-guest-layout>
    <div>
        <div class="relative object-cover w-screen h-screen" style="background-color:#2D349A;">
            <img class="w-screen h-screen opacity-20" src="https://plm.edu.ph/images/banners/hero-banner-facade.jpg" />
            <div class="absolute inset-0 flex flex-col justify-center items-center">
                <div class="w-[550px] h-[450px] flex items-center flex-col sm:pt-0 bg-white rounded-[3px] border-2 border-black shadow shadow-black">
                    <div class="pt-4">
                        <img class="w-[390px] h-90px]" src="https://plm.edu.ph/images/ui/plm-logo--with-header.png">
                    </div> 
                    @if(session('message'))
                    <div class="w-full min-h-max mx-3 text-red-500 items-end italic"
                        x-data="{ show: true }" x-show="show" x-transition.opacity.out.duration.1500ms 
                        x-init="setTimeout(() => show = false, 3000)">
                        {{ session('message') }}
                    </div>
                    @endif
                    <form action="{{ route('applicant-login-success') }}" method="post">
                        @csrf
                        <div class="relative">
                            <div class="w-[421px] font-black h-12 text-indigo-800 text-[38px] ">
                                PLM APPLICANT LOGIN
                            </div>
                            <p class="w-[200px] pl-0 h-5 font-black object-none object-left text-indigo-800">Sign In</p>
                            <div class="{{ route('applicant-login-success') }}">
                                <div class="justify-start flex pt-4 ml-[-4px]">
                                    <x-input  placeholder="Email" id="email" name="email" class="h-[30px] w-[325px]">Email</x-input>
                                </div>
                                <div" class="justify-start flex pt-4 ml-[-4px]" >
                                    <x-input placeholder="Password" id="password" name="password"  class="h-[30px] w-[325px]" type="password" >Password</x-input> 
                                </div>
                                <div class="justify-center flex pt-4 ml-[-17px]">
                                    <x-button-blue class="ms-4 w-[200px]">
                                        {{ __('Log in') }}
                                    </x-button-blue>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
