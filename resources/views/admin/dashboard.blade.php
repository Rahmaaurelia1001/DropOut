<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --blue:     #2563eb;
    --blue-lt:  #eff6ff;
    --blue-mid: #dbeafe;
    --white:    #ffffff;
    --gray-50:  #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --green-lt: #f0fdf4;
    --green-bd: #bbf7d0;
    --green-dk: #16a34a;
    --sidebar-w: 224px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* Sembunyikan topbar bawaan x-app-layout */
nav[x-data] { display: none !important; }
header { display: none !important; }

.da-root {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--gray-50);
    color: var(--gray-800);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
}

/* ══════════════════════════
   SIDEBAR
══════════════════════════ */
.da-shell { display: flex; min-height: 100vh; }

.da-sidebar {
    width: var(--sidebar-w);
    background: var(--white);
    border-right: 1px solid var(--gray-200);
    position: fixed; top: 0; left: 0; bottom: 0;
    z-index: 40;
    display: flex; flex-direction: column;
    overflow: hidden;
}

.sb-brand {
    padding: 18px 16px 14px;
    display: flex; align-items: center; gap: 10px;
    border-bottom: 1px solid var(--gray-100);
    flex-shrink: 0;
}
.sb-logo {
    width: 36px; height: 36px; border-radius: 9px;
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(37,99,235,.25);
}
.sb-brand-name { font-size: 13px; font-weight: 800; color: var(--gray-900); line-height: 1.2; }
.sb-brand-sub  { font-size: 10px; color: var(--gray-400); font-weight: 500; margin-top: 1px; }

.sb-nav { padding: 12px 10px; flex: 1; overflow-y: auto; min-height: 0; }
.sb-user {
    padding: 12px 14px;
    border-top: 1px solid var(--gray-100);
    display: flex; align-items: center; gap: 9px;
    flex-shrink: 0;
    background: var(--white);
}
.sb-nav-section { font-size: 9.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.1em; padding: 0 8px; margin: 14px 0 5px; }
.sb-nav-section:first-child { margin-top: 0; }

.sb-item {
    display: flex; align-items: center; gap: 9px;
    padding: 8px 10px; border-radius: 8px;
    text-decoration: none; font-size: 12.5px; font-weight: 600;
    color: var(--gray-500);
    transition: all .13s; margin-bottom: 1px;
}
.sb-item:hover { background: var(--gray-100); color: var(--gray-800); }
.sb-item.active { background: var(--blue-lt); color: var(--blue); }
.sb-item svg { flex-shrink: 0; }


