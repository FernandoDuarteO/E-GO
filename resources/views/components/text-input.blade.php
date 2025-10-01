@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'bg-white text-black border-black focus:border-black focus:ring-black rounded-md shadow-sm'
]) }}>
