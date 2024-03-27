<x-admin-layout>
<div class="flex relative">
<div>
<div class="flex">
    <div class="w-[209px] h-[332px] my-4 mx-4 relative">
        <div class="w-[209px] h-[337px] left-0 top-0 absolute bg-white shadow shadow-gray-400"></div>
        <div class="w-[209px] h-[134px] left-0 top-0 absolute bg-gradient-to-b from-yellow-600">
            <img class=" opacity-20 " src="https://www.plm.edu.ph/images/banners/2020-PLM-facade.jpg"/>
        </div>
        <div class="ml-4">
            <div class="min-w-max h-10 top-[200px] absolute text-black text-base font-semibold font-'Inter'"> {{ Auth::user()->name ." ".Auth::user()->suffix }} </div>
            @if (Auth::user()->role_id==2)
                <div class="w-[190px] h-6 top-64 absolute text-black text-sm font-semibold font-'Inter'">Section : Personnel Management</div>
            @else
                @if (Auth::user()->role_id==3)
                    <div class="w-[190px] h-6 top-[249px] absolute text-black text-[13px] font-semibold font-'Inter'">Section : Recruitment</div>
                @else
                    <div class="w-[190px] h-6 top-[249px] absolute text-black text-[13px] font-semibold font-'Inter'">Section : Compensation & Benefits</div>
                @endif
            @endif
                <div class="w-[115px] h-[21px] top-[230px] absolute text-neutral-950 text-opacity-50 text-[13px] font-normal font-'Inter'">Administrator</div>
        </div>
        <div class="w-[125px] h-[125px] left-[36px] top-[54px] absolute bg-zinc-300 rounded-full"></div>
        <div class="w-[93px] h-[95px] left-[52px] top-[69px] absolute">
            <img class="w-[93px] h-[95px] left-0 top-0 absolute" src="https://www.plm.edu.ph/images/Seal/PLM_Seal_BOR-approved_2014.png" />
        </div>
    </div>

    <div>
        <div class="w-[308px] h-[102px] my-4 relative">
            <div class="w-[306px] h-[102px] left-0 top- absolute bg-yellow-600 rounded-[10px] shadow"></div>
            <div class="w-[94px] h-[63px] left-[214px] top-[17px] absolute bg-yellow-700 rounded-[10px] shadow-md "></div>
            <div class="w-[94px] h-[31px] left-[214px] top-[35px] absolute text-center text-white text-2xl font-semibold font-'Inter'">10</div>
            <div class="w-[191px] h-[45px] left-[17px] top-[24px] absolute text-white text-lg font-bold font-['Inter'">Employee Document Requests</div>
        </div>

        <div class="w-[309px] h-[102px] mb-4 relative">
            <div class="w-[306px] h-[102px] left-0 top-0 absolute bg-indigo-700 rounded-[10px] shadow"></div>
            <div class="w-[94px] h-[63px] left-[215px] top-[19px] absolute bg-indigo-800 rounded-[10px] shadow-md"></div>
            <div class="w-[94px] h-[27px] left-[215px] top-[37px] absolute text-center text-white text-2xl font-semibold font-'Inter'">{{ $num_applicants }}</div>
            <div class="w-[191px] h-[33px] left-[17px] top-[37px] absolute text-white text-lg font-bold font-'Inter'">Current Applicants</div>
        </div>

        <div class="w-[308px] h-[102px] relative">
            <div class="w-[306px] h-[102px] left-0 top-0 absolute bg-red-700 rounded-[10px] shadow"></div>
            <div class="w-[94px] h-[63px] left-[214px] top-[19px] absolute bg-red-800 rounded-[10px] shadow-md"></div>
            <div class="w-[94px] h-[27px] left-[214px] top-[37px] absolute text-center text-white text-2xl font-semibold font-'Inter'">{{ $num_onleave }}</div>
            <div class="w-[191px] h-[33px] left-[17px] top-[32px] absolute text-white text-lg font-bold font-'Inter'">Employees On Leaves</div>
        </div>
    </div>
</div>


    <div class="mx-4 shadow shadow-gray-300">
        <div class="w-[527px] h-[250px] relative font-'Inter'">
            <div class="w-[527px] h-[250px] left-0 top-0 absolute bg-white shadow"></div>
            <div class="w-[233px] h-[42px] left-[20px] top-[19px] absolute text-yellow-600 text-xl font-bold ">Quick Links</div>
            <div class="w-[99px] h-[27px] left-[53px] top-[72px] absolute text-right text-neutral-950 text-base font-normal">PLM Website</div>
            <a href="https://www.plm.edu.ph/" class="w-[147px] h-[26px] left-[186px] top-[72px] absolute text-yellow-600 text-opacity-80 text-base font-normal">plm.edu.ph</a>
            <div class="w-[148px] h-[27px] left-[186px] top-[113px] absolute text-yellow-600 text-opacity-80 text-base font-normal">link.com</div>
            <a href="https://www.plm.edu.ph/careers-hrdo" class="w-56 h-[27px] left-[186px] top-[155px] absolute text-yellow-600 text-opacity-80 text-base font-normal">plm.edu.ph/careers-hrdo</a>
            <div class="w-[132px] h-[27px] left-[20px] top-[109px] absolute text-right text-neutral-950 text-base font-normal">HR Request Form</div>
            <div class="w-[123px] h-[27px] left-[29px] top-[143px] absolute text-right text-neutral-950 text-base font-normal">PLM Application Site</div>
        </div>
    </div>
</div>

    
   <div class="w-[599px] h-[594px] my-4 relative">
        <div class="w-[599px] h-[594px] left-0 top-0 absolute bg-white shadow shadow-gray-400 border border-black">
            <div class="font-'Inter'" >
                <div class="w-[558px] h-[57px] left-[16px] top-[17px] absolute bg-indigo-800 flex items-center">
                    <h1 class="text-indigo-50 text-2xl font-bold pl-9">PLM Careers!</h1>
                </div>
                <div class="w-64 left-[33px] top-[93px] absolute text-black text-[15px] font-semibold over">
                    Part Time
                    <div class=" font-normal mt-2">
                        @foreach($part_time as $pt)
                        <p class="mt-2">
                            <span class="font-bold">{{$pt->college}} | </span>
                            <span class="text-yellow-600 ">{{$pt->job_name}}</span>
                        </p>
                        <div class="ml-3">
                                    <p>Status: {{ $pt->status }} </p>
                                    <p>Deadline: {{ $pt->deadline }} </p>
                                </div> 
                        @endforeach
                    </div>
                </div>
                <div class="w-64 left-[322px] top-[93px] absolute text-black text-[15px] font-semibold">
                    Full Time
                    <div class=" font-normal mt-2">
                        @foreach($full_time as $ft)
                        <p class="mt-2">
                            <span class="font-bold">{{$ft->college}} | </span>
                            <span class="text-yellow-600 ">{{$ft->job_name}}</span>
                        </p>
                        <div class="ml-3">
                                    <p>Status: {{ $ft->status }} </p>
                                    <p>Deadline: {{ $ft->deadline }} </p>
                                </div> 
                        @endforeach
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
</div>


</x-admin-layout>