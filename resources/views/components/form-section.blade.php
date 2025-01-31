@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    <div class="w-full mt-5 flex flex-col space-y-6">
        <form wire:submit.prevent="{{ $submit }}" enctype="multipart/form-data" action="{{ $attributes->get('action') }}" > 
            <div class="w-full {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : '' }}">
                <div class="w-full flex flex-col space-y-4">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-evenly w-full mt-10 space-x-4">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
