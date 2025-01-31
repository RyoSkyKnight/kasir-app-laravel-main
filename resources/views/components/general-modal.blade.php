@props(['open' => false, 'title' => 'Modal Title'])

<div 
    x-show="{{ $open }}" 
    class="fixed inset-0 flex items-center justify-center z-50" 
    x-cloak>
    <div 
        class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md transition-transform transform" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="scale-95 opacity-0" 
        x-transition:enter-end="scale-100 opacity-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="scale-100 opacity-100" 
        x-transition:leave-end="scale-95 opacity-0">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ $title }}
            </h2>
            <button @click="{{ $open }} = false" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24" fill="currentColor">
                    <path d="M720 936 528 744 336 936l-72-72 192-192-192-192 72-72 192 192 192-192 72 72-192 192 192 192-72 72Z" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="w-full">
            {{ $slot }}
        </div>
    </div>
</div>
