<div wire:poll.500s="fetchLowStockProducts">
    <!-- Notification Button -->
    <div class="relative">
        <button wire:click="toggleModal" class="relative flex items-center px-1">
            <x-hugeicons-notification-02 class="w-5 h-5" />
            
            @if ($hasNotification)
                <span class="absolute top-0 right-1 w-2 h-2 bg-red-500 rounded-full animate-ping"></span>
            @endif
        </button>
    </div>

    <!-- Notification Modal in Top Right Corner -->
    @if ($showModal)
        <div class="fixed top-16 right-4 w-96 bg-white rounded-lg shadow-lg z-50 border border-gray-300">
            <div class="flex justify-between items-center px-4 py-3 bg-gray-100 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Low Stock Alerts</h3>
            </div>

            <div class="p-4">
                <p class="text-gray-700 mb-2 text-sm">The following products are running low:</p>
                <ul class="space-y-2 max-h-60 overflow-y-auto">
                    @foreach ($lowStockProducts as $product)
                        <li class="flex items-center justify-between px-3 py-2 bg-red-100 rounded-md border border-red-300">
                            <span class="text-sm font-semibold text-gray-900">{{ $product->name }}</span>
                            <span class="text-red-600 font-bold">Stock is {{ $product->stock }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="p-4 flex justify-end border-t">
                <button class="bg-black hover:bg-gray-600 text-white px-4 py-2 rounded-md"
                        wire:click="toggleModal">Close</button>
            </div>
        </div>
    @endif
</div>
