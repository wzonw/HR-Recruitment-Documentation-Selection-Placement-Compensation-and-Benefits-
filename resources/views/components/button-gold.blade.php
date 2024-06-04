<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center py-2 bg-gold-100 border border-transparent rounded-md font-semibold text-xs text-white text-center font-inter uppercase tracking-widest hover:bg-gold focus:bg-gold-100 active:bg-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-100 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
