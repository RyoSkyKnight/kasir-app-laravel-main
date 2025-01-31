<div>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-lg font-semibold">
            <span><a href="{{ route('product') }}" wire:navigate>{{ __('Product Management') }}</a></span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Edit Product</span>
        </div>
    </x-slot>

    <div class="w-full flex flex-col space-y-6">
        <!-- Edit Product Form -->
        <x-card>
            <div class="flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Edit Product</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Update your product details to keep your inventory accurate and up-to-date.
                    </p>
                </div>

                <form wire:submit.prevent="update" class="flex flex-col space-y-6" enctype="multipart/form-data">
                    <div class="flex flex-col space-y-6">
                        <div>
                            <x-label for="name" value="Product Name" />
                            <x-input id="name" type="text" wire:model.defer="form.name" placeholder="Enter product name">
                                <x-hugeicons-apple-reminder class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="stock" value="Stock" />
                            <x-input id="stock" type="number" wire:model.defer="form.stock" placeholder="Enter product stock">
                                <x-hugeicons-package class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.stock" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="price" value="Price" />
                            <x-input-currency id="price" type="number" wire:model.defer="form.price" placeholder="Enter product price">
                                <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input-currency>
                            <x-input-error for="form.price" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="status" value="Status" />
                            <x-select name="status" :options="['Active' => 'Active', 'Inactive' => 'Inactive', 'Draft' => 'Draft', '']" class="mt-2 h-full" wire:model.defer="form.status">
                                <x-hugeicons-dashboard-circle-edit class="w-[1.1rem] h-[1.1rem]" />
                            </x-select>
                            <x-input-error for="form.status" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-row space-x-3 w-full justify-end mt-8 pt-4 border-t border-gray-200">
                        <!-- Cancel Button -->
                        <a href="{{ route('product') }}" wire:navigate class="flex items-center space-x-2 px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                            <x-hugeicons-arrow-left-02 class="w-5 h-5 text-black" />
                            <span>Cancel</span>
                        </a>

                        <!-- Confirm Button -->
                        <button type="submit" class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                            <x-hugeicons-floppy-disk class="w-5 h-5 text-white" />
                            <span>Confirm</span>
                        </button>
                    </div>
                </form>
            </div>
        </x-card>

        <!-- Product Info -->
        <x-card>
            <div class="flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Product Detail</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Look at the product details and make sure everything is correct.
                    </p>
                </div>

                <div class="flex flex-col space-y-6">
                    <div>
                        <x-label for="soldStock" value="Sold Stock" />
                        <x-input disabled id="soldStock" type="number" wire:model.defer="form.soldStock" placeholder="Sold product stock">
                            <x-hugeicons-package class="w-[1.1rem] h-[1.1rem]" />
                        </x-input>
                    </div>

                    <div>
                        <x-label for="soldTotalPrice" value="Sold Total Price" />
                        <x-input-currency disabled id="soldTotalPrice" type="number" wire:model.defer="form.soldTotalPrice" placeholder="Total sales revenue">
                            <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                        </x-input-currency>
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Delete Product Card -->
        <x-card>
            <h1 class="text-red-600 font-extrabold pt-2 text-3xl">Danger Zone</h1>
            <div class="flex flex-row w-full justify-between">
                <p class="text-gray-500 text-sm">
                    Deleting this product will remove it permanently. This action cannot be undone.
                </p>
                <button @click="$dispatch('confirm-delete-product', { id: {{ $form->id }} })"
                    class="flex items-center space-x-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 transition w-max">
                    <x-hugeicons-delete-01 class="w-5 h-5 text-white" />
                    <span>Delete Product</span>
                </button>
                
            </div>
            <x-sweet-alert.confirm-delete-product />
        </x-card>
    </div>
</div>
