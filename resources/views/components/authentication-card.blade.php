<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
    <div class="relative w-screen h-screen" style="background-color:#2D349A;">
        <img class="w-screen h-screen opacity-20" src="https://plm.edu.ph/images/banners/hero-banner-facade.jpg" />
    </div>
    <div class="absolute w-96 flex flex-col sm:justify-center items-center sm:pt-0 bg-white rounded-[3px] shadow shadow-black">
        <div class="pt-4">
            {{ $logo }}
        </div>
        
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
