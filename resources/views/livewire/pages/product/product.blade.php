<div>
    <div wire:key="product-management" class="flex flex-col space-y-6">
        <x-slot name="header">
            {{ __('Product Management') }}
        </x-slot>

        <!-- Tabs -->
        <div class="flex flex-row w-auto justify-between space-x-6">

            <div class="flex flex-row space-x-2 w-auto h-10">
                <a href="{{ route('product.add') }}" wire:navigate
                    class="flex flex-row items-center space-x-2 py-1 px-2 bg-black text-white rounded-md h-full">
                    <x-hugeicons-add-circle class="w-[1.1rem] h-[1.1rem]" />
                    <span class="font-bold text-sm">Add Product</span>
                </a>
                <button
                    class="flex flex-row items-center space-x-2 py-1 px-2 bg-white text-black border rounded-md h-full">
                    <x-hugeicons-file-01 class="w-[1.1rem] h-[1.1rem]" />
                    <span class="font-bold text-sm">Export</span>
                </button>
            </div>
        </div>

        <!-- Product Table -->
        <div class="w-full">
            <x-card class="w-full flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Product List</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">A list of all products</p>
                </div>
                <div wire:ignore>
                    <table id="productTable" class="min-w-full text-sm align-middle bg-white">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['stock'] }}</td>
                                    <td>Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                                    <td>
                                        @switch($product['status'])
                                            @case('Active')
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                                            @break

                                            @case('Inactive')
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Inactive</span>
                                            @break

                                            @case('Draft')
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Draft</span>
                                            @break

                                            @default
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="flex flex-row space-x-2">
                                            <a href="{{ route('product.edit', ['id' => $product['id']]) }}" wire:current
                                                class="font-bold rounded  p-2 flex items-center space-x-2">
                                                <x-hugeicons-pencil-edit-02 style="width:1.5rem; height:1.5rem;" />
                                            </a>                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                </div>
            </x-card>
        </div>
    </div>
    <x-sweet-alert.confirm-delete-product />
    <script>
        
        document.addEventListener('livewire:navigated', function () {
       
            $('#productTable').DataTable();
            $('#dt-length-0').removeClass('px-3').addClass('px-6');

            Livewire.on('productDeleted', (id) => {
            let productTable = $('#productTable').DataTable();
            productTable.row($(`button[data-id="${id}"]`).parents('tr')).remove().draw();
            });    

            
        });
        </script>
    </div>
