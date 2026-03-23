<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-800 to-[#d32f2f] border border-transparent rounded-md font-bold text-xs text-black uppercase tracking-widest hover:from-red-700 hover:to-red-500 focus:ring-2 focus:ring-[#d32f2f] focus:ring-offset-2 dark:focus:ring-offset-gray-800 shadow-[0_4px_10px_rgba(211,47,47,0.3)] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
