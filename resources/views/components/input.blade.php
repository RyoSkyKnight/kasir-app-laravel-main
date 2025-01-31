@props(['disabled' => false])

<div class="relative w-full -z-[0]">
    <!-- Icon -->
    @if ($slot->isNotEmpty())
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            {{ $slot }}
        </span>
    @endif

    <!-- Input Field -->
    <input 
        {{ $disabled ? 'disabled' : '' }} 
        {!! $attributes->merge([
            'class' => 'border-gray-400 focus:border-gray-500 focus:ring-black rounded-md w-full' . 
            ($slot->isNotEmpty() ? ' pl-10' : '') // Add padding if an icon exists
        ]) !!}>
</div>
