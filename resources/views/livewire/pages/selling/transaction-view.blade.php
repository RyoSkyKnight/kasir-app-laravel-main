<div>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-lg font-semibold">
            <span><a href="{{ route('transaction') }}" wire:navigate>{{ __('Transaction Management') }}</a></span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Transaction Overview</span>
        </div>
    </x-slot>

    <div class="w-full flex flex-col space-y-6">
        <!-- Transaction Overview Form -->
        <x-card>
            <div class="flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Transaction Overview</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Look at the transaction overview and make sure everything is correct.
                    </p>
                </div>

                <div class="flex flex-col space-y-6">
                    <div class="flex flex-col space-y-6">
                        <div>
                            <x-label for="name" value="Customer Name" />
                            <x-input id="name" type="text" wire:model.defer="name" >
                                <x-hugeicons-user class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="date" value="Transaction Date" />
                            <x-input id="date" type="date" wire:model.defer="date" >
                                <x-hugeicons-calendar-download-02 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="date" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="totalPrice" value="Total Price" />
                            <x-input-currency id="totalPrice" type="number" wire:model.defer="totalPrice" >
                                 <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input-currency>
                            <x-input-error for="totalPrice" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="totalPayment" value="Total Payment" />
                            <x-input-currency id="totalPayment" type="number" wire:model.defer="totalPayment" >
                                 <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input-currency>
                            <x-input-error for="totalPayment" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="totalChange" value="Total Change" />
                            <x-input-currency id="totalChange" type="number" wire:model.defer="totalChange" >
                                 <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input-currency>
                            <x-input-error for="totalChange" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-row space-x-3 w-full justify-end mt-8 pt-4 border-t border-gray-200">
                        <!-- Back Button -->
                        <a href="{{ route('transaction') }}" wire:navigate class="flex items-center space-x-2 px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                            <x-hugeicons-arrow-left-02 class="w-5 h-5 text-black" />
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Product Info -->
        {{-- <x-card>
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
                        <x-input disabled id="soldStock" type="number" wire:model.defer="soldStock" placeholder="Sold product stock">
                            <x-hugeicons-package class="w-[1.1rem] h-[1.1rem]" />
                        </x-input>
                    </div>

                    <div>
                        <x-label for="soldTotalPrice" value="Sold Total Price" />
                        <x-input-currency disabled id="soldTotalPrice" type="number" wire:model.defer="soldTotalPrice" placeholder="Total sales revenue">
                            <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                        </x-input-currency>
                    </div>
                </div>
            </div>
        </x-card> --}}

    </div>
</div>
