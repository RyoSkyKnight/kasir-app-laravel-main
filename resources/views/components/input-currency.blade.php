@props(['disabled' => false, 'id' => 'currencyInput', 'model' => ''])

<div x-data="{
    rawValue: @entangle($attributes->wire('model')),
    formattedValue: '',
    
    formatCurrency(value) {
        // Hanya angka, hapus karakter non-numeric
        let num = value.toString().replace(/\D/g, '');
        return num ? 'Rp ' + num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
    }
}"
x-init="formattedValue = formatCurrency(rawValue)"
x-effect="formattedValue = formatCurrency(rawValue)"
class="relative w-full">

    <!-- Icon (Jika Ada Slot) -->
    @if ($slot->isNotEmpty())
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            {{ $slot }}
        </span>
    @endif

    <!-- Input Field (Display dengan Rp) -->
    <input 
        type="text"
        placeholder="Rp 0"
        {{ $disabled ? 'disabled' : '' }} 
        x-model="formattedValue"
        x-on:input="
            rawValue = $event.target.value.replace(/\D/g, '');
            formattedValue = formatCurrency(rawValue);
        "
        x-on:blur="formattedValue = formatCurrency(rawValue);"
        wire:ignore
        class="currencyInput border-gray-400 focus:border-gray-500 focus:ring-black rounded-md w-full {{ $slot->isNotEmpty() ? ' pl-10' : '' }}"
    >

    <!-- Hidden Input (Menyimpan nilai asli numerik) -->
    <input 
        type="hidden"
        id="{{ $id }}"
        wire:model="{{ $model }}"
    >

</div>

<script>
    function formatCurrency(input) {
        let value = input.value.replace(/\D/g, ""); // Hapus karakter non-numeric
        let formatted = new Intl.NumberFormat('id-ID').format(value); // Format angka dengan titik
        input.value = value ? "Rp " + formatted : ""; // Tambahkan Rp di depan
    }
</script>
