<div>
    <div class="flex flex-col space-y-6" wire:pool.5s="fetchProducts">
        <x-slot name="header">
            {{ __('Dashboard') }}
        </x-slot>
        <!-- Cards Section -->
        <div class="flex flex-row justify-evenly w-auto space-x-6">

            
            <x-card>
                <div class="flex flex-col">
                    <div class="flex flex-row justify-between">
                        <h1 class="font-semibold text-base">Total Sales</h1>
                        <x-hugeicons-shopping-cart-01 class="w-[1.1rem] h-[1.1rem]" />
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-extrabold pt-2 text-3xl">Rp {{ number_format($totalSalesPerYear, 0, ',', '.') }}</h1>
                        <p class="text-sm pt-0.5 text-green-500">Total Sales for This Year</p>
                    </div>
                </div>
            </x-card>

            <x-card>
                <div class="flex flex-col">
                    <div class="flex flex-row justify-between">
                        <h1 class="font-semibold text-base">Active Products</h1>
                        <x-hugeicons-delivery-box-01 class="w-[1.1rem] h-[1.1rem]" />
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-extrabold pt-2 text-3xl">{{ $activeProducts }}</h1>
                        <p class="text-sm pt-0.5 text-green-500">Active products from {{ $totalProducts }} totals</p>
                    </div>
                </div>
            </x-card>

            <x-card>
                <div class="flex flex-col">
                    <div class="flex flex-row justify-between">
                        <h1 class="font-semibold text-base">Inactive Products</h1>
                        <x-hugeicons-alert-circle class="w-[1.1rem] h-[1.1rem]" />
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-extrabold pt-2 text-3xl">{{ $inactiveProducts }}</h1>
                        <p class="text-sm pt-0.5 text-red-500">Inactive products from {{ $totalProducts }} totals</p>
                    </div>
                </div>
            </x-card>
        </div>

        <x-card class="w-full flex flex-col space-y-6">
            <div class="flex flex-col">
                <h1 class="font-extrabold pt-2 text-3xl">Top Selling Product</h1>
                <p class="text-[0.8rem] pt-0.5 text-gray-500">A list of top high sold product </p>
            </div>
            <div class="overflow-x-auto">
                <ul class="divide-y divide-gray-200">
                    @if($topSellers->isEmpty())
                        <li class="flex items-center justify-center py-4">
                            <span class="text-gray-500">There are no product sold yet</span>
                        </li>
                    @else
                        @foreach ($topSellers as $index => $top)
                            <li class="flex items-center justify-between py-2 hover:bg-gray-50 px-4 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center justify-center w-8 h-8 {{ $index < 3 ? 'bg-yellow-100' : 'bg-gray-100' }} rounded-full">
                                        <span class="{{ $index < 3 ? 'text-yellow-800' : 'text-gray-600' }} font-bold">
                                            #{{ $index + 1 }}
                                        </span>
                                    </span>
                                    <span class="text-md text-gray-700 font-bold">{{ $top->product->name }}</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                        Rp {{ number_format($top->total_price, 0, ',', '.') }}
                                    </span>
                                    <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                                        {{ $top->total_sold }} sold
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
           
        </x-card>

        <!-- Product Table Section -->
        <div class="w-full">
            <x-card class="w-full flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Product Overview</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">A list of all new products added</p>
                </div>
                <div wire:ignore>
                        <table id="example" class="min-w-full text-sm bg-white">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Stock</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="py-10">
                                            @switch($product->status)
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </x-card>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', function() {


            $('#example').DataTable();
            $('#dt-length-0').removeClass('px-3').addClass('px-6');


        });
    </script>
</div>
