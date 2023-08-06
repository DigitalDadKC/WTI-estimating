<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pricebook')" :active="request()->routeIs('pricebook')">
                        {{ __('Pricebook') }}
                    </x-nav-link>
                    @role('estimator')
                    <x-dropdown-hover align="right" width="48">
                        <x-slot name="triggerHover">
                            <div>{{ __('Estimating') }}</div>
                        </x-slot>
                        <x-slot name="contentHover">
                            <x-nav-link-hover :href="route('estimating.guidelines')" :active="request()->routeIs('estimating.guidelines')">
                                {{ __('Guidelines') }}
                            </x-nav-link-hover>
                            <x-nav-link-hover :href="route('estimating.cooperatives')" :active="request()->routeIs('estimating.cooperatives')">
                                {{ __('Cooperatives') }}
                            </x-nav-link-hover>
                        </x-slot>
                    </x-dropdown-hover>
                    @endrole
                    @role('admin')
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                            {{ __('Admin') }}
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <x-dropdown-hover align="right" width="48">
                <x-slot name="triggerHover">
                    <div>{{ Auth::user()->name ?? NULL}}</div>
                </x-slot>
                <x-slot name="contentHover">
                    <x-nav-link-hover :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-nav-link-hover>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link-hover :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-nav-link-hover>
                    </form>
                </x-slot>
            </x-dropdown-hover>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pricebook')" :active="request()->routeIs('pricebook')">
                {{ __('Pricebook') }}
            </x-responsive-nav-link>
            @role('estimator')
            <x-dropdown-hover align="right" width="48">
                <x-slot name="triggerHover">
                    <div>{{ __('Estimating') }}</div>
                </x-slot>
                <x-slot name="contentHover">
                    <x-nav-link-hover :href="route('estimating.guidelines')" :active="request()->routeIs('estimating.guidelines')">
                        {{ __('Guidelines') }}
                    </x-nav-link-hover>
                </x-slot>
            </x-dropdown-hover>
            @endrole
            @role('admin')
                <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                    {{ __('Admin') }}
                </x-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ?? NULL }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? NULL }}</div>
            </div>
        </div>
    </div>
</nav>
