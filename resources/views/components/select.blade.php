@props(['disabled' => false, 'options' => []])

<div class="relative w-full">
    <!-- Icon (if provided via slot) -->
    @if ($slot->isNotEmpty())
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 mt-2">
            {{ $slot }}
        </span>
    @endif

    <!-- Select Field -->
    <select id="{{ $attributes->get('id') }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'border-gray-400 focus:border-gray-500 focus:ring-black rounded-md w-full py-2 bg-white pr-8 appearance-none' .
            ($slot->isNotEmpty() ? ' pl-10' : ''), // Add padding if an icon exists
    ]) !!}>

        <option value="" disabled selected>Select an option</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
</div>
