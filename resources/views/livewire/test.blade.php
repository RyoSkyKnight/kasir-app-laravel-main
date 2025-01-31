<div>
   
    <div class="p-6 text-center">
        <x-slot name="header">
            {{ __('Test') }}
        </x-slot>
        <h1 class="text-lg font-bold">Livewire Test</h1>
        <p class="text-2xl">{{ $count }}</p>
    
        <button wire:click="increment" class="px-4 py-2 bg-blue-500 text-white rounded">
            Click to Increase
        </button>
    </div>
   
    
</div>
