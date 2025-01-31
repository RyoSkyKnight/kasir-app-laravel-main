<div class="h-full fixed top-0 left-0 border-r border-gray-200  bg-gray-50 bg-opacity-50 shadow-sm z-[100]">
    <!-- Header -->
    <div class="h-16 w-full flex items-center justify-center border-b border-gray-200">
        <span class="text-lg font-bold text-gray-800">
            <x-hugeicons-cashier class="w-[1.8rem] h-[1.8rem]" />
        </span>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-2 mx-2">
        <ul class="flex flex-col items-center space-y-3">
            <li>
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="flex items-center px-2 py-2 transition-colors text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900
                   {{ request()->routeIs('dashboard') ? 'bg-gray-100 rounded-full text-teal-600' : '' }}">
                    <x-hugeicons-home-09 class="w-[1.1rem] h-[1.1rem]" />
                </a>
            </li>

            @if(Auth::user()->hasRole('Officer'))
            <li>
                <a href="{{ route('product') }}" wire:navigate
                    class="flex items-center px-2 py-2 text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900 transition-colors
                   {{ str_starts_with(request()->path(), 'product')  ? 'bg-gray-100 rounded-full text-teal-600 ' : '' }}">
                    <x-hugeicons-package class="w-[1.1rem] h-[1.1rem]" />
                </a>
            </li>
            <li>
                <a href="{{ route('transaction') }}" wire:navigate
                    class="flex items-center px-2 py-2 text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900 transition-colors
                   {{ str_starts_with(request()->path(), 'transaction')  ? 'bg-gray-100 rounded-full text-teal-600 ' : '' }}">
                    <x-hugeicons-shopping-cart-check-in-01 class="w-[1.1rem] h-[1.1rem]" />
                </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('Admin'))
            <li>
                <a href="{{ route('user') }}" wire:navigate
                    class="flex items-center px-2 py-2 text-gray-600 hover:bg-gray-100 hover:rounded-full hover:text-gray-900 transition-colors
                    {{ request()->routeIs('user') ? 'bg-gray-100 rounded-full text-teal-600' : '' }}">
                    <x-hugeicons-add-team class="w-[1.1rem] h-[1.1rem]" />
                </a>
            </li>
            @endif
        </ul>
    </nav>

    <!-- Footer -->
    <div class="absolute bottom-0 w-full  border-t px-2 border-gray-200">
        <div class="flex flex-col  space-y-2">
            <a href="{{ route('profile.show') }}" :active="request() - > routeIs('profile.show')"
                class="flex items-center px-2 py-2 text-gray-600 hover:rounded-full hover:text-gray-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="16" viewBox="0 0 24 24" width="18"
                    alt="profile">
                    <g stroke="#2a353d" stroke-width="1.5">
                        <path
                            d="m21.3175 7.14139-.4936-.8566c-.3733-.64783-.5599-.97174-.8775-1.10091-.3176-.12916-.6768-.02724-1.3951.1766l-1.2202.3437c-.4586.10576-.9398.04576-1.3585-.16939l-.3369-.19437c-.3591-.22999-.6353-.56909-.7882-.96768l-.3339-.99738c-.2196-.66002-.3294-.99003-.5908-1.17879-.2613-.18876-.6085-.18876-1.3029-.18876h-1.1148c-.6943 0-1.0415 0-1.3029.18876-.26135.18876-.37114.51877-.59071 1.17879l-.33396.99738c-.15288.39859-.42908.73769-.78816.96768l-.33688.19437c-.41875.21515-.8999.27515-1.35851.16939l-1.22023-.3437c-.71834-.20384-1.0775-.30576-1.39508-.1766-.31758.12917-.50422.45308-.87752 1.10091l-.49358.8566c-.34991.60725-.52487.91088-.49091 1.2341.03395.32322.26817.58369.7366 1.10463l1.03104 1.15268c.252.319.43091.875.43091 1.3749 0 .5001-.17885 1.0559-.43088 1.375l-1.03107 1.1527c-.46843.521-.70264.7814-.7366 1.1047-.03396.3232.141.6268.49091 1.234l.49357.8566c.37329.6478.55995.9718.87753 1.1009.31758.1292.67675.0273 1.3951-.1766l1.22017-.3437c.45869-.1058.93993-.0457 1.35873.1695l.33683.1944c.35901.23.63514.569.788.9676l.33399.9975c.21957.66.32936.99.59071 1.1788.2614.1887.6086.1887 1.3029.1887h1.1148c.6944 0 1.0416 0 1.3029-.1887.2614-.1888.3712-.5188.5908-1.1788l.334-.9975c.1528-.3986.4289-.7376.788-.9676l.3368-.1944c.4188-.2152.9-.2753 1.3587-.1695l1.2202.3437c.7183.2039 1.0775.3058 1.3951.1766.3176-.1291.5042-.4531.8775-1.1009l.4936-.8566c.3499-.6072.5248-.9108.4909-1.234-.034-.3233-.2682-.5837-.7366-1.1047l-1.0311-1.1527c-.252-.3191-.4309-.8749-.4309-1.375 0-.4999.179-1.0559.4309-1.3749l1.0311-1.15268c.4684-.52094.7026-.78141.7366-1.10463.0339-.32322-.141-.62685-.4909-1.2341z"
                            stroke-linecap="round" />
                        <path
                            d="m15.5195 12c0 1.933-1.567 3.5-3.5 3.5s-3.49997-1.567-3.49997-3.5 1.56697-3.5 3.49997-3.5 3.5 1.567 3.5 3.5z" />
                    </g>
                </svg>
            </a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                    class="flex items-center px-2 py-2 text-gray-600  hover:rounded-full hover:text-gray-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="18" viewBox="0 0 24 24"
                        width="18" alt="logout">
                        <g stroke="red" stroke-linecap="round" stroke-width="1.5">
                            <path
                                d="m11 3-.6626.23384c-2.57873.91016-3.86812 1.36524-4.60276 2.40358s-.73464 2.40568-.73464 5.14038v2.4444c0 2.7347 0 4.102.73464 5.1404.73464 1.0383 2.02403 1.4934 4.60276 2.4036l.6626.2338" />
                            <path
                                d="m21 12h-10m10 0c0-.7002-1.9943-2.00847-2.5-2.5m2.5 2.5c0 .7002-1.9943 2.0085-2.5 2.5"
                                stroke-linejoin="round" />
                        </g>
                    </svg>
                </a>
            </form>
        </div>
    </div>
</div>
