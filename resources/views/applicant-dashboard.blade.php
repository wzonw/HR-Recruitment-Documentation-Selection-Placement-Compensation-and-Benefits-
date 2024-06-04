<x-app-layout>
    <div class=" space-y-10">
        <!--Profile-->
        <livewire:user-profile-cover :applicant="$applicant"/>

        <!-- File Cabinet -->
        <div class="pt-10 px-8 inline-flex space-x-16">
            <livewire:FileCabinet :applicant="$applicant"/>
            @if($applicant->remarks == 'Requirements')
            <livewire:AddFile />
            @endif
        </div>
    </div>
</x-app-layout>