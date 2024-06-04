<!--Profile-->
<div class="w-screen inline-flex">
    <div class="relative opacity-30">
        <img class="relative h-36 w-screen object-cover object-top" src="https://plm.edu.ph/images/banners/hero-banner-facade.jpg" />
    </div>
    <div class="absolute px-8 py-14">
        <livewire:UserProfile :applicant="$applicant"/>
    </div>
    <div class="absolute end-5 pt-24">
        <p class="min-w-max h-9 inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-400 rounded-md font-medium text-sm 
                text-gray-400 font-inter">
            {{$applicant->remarks}}
        </p>
    </div>
</div>