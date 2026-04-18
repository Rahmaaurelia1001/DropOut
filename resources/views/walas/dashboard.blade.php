<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue:     #2563eb;
        --blue-lt:  #eff6ff;
        --white:    #ffffff;
        --gray-50:  #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-400: #9ca3af;
        --gray-500: #64748b;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --sidebar-w: 240px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    nav[x-data], header { display: none !important; }

    .da-root { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--gray-50); color: var(--gray-800); height: 100vh; overflow: hidden; }
    .da-shell { display: flex; height: 100vh; }

    /* ── SIDEBAR ── */
    .da-sidebar { width: var(--sidebar-w); background: var(--white); border-right: 1px solid var(--gray-200); display: flex; flex-direction: column; flex-shrink: 0; }
    .sb-brand { padding: 24px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--gray-100); }
    .sb-logo { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #1d4ed8, #2563eb); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(37,99,235,.2); flex-shrink: 0; }
    .sb-brand-name { font-size: 14px; font-weight: 800; color: var(--gray-900); line-height: 1.2; letter-spacing: -0.2px; }
    .sb-brand-sub { font-size: 10px; color: var(--gray-400); font-weight: 600; margin-top: 1px; }
    .sb-nav { padding: 16px 12px; flex: 1; overflow-y: auto; }
    .sb-nav-section { font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.1em; padding: 0 10px; margin: 20px 0 8px; }
    .sb-nav-section:first-child { margin-top: 0; }
    .sb-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: 600; color: var(--gray-500); transition: all .2s; margin-bottom: 2px; }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-900); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }
    .sb-item svg { width: 18px; height: 18px; stroke-width: 2.5; flex-shrink: 0; }
    .sb-user { padding: 16px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; background: white; }
    .sb-user-av { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #38bdf8); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
    .sb-user-info { flex: 1; min-width: 0; }
    .sb-user-name { font-size: 13px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { font-size: 11px; color: var(--gray-400); font-weight: 500; }
    .sb-btn { background: transparent; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn:hover { background: var(--gray-100); color: var(--gray-800); }

    /* ── MAIN ── */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }

    /* ── CONTENT ── */
    .da-body { padding: 24px 32px; display: flex; flex-direction: column; gap: 20px; }

    /* ── WELCOME BANNER ── */
    .welcome-banner {
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 60%, #3b82f6 100%);
        border-radius: 20px; padding: 20px 28px; color: white;
        display: flex; align-items: center; justify-content: space-between; gap: 20px;
    }
    .welcome-banner h1 { font-size: 18px; font-weight: 800; margin-bottom: 4px; }
    .welcome-banner p { font-size: 12px; opacity: 0.85; }
    .welcome-kelas { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); border-radius: 14px; padding: 12px 20px; text-align: center; flex-shrink: 0; }
    .welcome-kelas-label { font-size: 10px; font-weight: 700; opacity: 0.75; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 4px; }
    .welcome-kelas-value { font-size: 22px; font-weight: 800; }

    /* ── SHORTCUT MENU ── */
    .grid-menu { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .menu-card { padding: 16px 18px; border-radius: 16px; text-decoration: none; transition: all .2s; border: 1.5px solid var(--gray-200); background: white; display: flex; align-items: center; gap: 14px; }
    .menu-card:hover { transform: translateY(-2px); border-color: var(--blue); box-shadow: 0 8px 20px rgba(37,99,235,0.1); }
    .menu-ico { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .menu-ico svg { width: 20px; height: 20px; }
    .menu-title { font-size: 13px; font-weight: 800; color: var(--gray-900); margin-bottom: 2px; }
    .menu-desc { font-size: 11px; color: var(--gray-500); line-height: 1.4; }

    /* ── ROW: CHARTS + STEPS ── */
    .mid-row { display: grid; grid-template-columns: 1fr 1fr 260px; gap: 20px; }

    /* ── CARD ── */
    .card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
    .card-title { font-size: 13px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
    .card-title::before { content: ''; width: 3px; height: 13px; background: var(--blue); border-radius: 4px; flex-shrink: 0; }
    canvas { max-height: 190px; width: 100% !important; }

    /* ── ALUR PENGGUNAAN ── */
    .step-item { display: flex; gap: 12px; padding: 9px 0; border-bottom: 1px solid var(--gray-100); }
    .step-item:last-child { border-bottom: none; }
    .step-num { width: 22px; height: 22px; border-radius: 50%; background: var(--blue-lt); color: var(--blue); display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800; flex-shrink: 0; margin-top: 1px; }
    .step-text { font-size: 12px; color: var(--gray-500); line-height: 1.5; }

    /* ── TABEL SISWA ── */
    .tbl-wrap { overflow-x: auto; }
    table.da-table { width: 100%; border-collapse: collapse; font-size: 12.5px; }
    table.da-table th { background: var(--gray-50); padding: 11px 14px; text-align: left; font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--gray-200); }
    table.da-table td { padding: 11px 14px; border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
    table.da-table tr:last-child td { border-bottom: none; }

    /* ── AKTIVITAS LOG ── */
    table.log-table { width: 100%; border-collapse: collapse; font-size: 12.5px; }
    table.log-table th { background: var(--gray-50); padding: 10px 14px; font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--gray-200); text-align: left; }
    table.log-table td { padding: 11px 14px; border-bottom: 1px solid var(--gray-100); color: var(--gray-500); }
    table.log-table tr:last-child td { border-bottom: none; }

    /* ── BELL ── */
    .bell-btn { background: var(--gray-50); border: 1.5px solid var(--gray-200); border-radius: 10px; padding: 7px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--gray-500); transition: .2s; position: relative; }
    .bell-btn:hover { background: var(--blue-lt); border-color: #93c5fd; color: var(--blue); }
    .bell-panel { display: none; position: absolute; right: 0; top: calc(100% + 10px); width: 360px; background: white; border: 1px solid var(--gray-200); border-radius: 16px; box-shadow: 0 12px 32px rgba(0,0,0,0.12); z-index: 999; overflow: hidden; }
    .bell-badge { display: none; position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; font-size: 10px; font-weight: 800; border-radius: 999px; min-width: 17px; height: 17px; align-items: center; justify-content: center; padding: 0 3px; border: 2px solid white; }

    /* ── DATE CHIP ── */
    .date-chip { font-size: 11px; font-weight: 700; color: var(--gray-500); background: var(--gray-100); padding: 6px 14px; border-radius: 8px; }

    /* Kosong state */
    .empty-state { text-align: center; padding: 32px 16px; color: var(--gray-400); }
    .empty-state svg { width: 36px; height: 36px; margin: 0 auto 10px; display: block; color: #cbd5e1; }
    .empty-state p { font-size: 13px; font-weight: 600; margin-bottom: 4px; }
    .empty-state small { font-size: 11px; }
</style>

<div class="da-root">
<div class="da-shell">

    {{-- SIDEBAR --}}
    <aside class="da-sidebar">
        <div class="sb-brand">
            <div class="sb-logo"><svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg></div>
            <div>
                <div class="sb-brand-name">SPK Putus Sekolah</div>
                <div class="sb-brand-sub">SDN 11 Kampung Batu</div>
            </div>
        </div>
        <div class="sb-nav">
            <div class="sb-nav-section">Utama</div>
            <a href="{{ route('walas.dashboard') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard</a>
            <div class="sb-nav-section">Proses SPK</div>
            <a href="{{ route('walas.import.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>Import Data</a>
            <a href="{{ route('walas.mfep.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Analisis Risiko</a>
            <a href="{{ route('walas.mfep.hasil') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Analisis</a>
            <div class="sb-nav-section">Riwayat</div>
            <a href="{{ route('walas.riwayat') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Riwayat Analisis</a>
        </div>
        <div class="sb-user">
            <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="sb-user-info">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Wali Kelas</div>
            </div>
            <div style="display:flex; gap:4px;">
                <a href="{{ route('profile.edit') }}" class="sb-btn"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">@csrf<button type="submit" class="sb-btn"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg></button></form>
            </div>
        </div>
    </aside>

    <main class="da-main">

        {{-- PAGE HEADER --}}
        <div class="da-phead">
            <div>
                <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Beranda Wali Kelas</h2>
                <p style="font-size:11px; color:var(--gray-400); margin-top:2px;">Pantau perkembangan dan analisis risiko putus sekolah siswa.</p>
            </div>
            <div style="display:flex; align-items:center; gap:10px;">
                <div class="date-chip" id="date-chip"></div>

                {{-- Bell Notifikasi --}}
                <div style="position:relative;" id="walasBellWrap">
                    <button class="bell-btn" id="walasBellBtn">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="bell-badge" id="walasBellBadge"></span>
                    </button>
                    <div class="bell-panel" id="walasBellPanel">
                        <div style="padding:14px 16px; border-bottom:1px solid var(--gray-100); display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:13px; font-weight:800; color:var(--gray-900);">🔔 Aktivitas Saya</span>
                            <button onclick="walasMarkAllRead()" style="font-size:11px; font-weight:600; color:var(--blue); background:none; border:none; cursor:pointer;">Tandai semua dibaca</button>
                        </div>
                        <div id="walasBellList" style="max-height:320px; overflow-y:auto;">
                            <div style="padding:32px 16px; text-align:center; color:var(--gray-400); font-size:13px;">Memuat aktivitas...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ⚠️ ALERT PERIODE AKTIF --}}
@if(!$periodeAktif)
<div style="margin: 16px 32px 0; display:flex; align-items:flex-start; gap:12px; background:#fffbeb; border:1.5px solid #fde68a; border-left:4px solid #f59e0b; border-radius:12px; padding:16px 20px;">
    <div style="width:36px; height:36px; background:#fef3c7; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
        <svg width="18" height="18" fill="none" stroke="#f59e0b" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
        </svg>
    </div>
    <div>
        <div style="font-size:13px; font-weight:800; color:#92400e; margin-bottom:4px;">Tidak Ada Periode Aktif</div>
        <div style="font-size:12px; color:#b45309; line-height:1.6;">Saat ini belum ada periode penilaian yang aktif. Kamu tidak dapat menjalankan analisis MFEP sampai admin mengaktifkan periode penilaian. Hubungi administrator untuk mengaktifkan periode.</div>
    </div>
</div>
@else
<div style="margin: 16px 32px 0; display:flex; align-items:center; gap:12px; background:#f0fdf4; border:1.5px solid #bbf7d0; border-left:4px solid #10b981; border-radius:12px; padding:14px 20px;">
    <div style="width:36px; height:36px; background:#dcfce7; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
        <svg width="18" height="18" fill="none" stroke="#10b981" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <div>
        <div style="font-size:13px; font-weight:800; color:#065f46; margin-bottom:2px;">Periode Aktif</div>
        <div style="font-size:12px; color:#047857; font-weight:600;">{{ $periodeAktif->tahun_ajaran }} — Semester {{ $periodeAktif->semester }}</div>
    </div>
</div>
@endif


        <div class="da-body">

            {{-- ① WELCOME BANNER --}}
            <div class="welcome-banner">
                <div>
                    <h1>Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                    <p>Pantau dan analisis risiko putus sekolah siswa di kelas Anda dengan mudah.</p>
                </div>
                <div class="welcome-kelas">
                    <div class="welcome-kelas-label">Kelas Diampu</div>
                    <div class="welcome-kelas-value">{{ Auth::user()->kelas->nama_kelas ?? '—' }}</div>
                </div>
            </div>

            {{-- ② SHORTCUT MENU --}}
            <div class="grid-menu">
                <a href="{{ route('walas.import.index') }}" class="menu-card">
                    <div class="menu-ico" style="background:#eff6ff; color:#2563eb;">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    </div>
                    <div>
                        <div class="menu-title">Import Data</div>
                        <div class="menu-desc">Upload data nilai & pendukung siswa.</div>
                    </div>
                </a>
                <a href="{{ route('walas.mfep.index') }}" class="menu-card">
                    <div class="menu-ico" style="background:#f0fdf4; color:#10b981;">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <div class="menu-title">Analisis Risiko</div>
                        <div class="menu-desc">Jalankan perhitungan mesin MFEP.</div>
                    </div>
                </a>
                <a href="{{ route('walas.mfep.hasil') }}" class="menu-card">
                    <div class="menu-ico" style="background:#fffbeb; color:#d97706;">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="menu-title">Hasil Analisis</div>
                        <div class="menu-desc">Lihat ranking dan kategori risiko siswa.</div>
                    </div>
                </a>
            </div>

            {{-- ③ CHART + ALUR --}}
            <div class="mid-row">
                <div class="card" style="margin-bottom:0;">
                    <div class="card-title">Sebaran Kategori Risiko</div>
                    <canvas id="risikoChart"></canvas>
                </div>
                <div class="card" style="margin-bottom:0;">
                    <div class="card-title">Top 5 Faktor Dominan</div>
                    <canvas id="faktorChart"></canvas>
                </div>
                <div class="card" style="margin-bottom:0;">
                    <div class="card-title">Alur Penggunaan</div>
                    <div class="step-item"><div class="step-num">1</div><div class="step-text">Import data nilai & pendukung siswa.</div></div>
                    <div class="step-item"><div class="step-num">2</div><div class="step-text">Buka <b>Analisis Risiko</b> & pilih periode.</div></div>
                    <div class="step-item"><div class="step-num">3</div><div class="step-text">Klik proses untuk menjalankan <b>MFEP</b>.</div></div>
                    <div class="step-item"><div class="step-num">4</div><div class="step-text">Pantau hasil di <b>Hasil Analisis</b>.</div></div>
                </div>
            </div>

            {{-- ④ TABEL DATA SISWA --}}
            <div class="card" style="margin-bottom:0;">
                <div class="card-title">
                    Data Siswa Periode Aktif
                    @if($periodeAktif)
                        <span style="font-size:11px; font-weight:600; color:var(--gray-400); margin-left:2px;">&mdash; {{ $periodeAktif->tahun_ajaran }} Semester {{ $periodeAktif->semester }}</span>
                    @endif
                </div>
                @if($dataSiswa->count() > 0)
                    <div class="tbl-wrap">
                        <table class="da-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>NISN</th>
                                    <th style="text-align:center;">Nilai Rata-rata</th>
                                    <th style="text-align:center;">Ketidakhadiran</th>
                                    <th>Pekerjaan Ortu</th>
                                    <th>Pendidikan Ortu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataSiswa as $i => $s)
                                <tr>
                                    <td style="color:var(--gray-400); font-weight:700;">{{ $i + 1 }}</td>
                                    <td style="font-weight:700; color:var(--gray-900);">{{ $s->nama_siswa }}</td>
                                    <td style="color:var(--gray-500); font-size:11px;">{{ $s->nisn }}</td>
                                    <td style="text-align:center;">
                                        <span style="font-weight:700; color:{{ $s->nilai_rata_rata < 60 ? '#ef4444' : ($s->nilai_rata_rata < 75 ? '#f59e0b' : '#10b981') }};">
                                            {{ number_format($s->nilai_rata_rata, 2) }}
                                        </span>
                                    </td>
                                    <td style="text-align:center;">
                                        <span style="font-weight:700; color:{{ $s->total_ketidakhadiran > 10 ? '#ef4444' : ($s->total_ketidakhadiran > 5 ? '#f59e0b' : '#10b981') }};">
                                            {{ $s->total_ketidakhadiran }} hari
                                        </span>
                                    </td>
                                    <td style="color:var(--gray-500);">{{ $s->pekerjaan_ortu }}</td>
                                    <td style="color:var(--gray-500);">{{ $s->pendidikan_ortu }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p>Belum ada data siswa</p>
                        <small>Data akan muncul setelah admin mengimport evaluasi siswa untuk periode aktif.</small>
                    </div>
                @endif
            </div>

            {{-- ⑤ TABEL AKTIVITAS --}}
            <div class="card" style="margin-bottom:0;">
                <div class="card-title">Aktivitas Saya</div>
                <div id="walasDashLogList">
                    <div class="empty-state"><p style="font-size:13px; color:var(--gray-400);">Memuat aktivitas...</p></div>
                </div>
            </div>

        </div>{{-- /da-body --}}
    </main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Tanggal
    document.getElementById('date-chip').textContent = new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });

    // Chart: Sebaran Risiko
    new Chart(document.getElementById('risikoChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Tinggi', 'Sedang', 'Rendah'],
            datasets: [{
                data: [{{ $dataRisiko['Tinggi'] }}, {{ $dataRisiko['Sedang'] }}, {{ $dataRisiko['Rendah'] }}],
                backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '68%',
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 12, font: { size: 11, weight: '600' } } } }
        }
    });

    // Chart: Faktor Dominan
    new Chart(document.getElementById('faktorChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($faktorDominan->pluck('faktor_dominan')) !!},
            datasets: [{
                label: 'Jumlah Siswa',
                data: {!! json_encode($faktorDominan->pluck('total')) !!},
                backgroundColor: '#2563eb',
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 10 } } },
                y: { ticks: { font: { size: 10 } } }
            }
        }
    });

    // ── BELL NOTIFIKASI ──
    var bellBtn   = document.getElementById('walasBellBtn');
    var bellPanel = document.getElementById('walasBellPanel');
    var bellBadge = document.getElementById('walasBellBadge');
    var bellList  = document.getElementById('walasBellList');

    function getReadIds() { return JSON.parse(localStorage.getItem('spk_read_logs') || '[]'); }
    function saveReadIds(ids) { localStorage.setItem('spk_read_logs', JSON.stringify(ids)); }

    function walasTimeAgo(dateStr) {
        var diff = Math.floor((new Date() - new Date(dateStr)) / 1000);
        if (diff < 60) return diff + ' detik lalu';
        if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
        return Math.floor(diff / 86400) + ' hari lalu';
    }

    bellBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        var isOpen = bellPanel.style.display === 'block';
        bellPanel.style.display = isOpen ? 'none' : 'block';
        if (!isOpen) walasLoadBellLogs();
    });
    document.addEventListener('click', function(e) {
        if (!document.getElementById('walasBellWrap').contains(e.target)) bellPanel.style.display = 'none';
    });

    function walasLoadBellLogs() {
        fetch('{{ route("log.activities") }}')
            .then(r => r.json())
            .then(logs => {
                var readIds = getReadIds();
                if (!logs.length) {
                    bellList.innerHTML = '<div style="padding:32px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada aktivitas.</div>';
                    bellBadge.style.display = 'none'; return;
                }
                var unread = logs.filter(l => !readIds.includes(l.id)).length;
                bellBadge.textContent = unread > 9 ? '9+' : unread;
                bellBadge.style.display = unread > 0 ? 'flex' : 'none';
                bellList.innerHTML = logs.map(log => {
                    var isRead = readIds.includes(log.id);
                    return `<div onclick="walasMarkRead(${log.id})" style="padding:12px 16px; border-bottom:1px solid #f8fafc; display:flex; gap:10px; cursor:pointer; background:${isRead ? '#fff' : '#eff6ff'};">
                        <div style="width:7px; height:7px; border-radius:50%; background:${isRead ? 'transparent' : '#2563eb'}; flex-shrink:0; margin-top:5px;"></div>
                        <div style="flex:1;">
                            <div style="font-size:12px; font-weight:600; color:#334155; line-height:1.4;">${log.activity}</div>
                            <div style="font-size:10px; color:#cbd5e1; margin-top:2px;">${walasTimeAgo(log.created_at)}</div>
                        </div></div>`;
                }).join('');
            })
            .catch(() => { bellList.innerHTML = '<div style="padding:32px; text-align:center; color:#94a3b8;">Gagal memuat.</div>'; });
    }

    function walasMarkRead(id) {
        var ids = getReadIds(); if (!ids.includes(id)) { ids.push(id); saveReadIds(ids); walasLoadBellLogs(); }
    }
    function walasMarkAllRead() {
        fetch('{{ route("log.activities") }}').then(r => r.json()).then(logs => { saveReadIds(logs.map(l => l.id)); walasLoadBellLogs(); });
    }

    // Auto badge on load
    window.addEventListener('DOMContentLoaded', () => {
        fetch('{{ route("log.activities") }}').then(r => r.json()).then(logs => {
            var unread = logs.filter(l => !getReadIds().includes(l.id)).length;
            if (unread > 0) { bellBadge.textContent = unread > 9 ? '9+' : unread; bellBadge.style.display = 'flex'; }
        });
    });

    // Tabel aktivitas
    fetch('{{ route("log.activities") }}')
        .then(r => r.json())
        .then(logs => {
            var el = document.getElementById('walasDashLogList');
            if (!logs.length) {
                el.innerHTML = '<p style="text-align:center; color:#94a3b8; font-size:13px; padding:20px 0;">Belum ada aktivitas.</p>';
                return;
            }
            var rows = logs.slice(0, 5).map(log =>
    `<tr><td style="color:#475569;">${log.activity}</td><td style="color:#94a3b8; font-size:11px; white-space:nowrap;">${new Date(log.created_at).toLocaleString('id-ID')}</td></tr>`
).join('');

            el.innerHTML = `<div style="overflow-x:auto;">
                <table class="log-table">
                    <thead><tr><th>Aktivitas</th><th>Waktu</th></tr></thead>
                    <tbody>${rows}</tbody>
                </table></div>`;
        });
</script>
</x-app-layout>