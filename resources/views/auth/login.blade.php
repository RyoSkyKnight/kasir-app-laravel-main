<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- Tambahkan logo jika diperlukan -->
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex flex-col space-y-6">
                <div class="flex flex-col space-y-2 items-center">
                    <h1 class="font-extrabold text-2xl ">{{ __('Masuk ke Aplikasi Kasir') }}</h1>
                    <div class="text-gray-500 text-sm text-center">
                        <p>{{ __('Welcome back!') }}</p>
                        <p>{{ __('Please enter your credentials to proceed.') }}</p>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col space-y-6">
                         <!-- Email Field -->
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username"
                            placeholder="jhondoe@gmail.com" >

                            <x-hugeicons-user class="w-[1.1rem] h-[1.1rem]" />
                        </x-input>
                    </div>

                    <!-- Password Field -->
                    <div class="relative">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                            autocomplete="new-password" placeholder="Enter password" >
                        
                            <x-hugeicons-lock-key class="w-[1.1rem] h-[1.1rem]" />

                        </x-input>
                        <!-- Show/Hide Password Button -->
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 pt-6 flex items-center text-gray-500"
                            onclick="togglePassword('password', 'show-icon', 'hide-icon')">
                            <svg id="show-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                height="20" viewBox="0 0 24 24" width="20" class="hidden">
                                <g fill="#292d32">
                                    <path
                                        d="m11.9999 16.3299c-2.38998 0-4.32998-1.94-4.32998-4.33 0-2.38998 1.94-4.32998 4.32998-4.32998 2.39 0 4.33 1.94 4.33 4.32998 0 2.39-1.94 4.33-4.33 4.33zm0-7.15998c-1.56 0-2.82998 1.26998-2.82998 2.82998s1.26998 2.83 2.82998 2.83 2.83-1.27 2.83-2.83-1.27-2.82998-2.83-2.82998z" />
                                    <path
                                        d="m12.0001 21.02c-3.76002 0-7.31002-2.2-9.75002-6.02-1.06-1.65-1.06-4.34 0-6.00002 2.45-3.82 6-6.02 9.75002-6.02 3.75 0 7.3 2.2 9.74 6.02 1.06 1.65002 1.06 4.34002 0 6.00002-2.44 3.82-5.99 6.02-9.74 6.02zm0-16.54002c-3.23002 0-6.32002 1.94-8.48002 5.33-.75 1.17002-.75 3.21002 0 4.38002 2.16 3.39 5.25 5.33 8.48002 5.33 3.23 0 6.32-1.94 8.48-5.33.75-1.17.75-3.21 0-4.38002-2.16-3.39-5.25-5.33-8.48-5.33z" />
                                </g>
                            </svg>
                            <svg id="hide-icon" xmlns="http://www.w3.org/2000/svg" fill="none" height="20" viewBox="0 0 24 24"
                            width="20">
                            <g fill="#292d32">
                                <path
                                    d="m9.46992 15.2799c-.19 0-.38-.07-.53-.22-.82-.82-1.27-1.91-1.27-3.06 0-2.38998 1.94-4.32998 4.32998-4.32998 1.15 0 2.24.45 3.06 1.27.14.14.22.33.22.53s-.08.39-.22.53l-5.05998 5.05998c-.15.15-.34.22-.53.22zm2.52998-6.10998c-1.56 0-2.82998 1.26998-2.82998 2.82998 0 .5.13.98.37 1.4l3.85998-3.85998c-.42-.24-.9-.37-1.4-.37z" />
                                <path
                                    d="m5.59984 18.51c-.17 0-.35-.06-.49-.18-1.07-.91-2.03-2.03-2.85-3.33-1.06-1.65-1.06-4.34 0-6.00002 2.44-3.82 5.99-6.02 9.73996-6.02 2.2 0 4.37.76 6.27 2.19.33.25.4.72.15 1.05s-.72.4-1.05.15c-1.64-1.24-3.5-1.89-5.37-1.89-3.22996 0-6.31996 1.94-8.47996 5.33-.75 1.17002-.75 3.21002 0 4.38002s1.61 2.18 2.56 3c.31.27.35.74.08 1.06-.14.17-.35.26-.56.26z" />
                                <path
                                    d="m12.0006 21.02c-1.33 0-2.63005-.27-3.88005-.8-.38-.16-.56-.6-.4-.98s.6-.56.98-.4c1.06.45 2.17005.68 3.29005.68 3.23 0 6.32-1.94 8.48-5.33.75-1.17.75-3.21 0-4.38-.31-.49-.6501-.96-1.01-1.4-.26-.32-.21-.79.11-1.06.32-.26.7899-.22 1.06.11.39.48.77 1 1.11 1.54 1.06 1.65 1.06 4.34 0 6-2.44 3.82-5.99 6.02-9.74 6.02z" />
                                <path
                                    d="m12.6896 16.2701c-.35 0-.67-.25-.74-.61-.08-.41.19-.8.6-.87 1.1-.2 2.02-1.12 2.22-2.22.08-.41.47-.67.88-.6.41.08.68.47.6.88-.32 1.73-1.7 3.1-3.42 3.42-.05-.01-.09 0-.14 0z" />
                                <path
                                    d="m1.99945 22.75c-.19 0-.38-.07-.53-.22-.29-.29-.29-.77 0-1.06l7.47-7.47c.29-.29.77-.29 1.06 0 .29005.29.29005.77 0 1.06l-7.47 7.47c-.15.15-.34.22-.53.22z" />
                                <path
                                    d="m14.5307 10.2199c-.19 0-.38-.07-.53-.21996-.29-.29-.29-.77 0-1.06l7.47-7.47c.29-.29.77-.29 1.06 0s.29.77 0 1.06l-7.47 7.47c-.15.14996-.34.21996-.53.21996z" />
                            </g>
                        </svg>
                        </button>
                    </div>
                    </div>
                    
                    <!-- Remember Me and Forgot Password -->
                    <div class="block mt-4">
                        <div class="flex flex-row justify-between">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Login Button -->
                <div class="flex items-center mt-4">
                    <x-button class="w-full">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-authentication-card>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const showIcon = document.getElementById('show-icon');
            const hideIcon = document.getElementById('hide-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                showIcon.classList.remove('hidden');
                hideIcon.classList.add('hidden');
            } else {
                passwordField.type = 'password';
                showIcon.classList.add('hidden');
                hideIcon.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>
