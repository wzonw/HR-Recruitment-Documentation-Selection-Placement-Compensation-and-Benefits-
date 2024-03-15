<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center py-2 bg-blue-900 border border-transparent rounded-md font-semibold text-xs text-white text-center font-inter uppercase tracking-widest hover:bg-indigo-650 focus:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
