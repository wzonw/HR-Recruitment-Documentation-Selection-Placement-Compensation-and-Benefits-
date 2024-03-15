<!--Profile-->
<div class=" inline-flex">
    <div class="relative opacity-30">
        <img class="relative h-36 w-screen object-cover object-top" src="https://plm.edu.ph/images/banners/hero-banner-facade.jpg" />
    </div>
    <div class="absolute px-8 my-20">
        <div class="justify-center items-center inline-flex space-x-3">
            <!--profile pic-->
            <div class="inline-flex justify-center items-center">
                <div class="relative w-40 h-40 bg-gray-100 rounded-full"></div>
                <div class="absolute w-36 h-36 flex-col justify-center items-center inline-flex">
                    <img class="w-36 h-36" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/1024px-Windows_10_Default_Profile_Picture.svg.png" />
                </div>
            </div>
            <div class="mt-16">
                <!-- Applicant name, status button -->
                <div class="items-baseline space-y-3">
                    <p class="w-fit min-h-max  text-indigo-800 text-3xl font-bold font-inter">
                        {{ $user->name }}
                    </p>
                    <div class="inline-flex space-x-5">
                        <p class="min-w-max h-5 text-black text-base font-medium font-inter">
                            {{ $job->status }}
                        </p>
                        <p class="min-w-max h-5 text-black text-base font-medium font-inter">
                            |
                        </p>
                        <p class="min-w-max h-5 text-yellow-600 text-base font-medium font-inter">
                            {{ $job->job_name }}
                        </p>
                    </div>
                    <div>
                        <div class="inline-flex">
                            <p class="min-w-max h-5 text-black text-base font-medium font-inter">
                                {{ $job->dept }} Department
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
