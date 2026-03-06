<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold shadow-sm">
                        S
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold text-slate-800">SPK Putus Sekolah</p>
                        <p class="text-xs text-slate-500">Admin Panel</p>
                    </div>
                </a>

                <div class="hidden lg:flex items-center gap-2">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.*')">
                            {{ __('User') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                            {{ __('Kelas') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                            {{ __('Siswa') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.kriteria.index')" :active="request()->routeIs('admin.kriteria.*')">
                            {{ __('Kriteria') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.subkriteria.index')" :active="request()->routeIs('admin.subkriteria.*')">
                            {{ __('Subkriteria') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.periode.index')" :active="request()->routeIs('admin.periode.*')">
                            {{ __('Periode') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'wali_kelas')
                        <x-nav-link :href="route('walas.dashboard')" :active="request()->routeIs('walas.dashboard')">
                            {{ __('Dashboard Walas') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'kepsek')
                        <x-nav-link :href="route('kepsek.dashboard')" :active="request()->routeIs('kepsek.dashboard')">
                            {{ __('Dashboard Kepsek') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-4">
                <div class="hidden md:flex flex-col text-right">
                    <span class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-slate-500">
                        @if(Auth::user()->role === 'admin')
                            Admin
                        @elseif(Auth::user()->role === 'wali_kelas')
                            Wali Kelas
                        @elseif(Auth::user()->role === 'kepsek')
                            Kepala Sekolah
                        @endif
                    </span>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
                            <span>Akun</span>
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-lg p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden border-t border-slate-200 bg-white">
        <div class="space-y-1 px-4 py-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.*')">
                    {{ __('User') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                    {{ __('Kelas') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                    {{ __('Siswa') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.kriteria.index')" :active="request()->routeIs('admin.kriteria.*')">
                    {{ __('Kriteria') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.subkriteria.index')" :active="request()->routeIs('admin.subkriteria.*')">
                    {{ __('Subkriteria') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.periode.index')" :active="request()->routeIs('admin.periode.*')">
                    {{ __('Periode') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role === 'wali_kelas')
                <x-responsive-nav-link :href="route('walas.dashboard')" :active="request()->routeIs('walas.dashboard')">
                    {{ __('Dashboard Walas') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role === 'kepsek')
                <x-responsive-nav-link :href="route('kepsek.dashboard')" :active="request()->routeIs('kepsek.dashboard')">
                    {{ __('Dashboard Kepsek') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="border-t border-slate-200 px-4 py-4">
            <div class="mb-3">
                <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>