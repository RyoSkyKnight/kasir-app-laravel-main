<div>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-lg font-semibold">
            <span><a href="{{ route('user') }}" wire:navigate>{{ __('User Management') }}</a></span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Edit User</span>
        </div>
    </x-slot>

    <div class="w-full flex flex-col space-y-6">
        <!-- Edit User Form -->
        <x-card>
            <div class="flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Edit User</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Update user details to keep your team data accurate and up-to-date.
                    </p>
                </div>

                <form wire:submit.prevent="updateUser" class="flex flex-col space-y-6" enctype="multipart/form-data">
                    <div class="flex flex-col space-y-6">
                        <div>
                            <x-label for="name" value="Full Name" />
                            <x-input id="name" type="text" wire:model.defer="form.name" placeholder="Enter full name">
                                <x-hugeicons-user class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="email" value="Email Address" />
                            <x-input id="email" type="email" wire:model.defer="form.email" placeholder="Enter email">
                                <x-hugeicons-mail-at-sign-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.email" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="role" value="User Role" />
                            <x-select name="role" :options="$roles"
                                class="mt-2 h-full" wire:model.defer="form.role">
                                <x-hugeicons-mentoring class="w-[1.1rem] h-[1.1rem]" />
                            </x-select>
                            <x-input-error for="form.role" class="mt-2" />
                        </div>

        
                    </div>

                    <div class="flex flex-row space-x-3 w-full justify-end mt-8 pt-4 border-t border-gray-200">
                        <!-- Cancel Button -->
                        <a href="{{ route('user') }}" wire:navigate
                            class="flex items-center space-x-2 px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                            <x-hugeicons-arrow-left-02 class="w-5 h-5 text-black" />
                            <span>Cancel</span>
                        </a>

                        <!-- Confirm Button -->
                        <button type="submit"
                            class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                            <x-hugeicons-floppy-disk class="w-5 h-5 text-white" />
                            <span>Confirm</span>
                        </button>
                    </div>
                </form>
            </div>
        </x-card>

        @if($form->role === 'Officer')
        <x-card>
            <div class="flex flex-col space-y-6">
                <!-- Header -->
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Officer Sales Detail</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Look at the officer details and make sure everything is correct.
                    </p>
                </div>
    
                <!-- Sales Details -->
                <div class="flex flex-col space-y-6">
                    <div>
                        <x-label for="salesCount" value="Total Sales Count" />
                        <x-input disabled id="salesCount" type="number" wire:model.defer="form.salesCount" placeholder="Total product sales">
                            <x-hugeicons-package class="w-[1.1rem] h-[1.1rem]" />
                        </x-input>
                    </div>
    
                    <div>
                        <x-label for="totalRevenue" value="Total Sales Revenue" />
                        <x-input-currency disabled id="totalRevenue" type="number" wire:model.defer="form.totalRevenue" placeholder="Total revenue generated">
                            <x-hugeicons-sale-tag-01 class="w-[1.1rem] h-[1.1rem]" />
                        </x-input-currency>
                    </div>
                </div>
            </div>
        </x-card>
    @endif
    


        <!-- Delete User Card -->
        <x-card>
            <h1 class="text-red-600 font-extrabold pt-2 text-3xl">Danger Zone</h1>
            <div class="flex flex-row w-full justify-between">
                <p class="text-gray-500 text-sm">
                    Deleting this user will remove them permanently. This action cannot be undone.
                </p>
                <button @click="$dispatch('confirm-delete-user', { id: {{ $form->id }} })"
                    class="flex items-center space-x-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 transition w-max">
                    <x-hugeicons-delete-01 class="w-5 h-5 text-white" />
                    <span>Delete User</span>
                </button>
            </div>
            <x-sweet-alert.confirm-delete-user />
        </x-card>
    </div>
</div>
