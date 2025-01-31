<div>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-lg font-semibold">
            <span><a href="{{ route('product') }}" wire:navigate>{{ __('Product Management') }}</a></span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Add Product</span>
        </div>
    </x-slot>
    
    <div class="w-full">
        <x-card>
            <div class="flex flex-col space-y-6">
                <!-- Header Section -->
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Add a New Product</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Expand your inventory with new products. Let’s make it happen!
                    </p>                
                </div>

                <!-- Form Section -->
                <form wire:submit.prevent="saveProduct" class="flex flex-col space-y-6" enctype="multipart/form-data">
                    <div class="flex flex-col space-y-6">
                        <div>
                            <x-label for="name" value="Product Name" />
                            <x-input id="name" type="text" wire:model="form.name" placeholder="Enter product name">
                                <x-hugeicons-apple-reminder class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="stock" value="Stock" />
                            <x-input id="stock" type="number" wire:model="form.stock" placeholder="Enter product stock">
                                <x-hugeicons-package class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.stock" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="price" value="Price" />
                            <x-input-currency id="price" type="number" wire:model="form.price" placeholder="Enter product price">
                                <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input-currency>
                            <x-input-error for="form.price" class="mt-2" />
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-row space-x-3 w-full justify-end mt-8 pt-4 border-t border-gray-200">
                        <!-- Cancel Button -->
                        <a href="{{ route('product') }}" wire:navigate
                           class="flex items-center space-x-2 px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                            <x-hugeicons-arrow-left-02 class="w-5 h-5 text-black" />
                            <span>Cancel</span>
                        </a>
                    
                        <!-- Add Product Button -->
                        <button type="submit" 
                            class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                            <x-hugeicons-add-circle class="w-5 h-5 text-white" />
                            <span>Add Product</span>
                        </button>
                    </div>
                </form>
            </div>
        </x-card>
    </div>
</div>
