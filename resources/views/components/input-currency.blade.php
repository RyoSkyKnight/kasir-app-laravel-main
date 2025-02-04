@props(['disabled' => false, 'id' => 'currencyInput'])

<div class="relative w-full">
    
    <!-- Icon -->
    @if ($slot->isNotEmpty())
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            {{ $slot }}
        </span>
    @endif

    <!-- Input Field -->
    <input 
        type="text"
        id="{{ $id }}"
        class="currencyInput border-gray-400 focus:border-gray-500 focus:ring-black rounded-md w-full {{ $slot->isNotEmpty() ? ' pl-10' : '' }}"
        {{ $disabled ? 'disabled' : '' }}
        oninput="formatCurrency(this)"
        wire:model.defer="{{ $attributes->wire('model')->value() }}">
</div>
<script>
    function formatCurrency(input) {
        let value = input.value.replace(/\D/g, ""); // Hapus karakter non-numeric
        let formatted = new Intl.NumberFormat('id-ID').format(value); // Format angka dengan titik
        input.value = value ? "Rp " + formatted : ""; // Tambahkan Rp di depan
    }
</script>
