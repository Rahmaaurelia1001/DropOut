<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue: #2563eb; --blue-lt: #eff6ff; --white: #ffffff;
        --gray-50: #f9fafb; --gray-100: #f3f4f6; --gray-200: #e5e7eb;
        --gray-400: #9ca3af; --gray-500: #64748b; --gray-700: #374151;
        --gray-800: #1e293b; --gray-900: #0f172a;
        --sidebar-w: 240px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    nav[x-data], header { display: none !important; }

    .da-root {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--gray-50);
        color: var(--gray-800);
        height: 100vh;
    }

    .da-shell { display: flex; height: 100vh; }

    /* ── SIDEBAR ── */
    .da-sidebar {
        width: var(--sidebar-w);
        background: var(--white);
        border-right: 1px solid var(--gray-200);
        display: flex; flex-direction: column; flex-shrink: 0;
    }
    .sb-brand {
        padding: 20px 18px;
        display: flex; align-items: center; gap: 12px;
        border-bottom: 1px solid var(--gray-100);
    }
    .sb-logo {
        width: 36px; height: 36px; border-radius: 10px;
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(37,99,235,.2); flex-shrink: 0;
    }
    .sb-brand-name { font-size: 13px; font-weight: 800; color: var(--gray-900); line-height: 1.2; letter-spacing: -0.2px; }
    .sb-brand-sub  { font-size: 10px; color: var(--gray-400); margin-top: 1px; }

    .sb-nav { padding: 14px 10px; flex: 1; overflow-y: auto; }
    .sb-nav-section {
        font-size: 9.5px; font-weight: 700; color: var(--gray-400);
        text-transform: uppercase; letter-spacing: .1em;
        padding: 0 10px; margin: 16px 0 6px;
    }
    .sb-nav-section:first-child { margin-top: 0; }

    .sb-item {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 10px; border-radius: 9px;
        text-decoration: none; font-size: 12.5px; font-weight: 600;
        color: var(--gray-500); transition: all .15s; margin-bottom: 2px;
    }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-900); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }
    .sb-item svg { flex-shrink: 0; }

    .sb-user {
        padding: 14px 16px; border-top: 1px solid var(--gray-100);
        display: flex; align-items: center; gap: 10px; background: white;
    }
    .sb-user-av {
        width: 34px; height: 34px; border-radius: 9px;
        background: linear-gradient(135deg, #2563eb, #38bdf8);
        color: white; display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 12px; flex-shrink: 0;
    }
    .sb-user-name { font-size: 12px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { font-size: 10px; color: var(--gray-400); margin-top: 1px; }

    .sb-btn {
        background: transparent; border: none; cursor: pointer;
        padding: 6px; color: var(--gray-400); border-radius: 7px;
        transition: .15s; display: flex; align-items: center; text-decoration: none;
    }
    .sb-btn:hover { background: var(--gray-100); color: var(--gray-700); }
    .sb-btn-logout:hover { background: #fee2e2; color: #ef4444; }

    /* ── MAIN ── */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }

    /* ── TOPBAR ── */
    .da-topbar {
        background: var(--white); border-bottom: 1px solid var(--gray-200);
        padding: 14px 28px; display: flex; justify-content: space-between; align-items: center;
        flex-shrink: 0; position: sticky; top: 0; z-index: 50;
    }
    .da-topbar-title { font-size: 17px; font-weight: 800; letter-spacing: -0.4px; color: var(--gray-900); }

    /* ── STATS GRID 3x2 ── */
    .da-stats {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 14px; padding: 18px 28px;
        background: var(--white); border-bottom: 1px solid var(--gray-200); flex-shrink: 0;
    }
    .da-stat {
        background: var(--gray-50); border: 1.5px solid var(--gray-200);
        border-radius: 12px; padding: 14px 18px;
        transition: .15s;
    }
    .da-stat:hover { border-color: #bfdbfe; background: var(--blue-lt); }
    .da-stat-lbl { font-size: 9.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 5px; }
    .da-stat-num { font-size: 24px; font-weight: 800; color: var(--gray-900); letter-spacing: -0.5px; }
    .da-stat-num.blue { color: var(--blue); }

    /* ── BODY GRID ── */
    .da-body { padding: 20px 28px; display: grid; grid-template-columns: 1.8fr 1fr; gap: 20px; }

    .card {
        background: var(--white); border: 1.5px solid var(--gray-200);
        border-radius: 16px; padding: 18px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02); display: flex; flex-direction: column;
    }
    .card-title {
        font-size: 13px; font-weight: 800; color: var(--gray-900);
        display: flex; align-items: center; gap: 9px; margin-bottom: 16px;
    }
    .card-title::before {
        content: ''; width: 4px; height: 14px;
        background: var(--blue); border-radius: 4px; flex-shrink: 0;
    }

    /* Mini charts row */
    .chart-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 16px; }

    /* Siswa list */
    .stu-list { overflow-y: auto; flex: 1; }
    .stu-row { display: flex; align-items: center; gap: 11px; padding: 9px 0; border-bottom: 1px solid var(--gray-100); }
    .stu-row:last-child { border-bottom: none; }
    .stu-av {
        width: 32px; height: 32px; border-radius: 50%;
        background: var(--blue-lt); color: var(--blue);
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 800; flex-shrink: 0;
    }

    /* ── AKTIVITAS SECTION ── */
    .act-section { padding: 0 28px 28px; }
    .act-card {
        background: var(--white); border: 1.5px solid var(--gray-200);
        border-radius: 16px; overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .act-card-head {
        padding: 14px 20px; border-bottom: 1px solid var(--gray-100);
        display: flex; align-items: center; justify-content: space-between;
    }
    .act-table { width: 100%; border-collapse: collapse; font-size: 12.5px; }
    .act-table thead tr { background: var(--gray-50); }
    .act-table th {
        padding: 10px 16px; font-size: 10px; font-weight: 700;
        color: var(--gray-400); text-transform: uppercase; text-align: left; letter-spacing: .07em;
    }
    .act-table td { padding: 11px 16px; border-top: 1px solid var(--gray-100); vertical-align: middle; }
    .act-table tbody tr:hover td { background: var(--gray-50); }

    /* Bell */
    .bell-wrap { position: relative; display: inline-flex; }
    .bell-btn {
        background: var(--gray-50); border: 1.5px solid var(--gray-200);
        border-radius: 9px; padding: 8px; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: var(--gray-500); transition: .15s;
    }
    .bell-btn:hover { background: var(--blue-lt); border-color: #93c5fd; color: var(--blue); }
    .bell-badge {
        display: none; position: absolute; top: -4px; right: -4px;
        background: #ef4444; color: white; font-size: 10px; font-weight: 700;
        border-radius: 999px; min-width: 18px; height: 18px;
        align-items: center; justify-content: center; padding: 0 4px; border: 2px solid white;
    }
    .bell-panel {
        display: none; position: absolute; right: 0; top: calc(100% + 10px);
        width: 360px; background: #fff; border: 1px solid var(--gray-200);
        border-radius: 16px; box-shadow: 0 12px 32px rgba(0,0,0,0.12); z-index: 999; overflow: hidden;
    }
    .bell-panel.show { display: block; }
</style>

<div class="da-root">
<div class="da-shell">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="da-sidebar">
        <div class="sb-brand">
            <div class="sb-logo">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <div>
                <div class="sb-brand-name">SPK Putus Sekolah</div>
                <div class="sb-brand-sub">SDN 11 Kampung Batu</div>
            </div>
        </div>

        <div class="sb-nav">
            <div class="sb-nav-section">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="sb-item active">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="sb-nav-section">Manajemen</div>
            <a href="{{ route('admin.user.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Data User
            </a>
            <a href="{{ route('admin.kelas.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Data Kelas
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Data Siswa
            </a>
            <a href="{{ route('admin.mapel.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Mapel
            </a>

            <div class="sb-nav-section">Sistem SPK</div>
            <a href="{{ route('admin.kriteria.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Kriteria
            </a>
            <a href="{{ route('admin.subkriteria.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg>
                Subkriteria
            </a>
            <a href="{{ route('admin.periode.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Periode
            </a>
            <a href="{{ route('admin.master-rekomendasi.index') }}" class="sb-item">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Rekomendasi
            </a>
        </div>

        <div class="sb-user">
            <div class="sb-user-av">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div style="flex:1; min-width:0;">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Administrator</div>
            </div>
            <div style="display:flex; gap:2px;">
                <a href="{{ route('profile.edit') }}" class="sb-btn" title="Profil">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="sb-btn sb-btn-logout" title="Keluar">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ══ MAIN ══ --}}
    <main class="da-main">

        {{-- TOPBAR --}}
        <div class="da-topbar">
            <h2 class="da-topbar-title">Statistik Dashboard</h2>
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="font-size:10px; font-weight:700; color:var(--gray-500); background:var(--gray-100); padding:7px 14px; border-radius:9px;" id="date"></div>

                {{-- 🔔 BELL --}}
                <div class="bell-wrap" id="adminBellWrap">
                    <button class="bell-btn" id="adminBellBtn">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="bell-badge" id="adminBellBadge"></span>
                    </button>
                    <div class="bell-panel" id="adminBellPanel">
                        <div style="padding:13px 16px; border-bottom:1px solid var(--gray-100); display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:13px; font-weight:800; color:var(--gray-900);">Aktivitas Terbaru</span>
                            <button id="adminMarkAllBtn" style="font-size:11px; font-weight:600; color:var(--blue); background:none; border:none; cursor:pointer;">Tandai semua dibaca</button>
                        </div>
                        <div id="adminBellList" style="max-height:320px; overflow-y:auto;">
                            <div style="padding:32px 16px; text-align:center; color:var(--gray-400); font-size:13px;">Memuat aktivitas...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATS 3x2 --}}
        <div class="da-stats">
            <div class="da-stat">
                <div class="da-stat-lbl">Total User</div>
                <div class="da-stat-num">{{ $totalUsers }}</div>
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
                <div class="da-stat-lbl">Total Siswa</div>
                <div class="da-stat-num blue">{{ $totalSiswa }}</div>
            </div>
            <div class="da-stat">
                <div class="da-stat-lbl">Kelas</div>
                <div class="da-stat-num">{{ $totalKelas }}</div>
            </div>
            <div class="da-stat">
                <div class="da-stat-lbl">Periode</div>
                <div class="da-stat-num">{{ $totalPeriode }}</div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="da-body">
            {{-- Kiri: Charts --}}
            <div style="display:flex; flex-direction:column; gap:16px;">
                <div class="card">
                    <div class="card-title">Sebaran Subkriteria per Kriteria</div>
                    <canvas id="kriteriaChart" style="max-height:190px;"></canvas>
                </div>
                <div class="chart-grid">
                    <div class="card">
                        <div class="card-title" style="font-size:12px;">Komposisi Akun</div>
                        <canvas id="userChart" style="max-height:140px;"></canvas>
                    </div>
                    <div class="card">
                        <div class="card-title" style="font-size:12px;">Status Periode</div>
                        <canvas id="periodeChart" style="max-height:140px;"></canvas>
                    </div>
                </div>
            </div>

            {{-- Kanan: Siswa Terbaru --}}
            <div class="card">
                <div class="card-title">Siswa Baru</div>
                <div class="stu-list">
                    @foreach($siswaTerbaru as $s)
                    <div class="stu-row">
                        <div class="stu-av">{{ strtoupper(substr($s->nama_siswa, 0, 1)) }}</div>
                        <div style="min-width:0; flex:1;">
                            <div style="font-size:12px; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--gray-900);">{{ $s->nama_siswa }}</div>
                            <div style="font-size:10px; color:var(--gray-400);">{{ $s->nisn }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- AKTIVITAS TERBARU (5 item) --}}
        <div class="act-section">
            <div class="act-card">
                <div class="act-card-head">
                    <div style="display:flex; align-items:center; gap:9px;">
                        <span style="width:4px; height:14px; background:var(--blue); border-radius:4px; display:inline-block;"></span>
                        <span style="font-size:13px; font-weight:800; color:var(--gray-900);">Aktivitas Terbaru</span>
                    </div>
                    <span style="font-size:10px; color:var(--gray-400); background:var(--gray-100); padding:3px 10px; border-radius:99px;">5 aktivitas</span>
                </div>
                <div id="adminDashLogList" style="overflow-x:auto;">
                    <p style="text-align:center; color:var(--gray-400); font-size:13px; padding:24px;">Memuat aktivitas...</p>
                </div>
            </div>
        </div>

    </main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('date').textContent = new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });

    new Chart(document.getElementById('kriteriaChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelsKriteria) !!},
            datasets: [{
                label: 'Subkriteria',
                data: {!! json_encode($countSubkriteria) !!},
                backgroundColor: '#2563eb',
                borderRadius: 6,
                barThickness: 22
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: '#f3f4f6' } },
                x: { ticks: { font: { size: 11 } }, grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('userChart'), {
        type: 'doughnut',
        data: {
            labels: ['Admin', 'Wali Kelas', 'Kepsek'],
            datasets: [{
                data: {!! json_encode($dataUserRoles) !!},
                backgroundColor: ['#2563eb', '#38bdf8', '#cbd5e1'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '72%',
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 8, font: { size: 10, weight: '600' }, padding: 10 } }
            }
        }
    });

    new Chart(document.getElementById('periodeChart'), {
        type: 'pie',
        data: {
            labels: ['Aktif', 'Nonaktif'],
            datasets: [{
                data: {!! json_encode($dataPeriodeStatus) !!},
                backgroundColor: ['#10b981', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 8, font: { size: 10, weight: '600' }, padding: 10 } }
            }
        }
    });
</script>

{{-- Bell Notifikasi --}}
<script>
    var adminBellBtn   = document.getElementById('adminBellBtn');
    var adminBellPanel = document.getElementById('adminBellPanel');
    var adminBellBadge = document.getElementById('adminBellBadge');
    var adminBellList  = document.getElementById('adminBellList');

    function getReadIds() { return JSON.parse(localStorage.getItem('spk_read_logs') || '[]'); }
    function saveReadIds(ids) { localStorage.setItem('spk_read_logs', JSON.stringify(ids)); }

    adminBellBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        var isOpen = adminBellPanel.style.display === 'block';
        adminBellPanel.style.display = isOpen ? 'none' : 'block';
        if (!isOpen) loadBellLogs();
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('adminBellWrap').contains(e.target)) {
            adminBellPanel.style.display = 'none';
        }
    });

    document.getElementById('adminMarkAllBtn').addEventListener('click', function() {
        fetch('{{ route("log.activities") }}')
            .then(r => r.json())
            .then(logs => { saveReadIds(logs.map(l => l.id)); loadBellLogs(); });
    });

    function timeAgo(dateStr) {
        var diff = Math.floor((new Date() - new Date(dateStr)) / 1000);
        if (diff < 60) return diff + ' detik lalu';
        if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
        return Math.floor(diff / 86400) + ' hari lalu';
    }

    function roleLabel(role) {
        if (role === 'wali_kelas') return 'Wali Kelas';
        if (role === 'kepsek') return 'Kepsek';
        return 'Admin';
    }

    function loadBellLogs() {
        fetch('{{ route("log.activities") }}')
            .then(r => r.json())
            .then(logs => {
                var readIds = getReadIds();
                if (!logs.length) {
                    adminBellList.innerHTML = '<div style="padding:32px 16px; text-align:center; color:var(--gray-400); font-size:13px;">Belum ada aktivitas.</div>';
                    adminBellBadge.style.display = 'none';
                    return;
                }
                var unread = logs.filter(function(l) { return !readIds.includes(l.id); }).length;
                if (unread > 0) {
                    adminBellBadge.textContent = unread > 9 ? '9+' : unread;
                    adminBellBadge.style.display = 'flex';
                } else {
                    adminBellBadge.style.display = 'none';
                }
                adminBellList.innerHTML = logs.map(function(log) {
                    var isRead = readIds.includes(log.id);
                    return '<div onclick="adminMarkRead(' + log.id + ')" style="padding:11px 16px; border-bottom:1px solid #f8fafc; display:flex; gap:10px; cursor:pointer; background:' + (isRead ? '#fff' : '#eff6ff') + ';">'
                        + '<div style="width:7px; height:7px; border-radius:50%; background:' + (isRead ? 'transparent' : '#2563eb') + '; flex-shrink:0; margin-top:5px;"></div>'
                        + '<div style="flex:1; min-width:0;">'
                        + '<span style="background:#eff6ff; color:#2563eb; font-size:9.5px; font-weight:700; padding:2px 7px; border-radius:6px; text-transform:uppercase;">' + roleLabel(log.role) + '</span>'
                        + '<div style="font-size:12px; font-weight:600; color:#334155; margin-top:3px; line-height:1.4;">' + log.activity + '</div>'
                        + '<div style="font-size:11px; color:#94a3b8; margin-top:2px;">oleh ' + log.nama_user + '</div>'
                        + '<div style="font-size:10px; color:#cbd5e1; margin-top:2px;">' + timeAgo(log.created_at) + '</div>'
                        + '</div></div>';
                }).join('');
            })
            .catch(function() {
                adminBellList.innerHTML = '<div style="padding:32px 16px; text-align:center; color:var(--gray-400); font-size:13px;">Gagal memuat aktivitas.</div>';
            });
    }

    function adminMarkRead(id) {
        var ids = getReadIds();
        if (!ids.includes(id)) { ids.push(id); saveReadIds(ids); loadBellLogs(); }
    }

    fetch('{{ route("log.activities") }}')
        .then(r => r.json())
        .then(logs => {
            var unread = logs.filter(function(l) { return !getReadIds().includes(l.id); }).length;
            if (unread > 0) {
                adminBellBadge.textContent = unread > 9 ? '9+' : unread;
                adminBellBadge.style.display = 'flex';
            }
        });
