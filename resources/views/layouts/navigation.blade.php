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

        /* Bell notification styles */
        .bell-wrap { position: relative; display: inline-flex; align-items: center; }
        .bell-btn {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .15s;
            color: #64748b;
        }
        .bell-btn:hover { background: #eff6ff; border-color: #93c5fd; color: #2563eb; }
        .bell-badge {
            position: absolute;
            top: -4px; right: -4px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: 700;
            border-radius: 999px;
            min-width: 18px;
            height: 18px;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border: 2px solid white;
        }
        .bell-panel {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            width: 360px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.12);
            z-index: 100;
            overflow: hidden;
        }
        .bell-panel.show { display: block; }
        .bell-panel-head {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .bell-panel-title { font-size: 13px; font-weight: 800; color: #1e293b; }
        .bell-mark-all { font-size: 11px; font-weight: 600; color: #2563eb; cursor: pointer; background: none; border: none; }
        .bell-list { max-height: 320px; overflow-y: auto; }
        .bell-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f8fafc;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            transition: background .12s;
        }
        .bell-item:hover { background: #f8fafc; }
        .bell-item.unread { background: #eff6ff; }
        .bell-item-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #2563eb;
            flex-shrink: 0;
            margin-top: 5px;
        }
        .bell-item-dot.read { background: transparent; }
        .bell-item-body { flex: 1; min-width: 0; }
        .bell-item-role {
            font-size: 10px; font-weight: 800;
            text-transform: uppercase;
            color: #2563eb;
            background: #eff6ff;
            padding: 2px 7px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 3px;
        }
        .bell-item-text { font-size: 12px; font-weight: 600; color: #334155; line-height: 1.4; }
        .bell-item-name { font-size: 11px; color: #94a3b8; margin-top: 2px; font-weight: 500; }
        .bell-item-time { font-size: 10px; color: #cbd5e1; margin-top: 2px; }
        .bell-empty { padding: 32px 16px; text-align: center; color: #94a3b8; font-size: 13px; }

        @media (max-width: 1024px) {
            .spk-nav-links { display: none !important; }
            .spk-hamburger { display: flex !important; }
        }
        @media (max-width: 640px) {
            .spk-user-info { display: none !important; }
            .bell-panel { width: 300px; right: -60px; }
        }
    </style>

    <div class="spk-nav" style="width:100%; padding:0 24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; height:64px;">

            {{-- LEFT: Logo + Nav Links --}}
            <div style="display:flex; align-items:center; gap:20px;">
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
                        <a href="{{ route('admin.master-rekomendasi.index') }}" class="spk-nav-link {{ request()->routeIs('admin.master-rekomendasi.*') ? 'active' : '' }}">Rekomendasi</a>
                    @endif
                    @if(Auth::user()->role === 'wali_kelas')
                        <a href="{{ route('walas.dashboard') }}" class="spk-nav-link {{ request()->routeIs('walas.dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('walas.import.index') }}" class="spk-nav-link {{ request()->routeIs('walas.import.*') ? 'active' : '' }}">Import Data</a>
                        <a href="{{ route('walas.riwayat') }}" class="spk-nav-link {{ request()->routeIs('walas.riwayat.*') ? 'active' : '' }}">Riwayat Analisis</a>
                    @endif
                    @if(Auth::user()->role === 'kepsek')
                        <a href="{{ route('kepsek.dashboard') }}" class="spk-nav-link {{ request()->routeIs('kepsek.dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('kepsek.kriteria.index') }}" class="spk-nav-link {{ request()->routeIs('kepsek.kriteria.*') ? 'active' : '' }}">Bobot Kriteria</a>
                        <a href="{{ route('kepsek.mfep.hasil') }}" class="spk-nav-link {{ request()->routeIs('kepsek.mfep.hasil') ? 'active' : '' }}">Hasil Perhitungan</a>
                        <a href="{{ route('kepsek.ranking') }}" class="spk-nav-link {{ request()->routeIs('kepsek.ranking') ? 'active' : '' }}">Ranking Risiko</a>
                        <a href="{{ route('kepsek.laporan') }}" class="spk-nav-link {{ request()->routeIs('kepsek.laporan') ? 'active' : '' }}">Laporan SPK</a>
                    @endif
                </div>
            </div>

            {{-- RIGHT: Bell + User Info + Dropdown --}}
            <div style="display:flex; align-items:center; gap:12px;">

                {{-- 🔔 BELL NOTIFICATION --}}
                <div class="bell-wrap" id="bellWrap">
                    <button class="bell-btn" id="bellBtn" onclick="toggleBell(event)">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="bell-badge" id="bellBadge"></span>
                    </button>
                    <div class="bell-panel" id="bellPanel">
                        <div class="bell-panel-head">
                            <span class="bell-panel-title">🔔 Aktivitas Terbaru</span>
                            <button class="bell-mark-all" onclick="markAllRead()">Tandai semua dibaca</button>
                        </div>
                        <div class="bell-list" id="bellList">
                            <div class="bell-empty">Memuat aktivitas...</div>
                        </div>
                    </div>
                </div>

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
                <a href="{{ route('admin.master-rekomendasi.index') }}" class="spk-mobile-link {{ request()->routeIs('admin.master-rekomendasi.*') ? 'active' : '' }}">Rekomendasi</a>
            @endif
            @if(Auth::user()->role === 'wali_kelas')
                <a href="{{ route('walas.dashboard') }}" class="spk-mobile-link">Dashboard</a>
                <a href="{{ route('walas.import.index') }}" class="spk-mobile-link">Import Data</a>
            @endif
            @if(Auth::user()->role === 'kepsek')
                <a href="{{ route('kepsek.dashboard') }}" class="spk-mobile-link {{ request()->routeIs('kepsek.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('kepsek.kriteria.index') }}" class="spk-mobile-link {{ request()->routeIs('kepsek.kriteria.*') ? 'active' : '' }}">Bobot Kriteria</a>
                <a href="{{ route('kepsek.mfep.hasil') }}" class="spk-mobile-link {{ request()->routeIs('kepsek.mfep.hasil') ? 'active' : '' }}">Hasil Perhitungan</a>
                <a href="{{ route('kepsek.ranking') }}" class="spk-mobile-link {{ request()->routeIs('kepsek.ranking') ? 'active' : '' }}">Ranking Risiko</a>
                <a href="{{ route('kepsek.laporan') }}" class="spk-mobile-link {{ request()->routeIs('kepsek.laporan') ? 'active' : '' }}">Laporan SPK</a>
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

    {{-- Bell Notification Script --}}
    <script>
        // ✅ GANTI JADI
if (typeof STORAGE_KEY === 'undefined') {
    var STORAGE_KEY = 'spk_read_logs';
}

        function getReadIds() {
            return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
        }

        function saveReadIds(ids) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
        }

        function toggleBell(e) {
            e.stopPropagation();
            const panel = document.getElementById('bellPanel');
            panel.classList.toggle('show');
            if (panel.classList.contains('show')) loadLogs();
        }

        document.addEventListener('click', function (e) {
            const wrap = document.getElementById('bellWrap');
            if (wrap && !wrap.contains(e.target)) {
                document.getElementById('bellPanel').classList.remove('show');
            }
        });

        function timeAgo(dateStr) {
            const diff = Math.floor((new Date() - new Date(dateStr)) / 1000);
            if (diff < 60) return diff + ' detik lalu';
            if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
            if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
            return Math.floor(diff / 86400) + ' hari lalu';
        }

        function roleLabel(role) {
            if (role === 'admin') return 'Admin';
            if (role === 'wali_kelas') return 'Wali Kelas';
            if (role === 'kepsek') return 'Kepsek';
            return role;
        }

        function loadLogs() {
            fetch('{{ route("log.activities") }}')
                .then(r => r.json())
                .then(logs => {
                    const readIds = getReadIds();
                    const list = document.getElementById('bellList');
                    const badge = document.getElementById('bellBadge');

                    if (!logs.length) {
                        list.innerHTML = '<div class="bell-empty">Belum ada aktivitas.</div>';
                        badge.style.display = 'none';
                        return;
                    }

                    const unreadCount = logs.filter(l => !readIds.includes(l.id)).length;
                    if (unreadCount > 0) {
                        badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }

                    list.innerHTML = logs.map(log => {
                        const isRead = readIds.includes(log.id);
                        return `
                            <div class="bell-item ${isRead ? '' : 'unread'}" onclick="markRead(${log.id})">
                                <div class="bell-item-dot ${isRead ? 'read' : ''}"></div>
                                <div class="bell-item-body">
                                    <span class="bell-item-role">${roleLabel(log.role)}</span>
                                    <div class="bell-item-text">${log.activity}</div>
                                    <div class="bell-item-name">oleh ${log.nama_user}</div>
                                    <div class="bell-item-time">${timeAgo(log.created_at)}</div>
                                </div>
                            </div>`;
                    }).join('');
                })
                .catch(() => {
                    document.getElementById('bellList').innerHTML = '<div class="bell-empty">Gagal memuat aktivitas.</div>';
                });
        }

        function markRead(id) {
            const ids = getReadIds();
            if (!ids.includes(id)) {
                ids.push(id);
                saveReadIds(ids);
                loadLogs();
            }
        }

        function markAllRead() {
            fetch('{{ route("log.activities") }}')
                .then(r => r.json())
                .then(logs => {
                    saveReadIds(logs.map(l => l.id));
                    loadLogs();
                });
        }

        // Auto load badge saat halaman dibuka
        window.addEventListener('DOMContentLoaded', () => {
            fetch('{{ route("log.activities") }}')
                .then(r => r.json())
                .then(logs => {
                    const readIds = getReadIds();
                    const unread = logs.filter(l => !readIds.includes(l.id)).length;
                    const badge = document.getElementById('bellBadge');
                    if (unread > 0) {
                        badge.textContent = unread > 9 ? '9+' : unread;
                        badge.style.display = 'flex';
                    }
                });
        });
    </script>
</nav>