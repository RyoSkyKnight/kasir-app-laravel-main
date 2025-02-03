<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kasir Management') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- CDN Links -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.tailwindcss.js"></script>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="font-sans antialiased">
    <x-sweet-alert.alert />

    <div class="min-h-screen ml-[3rem] bg-gray-50">
        <x-side-navbar />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-gray-50 bg-opacity-95 fixed w-full z-[10000]">
                <div class="w-auto py-6 pl-[2rem] pr-[5rem]">
                    <div class="flex flex-row space-x-2 justify-between">
                        <h2
                            class="font-normal text-[1.2rem] text-gray-800 leading-tight text-left flex flex-row gap-2 w-auto justify-center">
                            {{ $header }}
                            <p class="border px-3 py-1 text-center rounded-[1rem] bg-white text-[0.8rem]">
                                {{ Auth::user()->getRoleNames()->first() ?? 'Guest' }}
                            </p>
                        </h2>
                        <div class="flex flex-row space-x-1 items-center">
                            <x-hugeicons-user class="w-[1.1rem] h-[1.1rem]" />
                            <p class="text-sm">{{ Auth::user()->name }}</p>
                            <livewire:components.notification-modal/>
                        </div>
                    </div>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-16">
                    <div class="bg-transparent overflow-hidden">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