</script>

{{-- Tabel Aktivitas Terbaru (5 item) --}}
<script>
    fetch('{{ route("log.activities") }}')
        .then(function(r) { return r.json(); })
        .then(function(logs) {
            var el = document.getElementById('adminDashLogList');
            if (!logs.length) {
                el.innerHTML = '<p style="text-align:center; color:var(--gray-400); font-size:13px; padding:24px;">Belum ada aktivitas.</p>';
                return;
            }
            var rows = logs.slice(0, 5).map(function(log) {
                var roleText  = log.role === 'wali_kelas' ? 'Wali Kelas' : log.role === 'kepsek' ? 'Kepsek' : 'Admin';
                var roleColor = log.role === 'wali_kelas'
                    ? 'color:#16a34a; background:#f0fdf4; border:1px solid #bbf7d0;'
                    : log.role === 'kepsek'
                    ? 'color:#b45309; background:#fffbeb; border:1px solid #fde68a;'
                    : 'color:#2563eb; background:#eff6ff; border:1px solid #dbeafe;';
                return '<tr>'
                    + '<td style="font-weight:700; color:var(--gray-900);">' + log.nama_user + '</td>'
                    + '<td><span style="' + roleColor + ' font-size:10px; font-weight:700; padding:3px 9px; border-radius:7px; text-transform:uppercase;">' + roleText + '</span></td>'
                    + '<td style="color:var(--gray-500);">' + log.activity + '</td>'
                    + '<td style="color:var(--gray-400); font-size:11px; white-space:nowrap;">' + new Date(log.created_at).toLocaleString('id-ID') + '</td>'
                    + '</tr>';
            }).join('');
            el.innerHTML = '<table class="act-table">'
                + '<thead><tr>'
                + '<th>User</th><th>Role</th><th>Aktivitas</th><th>Waktu</th>'
                + '</tr></thead>'
                + '<tbody>' + rows + '</tbody>'
                + '</table>';
        })
        .catch(function() {
            document.getElementById('adminDashLogList').innerHTML =
                '<p style="text-align:center; color:var(--gray-400); font-size:13px; padding:24px;">Gagal memuat aktivitas.</p>';
        });
</script>

</x-app-layout>