<div class="h-full fixed top-0 left-0 border-r border-gray-200  bg-gray-50 bg-opacity-50 shadow-sm z-[100001]">
    <!-- Header -->
    <div class="h-16 w-full flex items-center justify-center border-b border-gray-200">
        <span class="text-lg font-bold text-gray-800">
            <x-hugeicons-cashier class="w-[1.8rem] h-[1.8rem]" />
        </span>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-2 mx-2" x-data="{ tooltipActive: null }">
        <ul class="flex flex-col items-center space-y-3">
            <li class="relative">
                <a href="{{ route('dashboard') }}" wire:navigate
                    @mouseenter="tooltipActive = 'dashboard'" @mouseleave="tooltipActive = null"
                    class="flex items-center px-2 py-2 transition-colors text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900
                   {{ request()->routeIs('dashboard') ? 'bg-gray-100 rounded-full text-teal-600' : '' }}">
                    <x-hugeicons-home-09 class="w-[1.1rem] h-[1.1rem]" />
                </a>
                <span x-show="tooltipActive === 'dashboard'" x-transition.opacity.duration.200ms
                    class="absolute left-full ml-3 px-2 py-1 -mt-7 bg-gray-800 text-white text-xs rounded-md shadow-lg">
                    Dashboard
                </span>
            </li>

            @if (Auth::user()->hasRole(['Officer', 'Admin']))
                <li class="relative">
                    <a href="{{ route('product') }}" wire:navigate
                        @mouseenter="tooltipActive = 'products'" @mouseleave="tooltipActive = null"
                        class="flex items-center px-2 py-2 text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900 transition-colors
                   {{ str_starts_with(request()->path(), 'product') ? 'bg-gray-100 rounded-full text-teal-600 ' : '' }}">
                        <x-hugeicons-package class="w-[1.1rem] h-[1.1rem]" />
                    </a>
                    <span x-show="tooltipActive === 'products'" x-transition.opacity.duration.200ms
                        class="absolute left-full ml-3 px-2 py-1 -mt-7 bg-gray-800 text-white text-xs rounded-md shadow-lg">
                        Products
                    </span>
                </li>

                <li class="relative">
                    <a href="{{ route('transaction') }}" wire:navigate
                        @mouseenter="tooltipActive = 'transactions'" @mouseleave="tooltipActive = null"
                        class="flex items-center px-2 py-2 text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900 transition-colors
                   {{ str_starts_with(request()->path(), 'transaction') ? 'bg-gray-100 rounded-full text-teal-600 ' : '' }}">
                        <x-hugeicons-shopping-cart-check-in-01 class="w-[1.1rem] h-[1.1rem]" />
                    </a>
                    <span x-show="tooltipActive === 'transactions'" x-transition.opacity.duration.200ms
                        class="absolute left-full ml-3 px-2 -mt-7 py-1 bg-gray-800 text-white text-xs rounded-md shadow-lg">
                        Transactions
                    </span>
                </li>
            @endif

            @if (Auth::user()->hasRole('Admin'))
                <li class="relative">
                    <a href="{{ route('user') }}" wire:navigate
                        @mouseenter="tooltipActive = 'users'" @mouseleave="tooltipActive = null"
                        class="flex items-center px-2 py-2 text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900 transition-colors
                        {{ str_starts_with(request()->path(), 'user') ? 'bg-gray-100 rounded-full text-teal-600 ' : '' }}">
                        <x-hugeicons-add-team class="w-[1.1rem] h-[1.1rem]" />
                    </a>
                    <span x-show="tooltipActive === 'users'" x-transition.opacity.duration.200ms
                        class="absolute left-full ml-3 px-2 py-1 -mt-7 bg-gray-800 text-white text-xs rounded-md shadow-lg">
                        Users Management
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    <!-- Footer -->
    <div class="absolute bottom-0 w-full border-t px-2 border-gray-200" x-data="{ tooltipActive: null }">
        <div class="flex flex-col space-y-2">
            <!-- Profile -->
            <a href="{{ route('profile.show') }}" wire:navigate
                @mouseenter="tooltipActive = 'profile'" @mouseleave="tooltipActive = null"
                class="relative flex items-center px-2 py-2 text-gray-600 hover:rounded-full hover:text-gray-900 transition-colors
                {{ request()->routeIs('profile.show') ? 'bg-gray-100 rounded-full text-teal-600' : '' }}">

                <x-hugeicons-account-setting-02 class="w-[1.1rem] h-[1.1rem]" />

                <span x-show="tooltipActive === 'profile'" x-transition.opacity.duration.200ms
                    class="absolute left-full ml-3 px-2 py-1 bg-gray-800 text-white text-xs rounded-md shadow-lg">
                    Profile
                </span>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    @mouseenter="tooltipActive = 'logout'" @mouseleave="tooltipActive = null"
                    class="relative flex items-center px-2 py-2 text-gray-600 hover:rounded-full hover:text-gray-900 transition-colors">
                    
                    <x-hugeicons-logout-03 class="w-[1.2rem] h-[1.2rem] text-red-600" />
            
                    <span x-show="tooltipActive === 'logout'" x-transition.opacity.duration.200ms
                        class="absolute left-full ml-3 px-2 py-1 bg-gray-800 text-white text-xs rounded-md shadow-lg">
                        Logout
                    </span>
                </button>
            </form>            
        </div>
    </div>
</div>
