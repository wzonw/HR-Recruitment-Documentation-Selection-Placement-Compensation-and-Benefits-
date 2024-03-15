<div>
    <x-button-gold class="mx-2 w-28" wire:confirm="Are you sure you want to apply?" wire:click="toggleApp">
        Apply
    </x-button-gold>
    <a  class="bg-gray-800 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs font-inter uppercase" 
        href="{{ route('jobs-available') }}">
        back
    </a>
</div>