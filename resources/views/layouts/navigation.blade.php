<nav x-data="{ open: false }" class="bg-[#9f234a] bg-opacity-90 shadow-md border-b border-[#e7a739] backdrop-blur-md">
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left Section -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('records.index') }}">
                        <img src="{{ asset('images/Transparent Logo.png') }}" alt="Logo" class="h-20 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-6 ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        style="color: #f0eae3 !important;">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('records.index')" :active="request()->routeIs('records.index')"
                        style="color: #f0eae3 !important;">
                        {{ __('Records') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Section -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-[#f0eae3] hover:text-white transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-2 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-[#f0eae3] hover:text-white hover:bg-[#7d1a3b] transition">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-[#9f234a] bg-opacity-90 border-t border-[#e7a739]">
        <div class="px-4 pt-2 pb-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[#f0eae3] hover:text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('records.index')" :active="request()->routeIs('records.index')" class="text-[#f0eae3] hover:text-white">
                {{ __('Records') }}
            </x-responsive-nav-link>
        </div>

        <!-- Mobile User Menu -->
        <div class="pt-4 pb-1 border-t border-[#e7a739]">
            <div class="px-4 text-[#f0eae3]">
                <div class="font-semibold">{{ Auth::user()->name }}</div>
                <div class="text-sm">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-[#f0eae3] hover:text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-[#f0eae3] hover:text-white">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
