<div>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-lg font-semibold">
            <span><a href="{{ route('user') }}" wire:navigate>{{ __('User Management') }}</a></span>
            <span class="text-gray-500">›</span>
            <span class="text-gray-500 text-base">Add Officers</span>
        </div>
    </x-slot>
    
    <div class="w-full">
        <x-card>
            <div class="flex flex-col space-y-6">
                <!-- Header Section -->
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Add a New Officer</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">
                        Register a new officer to access the system!
                    </p>                
                </div>

                <!-- Form Section -->
                <form wire:submit.prevent="saveUser" class="flex flex-col space-y-6">
                    <div class="flex flex-col space-y-6">
                        <!-- Name -->
                        <div>
                            <x-label for="name" value="Name" />
                            <x-input id="name" type="text" wire:model.blur="form.name" placeholder="John Doe">
                                <x-hugeicons-user class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-label for="email" value="Email" />
                            <x-input id="email" type="email" wire:model.blur="form.email" placeholder="jhondoe@gmail.com">
                                <x-hugeicons-mail-at-sign-01 class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.email" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="relative">
                            <x-label for="password" value="Password" />
                            <x-input id="password" type="text" wire:model.blur="form.password" placeholder="Enter password" disabled>
                                <x-hugeicons-lock-key class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.password" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative">
                            <x-label for="password_confirmation" value="Confirm Password" />
                            <x-input id="password_confirmation" type="text" wire:model.blur="form.password_confirmation" placeholder="Re-enter password" disabled>
                                <x-hugeicons-lock-key class="w-[1.1rem] h-[1.1rem]" />
                            </x-input>
                            <x-input-error for="form.password_confirmation" class="mt-2" />
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <x-label for="role" value="User Role" />
                            <x-select name="role" :options="$roles"
                                class="mt-2 h-full" wire:model.blur="form.userrole">
                                <x-hugeicons-mentoring class="w-[1.1rem] h-[1.1rem]" />
                            </x-select>
                            <x-input-error for="form.userrole" class="mt-2" />
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-row space-x-3 w-full justify-end mt-8 pt-4 border-t border-gray-200">
                        <!-- Cancel Button -->
                        <a href="{{ route('user') }}" wire:navigate class="flex items-center space-x-2 px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                            <x-hugeicons-arrow-left-02 class="w-5 h-5 text-black" />
                            <span>Cancel</span>
                        </a>
                    
                        <!-- Add User Button -->
                        <button type="submit" 
                            class="flex items-center space-x-2 px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                            <x-hugeicons-add-circle class="w-5 h-5 text-white" />
                            <span>Add User</span>
                        </button>
                    </div>
                </form>
            </div>
        </x-card>
    </div>
</div>
