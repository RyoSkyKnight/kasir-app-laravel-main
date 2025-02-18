<div>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-lg font-semibold">
            <span><a href="{{ route('product') }}" wire:navigate>{{ __('Product Management') }}</a></span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Export Product</span>
        </div>
    </x-slot>
    
    <div class="w-full">
        <x-card>
            <div class="flex flex-col space-y-6">
                <!-- Header Section -->
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Export Products Data</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Record product and keep track of your business!
                    </p>                
                </div>

                <!-- Form Section -->
                <div class="flex flex-col space-y-6" enctype="multipart/div-data">
                    <div class="flex flex-col space-y-6">
                       
                           <!-- Start Timme -->
                           <div>
                            <x-label for="transaction_date_start" value="Transaction Date Start" />
                            <x-input id="transaction_date_start" type="date" wire:model="startDate">
                                <x-hugeicons-calendar-download-02 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="startDate" class="mt-2" />
                        </div>

                        <!-- End Date -->
                        <div>
                            <x-label for="transaction_date_end" value="Transaction Date End" />
                            <x-input id="transaction_date_end" type="date" wire:model="endDate">
                                <x-hugeicons-calendar-download-02 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="endDate" class="mt-2" />
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-row space-x-3 w-full justify-end mt-8 pt-4 border-t border-gray-200">
                        <!-- Cancel Button -->
                        <a href="{{ route('transaction') }}" wire:navigate
                           class="flex items-center space-x-2 px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                            <x-hugeicons-arrow-left-02 class="w-5 h-5 text-black" />
                            <span>Cancel</span>
                        </a>


                        <button wire:click="exportAllTransactionsExcel"
                        class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                        <x-hugeicons-add-circle class="w-5 h-5 text-white" />
                        <span>Export All Data</span>
                       </button>
                    
                        <!-- Transaction Button -->
                        <button wire:click="exportTransactionsExcel"
                            class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                            <x-hugeicons-add-circle class="w-5 h-5 text-white" />
                            <span>Export Transactions To Excel</span>
                        </button>

                    </div>
                </form>
            </div>
        </x-card>
    </div>
</div>
