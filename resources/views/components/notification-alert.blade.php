<div x-data="{ open: false, type: '', message: '' }"
     x-show="open"
     x-transition
     style="display: none"
     class="w-full px-4 py-5 border-l-4 rounded-lg shadow-md text-sm transition duration-300 ease-in-out"
     :class="{
         'bg-green-100 border-green-500 text-green-800': type === 'success',
         'bg-red-100 border-red-500 text-red-800': type === 'error',
         'bg-blue-100 border-blue-500 text-blue-800': type === 'info'
     }"
     @notify.window="
        console.log('Notify Event Received:', $event.detail);
        type = $event.detail.type;
        message = $event.detail.message;
        open = true;
        setTimeout(() => open = false, 10000);
     ">

     <div class="flex items-center">
        <div class="mr-2">
            <template x-if="type === 'success'">
                <x-hugeicons-checkmark-circle-02 class="h-5 w-5 text-green-500" />
            </template>
            <template x-if="type === 'error'">
                <x-hugeicons-alert-circle class="h-5 w-5 text-red-500" />
            </template>
            <template x-if="type === 'info'">
                <x-hugeicons-information-circle class="h-5 w-5 text-blue-500" />
            </template>
        </div>
        <div class="font-medium" x-text="message"></div>
    </div>
</div>
