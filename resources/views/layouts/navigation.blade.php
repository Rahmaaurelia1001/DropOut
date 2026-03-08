<nav x-data="{ open: false }" style="background:#fff; border-bottom:1px solid #e2e8f0; position:sticky; top:0; z-index:30;">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        .spk-nav * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .spk-nav-link {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
        }
        .spk-nav-link:hover { background: #f1f5f9; color: #1e293b; }
        .spk-nav-link.active { background: #eff6ff; color: #2563eb; font-weight: 600; }

        .spk-hamburger { display: none; }

        .spk-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .spk-dropdown { position: relative; display: inline-block; }
        .spk-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.10);
            min-width: 190px;
            z-index: 50;
            overflow: hidden;
        }
        .spk-dropdown:hover .spk-dropdown-menu { display: block; }
        .spk-dropdown-item {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 14px;
            font-size: 13px;
            color: #475569;
            text-decoration: none;
            transition: background 0.12s;
            font-weight: 500;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            border-radius: 8px;
            font-family: inherit;
        }
        .spk-dropdown-item:hover { background: #f1f5f9; color: #1e293b; }

        .spk-mobile-link {
            display: block;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            text-decoration: none;
            transition: background 0.15s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .spk-mobile-link:hover { background: #f1f5f9; color: #1e293b; }
        .spk-mobile-link.active { background: #eff6ff; color: #2563eb; font-weight: 600; }

        @media (max-width: 1024px) {
            .spk-nav-links { display: none !important; }
            .spk-hamburger { display: flex !important; }
        }
        @media (max-width: 640px) {
            .spk-user-info { display: none !important; }
        }
    </style>

    <div class="spk-nav" style="width:100%; padding:0 24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; height:64px;">

            {{-- LEFT: Logo + Nav Links --}}
            <div style="display:flex; align-items:center; gap:20px;">

                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" style="display:flex; align-items:center; gap:10px; text-decoration:none; flex-shrink:0;">
                    <div style="width:38px; height:38px; border-radius:10px; background:linear-gradient(135deg,#1d4ed8,#2563eb); display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(37,99,235,0.3);">
                        <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:13px; font-weight:700; color:#1e293b; margin:0; line-height:1.2;">SPK Putus Sekolah</p>
                        <p style="font-size:11px; color:#94a3b8; margin:0;">Admin Panel</p>
                    </div>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="spk-nav-links" style="display:flex; align-items:center; gap:2px;">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="spk-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('admin.user.index') }}" class="spk-nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">User</a>
                        <a href="{{ route('admin.kelas.index') }}" class="spk-nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">Kelas</a>
                        <a href="{{ route('admin.siswa.index') }}" class="spk-nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">Siswa</a>
                        <a href="{{ route('admin.mapel.index') }}" class="spk-nav-link {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">Mapel</a>
                        <a href="{{ route('admin.kriteria.index') }}" class="spk-nav-link {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}">Kriteria</a>
                        <a href="{{ route('admin.subkriteria.index') }}" class="spk-nav-link {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }}">Subkriteria</a>
                        <a href="{{ route('admin.periode.index') }}" class="spk-nav-link {{ request()->routeIs('admin.periode.*') ? 'active' : '' }}">Periode</a>
                    @endif
                    @if(Auth::user()->role === 'wali_kelas')
                        <a href="{{ route('walas.dashboard') }}" class="spk-nav-link {{ request()->routeIs('walas.dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('walas.import.index') }}" class="spk-nav-link {{ request()->routeIs('walas.import.*') ? 'active' : '' }}">Import Data</a>
                    @endif
                    @if(Auth::user()->role === 'kepsek')
                        <a href="{{ route('kepsek.dashboard') }}" class="spk-nav-link {{ request()->routeIs('kepsek.dashboard') ? 'active' : '' }}">Dashboard</a>
                    @endif
                </div>
            </div>

            {{-- RIGHT: User Info + Dropdown --}}
            <div style="display:flex; align-items:center; gap:12px;">

                <div class="spk-user-info" style="display:flex; flex-direction:column; align-items:flex-end;">
                    <span style="font-size:13px; font-weight:600; color:#1e293b;">{{ Auth::user()->name }}</span>
                    <span style="font-size:11px; color:#94a3b8;">
                        @if(Auth::user()->role === 'admin') Admin
                        @elseif(Auth::user()->role === 'wali_kelas') Wali Kelas
                        @elseif(Auth::user()->role === 'kepsek') Kepala Sekolah
                        @endif
                    </span>
                </div>

                <div class="spk-dropdown">
                    <button style="display:flex; align-items:center; gap:8px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:6px 12px 6px 8px; cursor:pointer;"
                        onmouseover="this.style.background='#eff6ff'; this.style.borderColor='#93c5fd';"
                        onmouseout="this.style.background='#f8fafc'; this.style.borderColor='#e2e8f0';">
                        <div class="spk-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <svg width="14" height="14" fill="none" stroke="#94a3b8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="spk-dropdown-menu">
                        <div style="padding:12px 14px 8px; border-bottom:1px solid #f1f5f9;">
                            <p style="font-size:13px; font-weight:700; color:#1e293b; margin:0;">{{ Auth::user()->name }}</p>
                            <p style="font-size:11px; color:#94a3b8; margin:2px 0 0;">{{ Auth::user()->email }}</p>
                        </div>
                        <div style="padding:6px;">
                            <a href="{{ route('profile.edit') }}" class="spk-dropdown-item">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </a>
                            <div style="height:1px; background:#f1f5f9; margin:4px 0;"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="spk-dropdown-item" style="color:#ef4444;">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Hamburger --}}
                <button class="spk-hamburger" @click="open = !open"
                    style="display:none; align-items:center; justify-content:center; padding:8px; border-radius:8px; border:1px solid #e2e8f0; background:#fff; cursor:pointer;">
                    <svg width="20" height="20" stroke="#64748b" fill="none" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" style="border-top:1px solid #e2e8f0; background:#fff; display:none;">
        <div style="padding:12px 20px;">
            <div style="display:flex; align-items:center; gap:10px; padding:10px 0 14px; border-bottom:1px solid #f1f5f9; margin-bottom:8px;">
                <div class="spk-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <p style="font-size:13px; font-weight:700; color:#1e293b; margin:0;">{{ Auth::user()->name }}</p>
                    <p style="font-size:11px; color:#94a3b8; margin:0;">{{ Auth::user()->email }}</p>
                </div>
            </div>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="spk-mobile-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.user.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">User</a>
                <a href="{{ route('admin.kelas.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">Kelas</a>
                <a href="{{ route('admin.siswa.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">Siswa</a>
                <a href="{{ route('admin.mapel.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">Mapel</a>
                <a href="{{ route('admin.kriteria.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}">Kriteria</a>
                <a href="{{ route('admin.subkriteria.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }}">Subkriteria</a>
                <a href="{{ route('admin.periode.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.periode.*') ? 'active' : '' }}">Periode</a>
            @endif
            @if(Auth::user()->role === 'wali_kelas')
                <a href="{{ route('walas.dashboard') }}" class="spk-mobile-link">Dashboard</a>
                <a href="{{ route('walas.import.index') }}" class="spk-mobile-link">Import Data</a>
            @endif
            @if(Auth::user()->role === 'kepsek')
                <a href="{{ route('kepsek.dashboard') }}" class="spk-mobile-link">Dashboard</a>
            @endif

            <div style="border-top:1px solid #f1f5f9; margin-top:8px; padding-top:8px;">
                <a href="{{ route('profile.edit') }}" class="spk-mobile-link">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="spk-mobile-link" style="width:100%; text-align:left; background:none; border:none; cursor:pointer; color:#ef4444;">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>