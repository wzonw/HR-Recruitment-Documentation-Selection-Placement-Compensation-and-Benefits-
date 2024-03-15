<x-admin-layout>
    <div>
        <livewire:emp-profile :user="$user" :job="$job"/>
        <div class="mt-36 ml-10">
            <livewire:about :user="$user" :job="$job"/>
        </div>
    </div>
</x-admin-layout>
