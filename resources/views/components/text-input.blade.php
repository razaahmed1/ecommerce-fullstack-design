@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white border-gray-700 text-gray-300 focus:border-[#d32f2f] focus:ring-[#d32f2f] shadow-sm rounded-md']) }}>
