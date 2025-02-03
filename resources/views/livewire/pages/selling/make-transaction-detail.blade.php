<div>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-lg font-semibold">
            <span>
                <a href="{{ route('transaction') }}" wire:navigate>{{ __('Transaction Management') }}</a>
            </span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Create Transaction</span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Transaction</span>
        </div>
    </x-slot>

    <div class="w-full flex flex-col space-y-12">
        <!-- Transaction Card -->
        <x-card>
            <div class="flex flex-col space-y-6">
                <!-- Header Section -->
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Transaction</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Create a new transaction by selecting products and quantities.
                    </p>
                </div>

                <!-- Notification Alert -->
                <x-notification-alert />

                <!-- Product Selection Section -->
                <div class="flex flex-col space-y-6">
                    <form wire:submit.prevent="addToCart" class="flex flex-col space-y-6">
                        <div wire:ignore>
                            <x-label for="selectedProduct" value="Select Product" />
                            <select id="selectedProduct" 
                            name="selectedProduct" 
                            wire:model.defer="selectedProduct" 
                            x-data 
                            x-init="$nextTick(() => {  
                                $('#selectedProduct').select2({ 
                                    placeholder: 'Choose a product',
                                    width: '100%',
                                    height: '100%',
                                });
                                $('#selectedProduct').on('change', function () { 
                                    @this.set('selectedProduct', $(this).val()); 
                                });
                            })">
                        <option value="">Choose a product</option>
                        @foreach($products->where('status', 'Active') as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                            <x-input-error for="selectedProduct" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="quantity" value="Quantity" />
                            <x-input 
                                id="quantity"
                                type="number"
                                wire:model.defer="quantity"
                                placeholder="Enter quantity"
                            >
                                <x-hugeicons-shopping-basket-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="quantity" class="mt-2" />
                        </div>

                        <div class="flex flex-row space-x-3 w-full justify-end">
                            <button type="submit"
                                class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition"
                            >
                                <x-hugeicons-shopping-cart-add-01 class="w-5 h-5 text-white" />
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Cart Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h2 class="font-bold text-2xl mb-4">Cart Items</h2>

                    @if (session()->has("cart_{$sellingId}") && count(session("cart_{$sellingId}")) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3">Product Name</th>
                                        <th class="px-4 py-3">Price</th>
                                        <th class="px-4 py-3">Quantity</th>
                                        <th class="px-4 py-3">Total</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session("cart_{$sellingId}") as $item)
                                        <tr class="border-b">
                                            <td class="px-4 py-3">{{ $item['name'] }}</td>
                                            <td class="px-4 py-3">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                            <td class="px-4 py-3">{{ $item['quantity'] }}</td>
                                            <td class="px-4 py-3">
                                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <button wire:click="removeFromCart({{ $item['id'] }})"
                                                    class="text-red-500 hover:text-red-700">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Your cart is empty</p>
                    @endif
                </div>
            </div>
        </x-card>

        <!-- Payment Details -->
        <x-card>
            <div class="w-full pt-2">
                <h2 class="font-bold text-2xl mb-4">Payment Details</h2>

                <div class="space-y-6">
                    <div class="relative flex items-center space-x-2 rounded-md">
                        <div class="flex-grow">
                            <x-label for="paidAmount" value="Amount Paid" />
                            <x-input-currency 
                                id="paidAmount"
                                type="number"
                                wire:model="paidAmount"
                                placeholder="Enter paid amount"
                            >
                                <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input-currency>
                            <x-input-error for="paidAmount" class="mt-2" />
                        </div>

                        <button wire:click="updatePaidAmount"
                            class="self-end px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                            Process
                        </button>
                    </div>

                    <!-- Change -->
                    <div>
                        <x-label for="changeAmount" value="Change" />
                        <x-input 
                            id="changeAmount"
                            type="text"
                            value="Rp {{ number_format($changeAmount, 0, ',', '.') }}"
                            class="px-3 py-2 border border-gray-300 bg-gray-100 rounded-md shadow-sm"
                            readonly
                        >    
                        <x-hugeicons-money-01 class="w-[1.1rem] h-[1.1rem]" />
                        </x-input>
                    </div>

                    <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                        <div class="text-xl font-bold">
                            Total Price: Rp {{ number_format($totalPrice, 0, ',', '.') }}
                        </div>

                        <div class="flex space-x-3">
                            <button wire:click="cancelTransaction"
                                class="flex items-center space-x-2 px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                                <x-hugeicons-cancel-circle class="w-5 h-5" />
                                <span>Cancel</span>
                            </button>

                            <button wire:click="confirmTransaction"
                                class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition"
                                @if ($paidAmount < $totalPrice || $paidAmount === null) disabled @endif
                                onclick="printReceipt()"
                            >
                                <x-hugeicons-shopping-cart-check-01 class="w-5 h-5 text-white" />
                                <span>Confirm Transaction</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </x-card>

        <x-receipt 
            :sellingId="$sellingId"
            :cartItems="session('cart_' . $sellingId, [])"
            :totalPrice="$totalPrice"
            :paidAmount="$paidAmount"
            :changeAmount="$changeAmount"
        />
    </div>
</div>

 <!-- SweetAlert & Livewire Navigation Confirmation -->
<script>
        let isTransactionActive = true;

        document.addEventListener("livewire:navigate", function(event) {
            if (!isTransactionActive) return;
            event.preventDefault();
            const componentId = event.detail?.componentId;
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will redirect you to transaction list and your transaction will not be saved. Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, leave!',
                cancelButtonText: 'No, stay here'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (componentId) {
                        Livewire.find(componentId)?.call('cancelTransaction');
                    }
                    Livewire.dispatch('forceCloseTransaction');
                    setTimeout(() => {
                        isTransactionActive = false;
                    }, 100);
                } else {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your transaction is safe.',
                        icon: 'info'
                    });
                }
            });
        });
</script>