.sb-user-av {
    width: 30px; height: 30px; border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #38bdf8);
    color: white; font-size: 11px; font-weight: 800;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.sb-user-name { font-size: 12px; font-weight: 700; color: var(--gray-800); line-height: 1.2; }
.sb-user-role { font-size: 10.5px; color: var(--gray-400); font-weight: 500; }
.sb-action-btn {
    background: none; border: none; cursor: pointer;
    padding: 5px; color: var(--gray-400); border-radius: 6px;
    transition: all .13s; display: flex; align-items: center;
    text-decoration: none; flex-shrink: 0;
}
.sb-action-btn:hover { background: var(--gray-100); color: var(--gray-700); }
.sb-action-logout:hover { background: #fee2e2; color: #ef4444; }

/* ══════════════════════════
   MAIN
══════════════════════════ */
.da-main {
    margin-left: var(--sidebar-w);
    flex: 1; display: flex; flex-direction: column; min-width: 0;
}

/* Page header */
.da-phead {
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
    padding: 20px 28px;
    display: flex; align-items: center; justify-content: space-between;
}
.da-phead-title { font-size: 20px; font-weight: 800; color: var(--gray-900); letter-spacing: -0.4px; }
.da-phead-sub   { font-size: 12px; color: var(--gray-400); font-weight: 500; margin-top: 2px; }
.da-phead-date  {
    font-size: 11px; color: var(--gray-400); font-weight: 500;
    background: var(--gray-100); border: 1px solid var(--gray-200);
    padding: 5px 12px; border-radius: 7px; white-space: nowrap;
}

/* Stat strip */
.da-stats {
    display: grid; grid-template-columns: repeat(6, 1fr);
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
}
.da-stat {
    padding: 20px 22px;
    border-right: 1px solid var(--gray-200);
    transition: background .13s; cursor: default;
}
.da-stat:last-child { border-right: none; }
.da-stat:hover { background: var(--gray-50); }
.da-stat-lbl {
    font-size: 10px; font-weight: 700; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.09em; margin-bottom: 8px;
}
.da-stat-num {
    font-size: 28px; font-weight: 800; color: var(--gray-900);
    letter-spacing: -1.5px; line-height: 1;
}
.da-stat-num.blue { color: var(--blue); }

/* Body */
.da-body {
    padding: 24px 28px;
    display: grid;
    grid-template-columns: 1fr 260px;
    gap: 20px;
}

/* Section heading */
.da-sec-hd {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 14px;
}
.da-sec-title {
    font-size: 12.5px; font-weight: 800; color: var(--gray-800);
    display: flex; align-items: center; gap: 8px;
}
.da-sec-title::before {
    content: ''; width: 4px; height: 15px;
    background: var(--blue); border-radius: 2px; display: block;
}
.da-sec-count { font-size: 11px; color: var(--gray-400); font-weight: 600; }

/* Nav grid */
.da-nav-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }

.da-nav-card {
    display: flex; align-items: center; gap: 12px;
    padding: 15px;
    background: var(--white);
    border: 1.5px solid var(--gray-200);
    border-radius: 12px;
    text-decoration: none;
    transition: all .15s;
    position: relative; overflow: hidden;
}
.da-nav-card::after {
    content: ''; position: absolute;
    bottom: 0; left: 0; right: 0; height: 3px;
    background: var(--blue);
    transform: scaleX(0); transform-origin: left;
    transition: transform .2s;
}
.da-nav-card:hover { border-color: var(--blue-mid); box-shadow: 0 3px 14px rgba(37,99,235,.09); transform: translateY(-2px); }
.da-nav-card:hover::after { transform: scaleX(1); }
.da-nav-card:hover .da-nav-title { color: var(--blue); }
.da-nav-card:hover .da-nav-ico { background: var(--blue); border-color: var(--blue); }
.da-nav-card:hover .da-nav-ico svg { stroke: white; }

.da-nav-ico {
    width: 38px; height: 38px; border-radius: 10px;
    background: var(--blue-lt); border: 1.5px solid var(--blue-mid);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: all .15s;
}
.da-nav-title { font-size: 12.5px; font-weight: 700; color: var(--gray-800); margin-bottom: 2px; transition: color .15s; }
.da-nav-sub   { font-size: 10.5px; color: var(--gray-400); font-weight: 500; }

/* Sidebar panels */
.da-panels { display: flex; flex-direction: column; gap: 14px; }

.da-panel {
    background: var(--white);
    border: 1.5px solid var(--gray-200);
    border-radius: 12px; overflow: hidden;
}
.da-panel-head {
    padding: 11px 15px;
    border-bottom: 1px solid var(--gray-100);
    display: flex; align-items: center; justify-content: space-between;
}
.da-panel-title { font-size: 11.5px; font-weight: 800; color: var(--gray-900); }
.da-panel-link {
    font-size: 11px; font-weight: 700; color: var(--blue);
    text-decoration: none; display: flex; align-items: center; gap: 2px; transition: color .12s;
}
.da-panel-link:hover { color: #1d4ed8; }

.da-stu-row {
    display: flex; align-items: center; gap: 9px;
    padding: 8px 15px; border-bottom: 1px solid var(--gray-100);
    transition: background .1s;
}
.da-stu-row:last-child { border-bottom: none; }
.da-stu-row:hover { background: var(--blue-lt); }
.da-av {
    width: 26px; height: 26px; border-radius: 50%;
    background: var(--blue); color: white;
    font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.da-stu-name { font-size: 11.5px; font-weight: 600; color: var(--gray-800); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.da-stu-nisn { font-size: 10px; color: var(--gray-400); font-weight: 500; }
.da-stu-num  { margin-left: auto; font-size: 10px; font-weight: 700; color: var(--gray-200); flex-shrink: 0; }

.da-per-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 9px 15px; border-bottom: 1px solid var(--gray-100);
    transition: background .1s;
}
.da-per-row:last-child { border-bottom: none; }
.da-per-row:hover { background: var(--blue-lt); }
.da-per-ta  { font-size: 11.5px; font-weight: 600; color: var(--gray-800); }
.da-per-sem { font-size: 10px; color: var(--gray-400); font-weight: 500; margin-top: 1px; }

.badge-on {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 10px; font-weight: 700; color: var(--green-dk);
    background: var(--green-lt); border: 1px solid var(--green-bd);
    padding: 2px 7px; border-radius: 99px; white-space: nowrap;
}
.badge-on::before {
    content: ''; width: 5px; height: 5px; border-radius: 50%;
    background: var(--green-dk); animation: blink 2s ease-in-out infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }
.badge-off {
    font-size: 10px; font-weight: 700; color: var(--gray-400);
    background: var(--gray-100); border: 1px solid var(--gray-200);
    padding: 2px 7px; border-radius: 99px; white-space: nowrap;
}

.da-empty { padding: 16px 15px; text-align: center; font-size: 12px; color: #d1d5db; font-style: italic; }

/* Anim */
@keyframes fadeUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
.da-nav-card { animation: fadeUp .28s ease both; }
.da-nav-card:nth-child(1){animation-delay:.04s}
.da-nav-card:nth-child(2){animation-delay:.08s}
.da-nav-card:nth-child(3){animation-delay:.12s}
.da-nav-card:nth-child(4){animation-delay:.16s}
.da-nav-card:nth-child(5){animation-delay:.20s}
.da-nav-card:nth-child(6){animation-delay:.24s}
.da-nav-card:nth-child(7){animation-delay:.28s}
.da-nav-card:nth-child(8){animation-delay:.32s}

/* Responsive */
@media(max-width:1200px){ .da-nav-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:1024px){
    .da-body { grid-template-columns: 1fr; padding: 18px 20px; }
    .da-stats { grid-template-columns: repeat(3,1fr); }
    .da-phead { padding: 16px 20px; }
}
@media(max-width:768px){
    .da-sidebar { transform: translateX(-100%); }
    .da-main    { margin-left: 0; }
    .da-stats   { grid-template-columns: repeat(2,1fr); }
    .da-nav-grid { grid-template-columns: repeat(2,1fr); }
}
</style>

<div class="da-root" id="spk-admin-dash">
<div class="da-shell">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="da-sidebar">

        {{-- Brand --}}
        <div class="sb-brand">
            <div class="sb-logo">
                <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <div>
                <div class="sb-brand-name">SPK Putus Sekolah</div>
                <div class="sb-brand-sub">SDN 11 Kampung Batu</div>
            </div>
        </div>

        {{-- Nav --}}
        <div class="sb-nav">
            <div class="sb-nav-section">Menu</div>
            <a href="{{ route('dashboard') }}" class="sb-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="sb-nav-section">Manajemen</div>
            <a href="{{ route('admin.user.index') }}" class="sb-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Manajemen User
            </a>
            <a href="{{ route('admin.kelas.index') }}" class="sb-item {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Data Kelas
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="sb-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Data Siswa
            </a>
            <a href="{{ route('admin.mapel.index') }}" class="sb-item {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Mata Pelajaran
            </a>

            <div class="sb-nav-section">SPK</div>
            <a href="{{ route('admin.kriteria.index') }}" class="sb-item {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Data Kriteria
            </a>
            <a href="{{ route('admin.subkriteria.index') }}" class="sb-item {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg>
                Data Subkriteria
            </a>
            <a href="{{ route('admin.periode.index') }}" class="sb-item {{ request()->routeIs('admin.periode.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Periode Penilaian
            </a>
            <a href="{{ route('admin.master-rekomendasi.index') }}" class="sb-item {{ request()->routeIs('admin.master-rekomendasi.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Rekomendasi
            </a>
        </div>

        {{-- User footer --}}
        <div class="sb-user">
            <div class="sb-user-av">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div style="min-width:0; flex:1">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Administrator</div>
            </div>
            <div style="display:flex; align-items:center; gap:4px; flex-shrink:0;">
                <a href="{{ route('profile.edit') }}" class="sb-action-btn" title="Profil">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="sb-action-btn sb-action-logout" title="Log Out">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- ══ MAIN ══ --}}
    <main class="da-main">

        {{-- Page header --}}
        <div class="da-phead">
            <div>
                <div class="da-phead-title">Dashboard Admin</div>
                <div class="da-phead-sub">Sistem Identifikasi Risiko Putus Sekolah</div>
            </div>
            <span class="da-phead-date" id="spk-date"></span>
        </div>

        {{-- Stat strip --}}
        <div class="da-stats">
            <div class="da-stat">
                <div class="da-stat-lbl">User</div>
                <div class="da-stat-num">{{ $totalUsers }}</div>
            </div>
            <div class="da-stat">
                <div class="da-stat-lbl">Kelas</div>
                <div class="da-stat-num">{{ $totalKelas }}</div>
            </div>
            <div class="da-stat">
                <div class="da-stat-lbl">Siswa</div>
                <div class="da-stat-num blue">{{ $totalSiswa }}</div>
            </div>
            <div class="da-stat">
                <div class="da-stat-lbl">Kriteria</div>
                <div class="da-stat-num">{{ $totalKriteria }}</div>
            </div>
            <div class="da-stat">
                <div class="da-stat-lbl">Subkriteria</div>
                <div class="da-stat-num">{{ $totalSubkriteria }}</div>
            </div>
            <div class="da-stat">
                <div class="da-stat-lbl">Periode</div>
                <div class="da-stat-num">{{ $totalPeriode }}</div>
            </div>
        </div>

        {{-- Body --}}
        <div class="da-body">

            {{-- LEFT --}}
            <div>
                <div class="da-sec-hd">
                    <span class="da-sec-title">Menu Utama</span>
                    <span class="da-sec-count">8 modul</span>
                </div>
                <div class="da-nav-grid">

                    <a href="{{ route('admin.user.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                        <div><div class="da-nav-title">Manajemen User</div><div class="da-nav-sub">Admin, wali kelas, kepsek</div></div>
                    </a>

                    <a href="{{ route('admin.kelas.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
                        <div><div class="da-nav-title">Data Kelas</div><div class="da-nav-sub">Kelola kelas & tahun ajaran</div></div>
                    </a>

                    <a href="{{ route('admin.siswa.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                        <div><div class="da-nav-title">Data Siswa</div><div class="da-nav-sub">Kelola data siswa per kelas</div></div>
                    </a>

                    <a href="{{ route('admin.mapel.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                        <div><div class="da-nav-title">Mata Pelajaran</div><div class="da-nav-sub">Kelola daftar mata pelajaran</div></div>
                    </a>

                    <a href="{{ route('admin.kriteria.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div>
                        <div><div class="da-nav-title">Data Kriteria</div><div class="da-nav-sub">Kriteria penilaian risiko</div></div>
                    </a>

                    <a href="{{ route('admin.subkriteria.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg></div>
                        <div><div class="da-nav-title">Data Subkriteria</div><div class="da-nav-sub">Subkriteria & nilai skala</div></div>
                    </a>

                    <a href="{{ route('admin.periode.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                        <div><div class="da-nav-title">Periode Penilaian</div><div class="da-nav-sub">Periode aktif & riwayat</div></div>
                    </a>

                    <a href="{{ route('admin.master-rekomendasi.index') }}" class="da-nav-card">
                        <div class="da-nav-ico"><svg width="17" height="17" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg></div>
                        <div><div class="da-nav-title">Rekomendasi</div><div class="da-nav-sub">Tindak lanjut risiko siswa</div></div>
                    </a>

                </div>
            </div>

            {{-- RIGHT --}}
            <div class="da-panels">

                <div class="da-panel">
                    <div class="da-panel-head">
                        <span class="da-panel-title">Siswa Terbaru</span>
                        <a href="{{ route('admin.siswa.index') }}" class="da-panel-link">Semua <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
                    </div>
                    @forelse ($siswaTerbaru as $i => $siswa)
                        <div class="da-stu-row">
                            <div class="da-av">{{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}</div>
                            <div style="min-width:0;flex:1">
                                <div class="da-stu-name">{{ $siswa->nama_siswa }}</div>
                                <div class="da-stu-nisn">{{ $siswa->nisn }}</div>
                            </div>
                            <span class="da-stu-num">#{{ $i + 1 }}</span>
                        </div>
                    @empty
                        <div class="da-empty">Belum ada data siswa</div>
                    @endforelse
                </div>

                <div class="da-panel">
                    <div class="da-panel-head">
                        <span class="da-panel-title">Periode Terbaru</span>
                        <a href="{{ route('admin.periode.index') }}" class="da-panel-link">Semua <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
                    </div>
                    @forelse ($periodeTerbaru as $periode)
                        <div class="da-per-row">
                            <div>
                                <div class="da-per-ta">{{ $periode->tahun_ajaran }}</div>
                                <div class="da-per-sem">{{ $periode->semester }}</div>
                            </div>
                            @if($periode->status == 'aktif')
                                <span class="badge-on">Aktif</span>
                            @else
                                <span class="badge-off">Nonaktif</span>
                            @endif
                        </div>
                    @empty
                        <div class="da-empty">Belum ada periode</div>
                    @endforelse
                </div>

            </div>
        </div>

    </main>
</div>
</div>

<script>
    const el = document.getElementById('spk-date');
    if (el) el.textContent = new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
</script>

</x-app-layout>