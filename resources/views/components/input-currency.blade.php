@props(['disabled' => false])

<div x-data="{
        rawValue: @entangle($attributes->wire('model')),
        formattedValue: '',
        formatCurrency(value) {
            // Handle string or number input
            let num = typeof value === 'string' ? value.replace(/\D/g, '') : value.toString();
            // Keep original number without parsing to preserve leading zeros
            return num ? 'Rp ' + num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
        }
    }"
    x-init="formattedValue = formatCurrency(rawValue)"
    class="relative w-full">
    
    <!-- Icon -->
    @if ($slot->isNotEmpty())
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            {{ $slot }}
        </span>
    @endif

    <!-- Input Field -->
    <input 
        type="text"
        {{ $disabled ? 'disabled' : '' }} 
        x-model="formattedValue"
        x-on:input="
            rawValue = $event.target.value.replace(/\D/g, '');
            formattedValue = formatCurrency(rawValue);"
        x-on:blur="formattedValue = formatCurrency(rawValue);"
        x-on:focus="formattedValue = rawValue;"
        wire:model.defer="{{ $attributes->wire('model')->value() }}"
        {!! $attributes->merge([
            'class' => 'border-gray-400 focus:border-gray-500 focus:ring-black rounded-md w-full' . 
            ($slot->isNotEmpty() ? ' pl-10' : '')
        ]) !!}>
</div>