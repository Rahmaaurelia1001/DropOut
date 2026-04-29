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
    .sb-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: 600; color: var(--gray-500); transition: all .2s; margin-bottom: 2px; }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-900); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }
    .sb-item svg { width: 18px; height: 18px; stroke-width: 2.5; flex-shrink: 0; }
    .sb-user { padding: 16px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; background: white; }
    .sb-user-av { width: 36px; height: 36px; border-radius: 50%; background: var(--blue); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
    .sb-user-info { flex: 1; min-width: 0; }
    .sb-user-name { font-size: 13px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { font-size: 11px; color: var(--gray-400); font-weight: 500; }
    .sb-btn-icon { background: none; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn-icon:hover { background: var(--gray-100); color: var(--gray-800); }

    /* ── MAIN ── */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }
    .da-body { padding: 24px 32px; display: flex; flex-direction: column; gap: 20px; }

    /* ── CARD ── */
    .card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
    .card-title { font-size: 13px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
    .card-title::before { content: ''; width: 3px; height: 13px; background: var(--blue); border-radius: 4px; flex-shrink: 0; }

    /* ── FILTER ── */
    .filter-box { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 14px 24px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .f-label { font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; }
    .f-select { border-radius: 10px; border: 1.5px solid var(--gray-200); padding: 8px 14px; font-size: 13px; font-weight: 600; min-width: 240px; outline: none; }
    .btn-primary { background: var(--blue); color: white; padding: 9px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; border: none; cursor: pointer; transition: .2s; }
    .btn-primary:hover { background: #1d4ed8; }

    /* ── STAT CARDS ── */
    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .stat-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 18px; padding: 18px 20px; }
    .stat-lbl { font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; }
    .stat-val { font-size: 28px; font-weight: 800; color: var(--gray-900); margin-top: 6px; line-height: 1; }

    /* ── MID ROW ── */
    .mid-row { display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px; }
    canvas { max-height: 220px; width: 100% !important; }

    /* ── INFO BOXES ── */
    .info-box { background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 14px; padding: 14px 16px; }
    .info-box-label { font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; }
    .info-box-value { font-size: 15px; font-weight: 800; }

    /* ── TABLE ── */
    .da-table { width: 100%; border-collapse: collapse; font-size: 12.5px; }
    .da-table th { background: var(--gray-50); padding: 11px 14px; text-align: left; font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--gray-200); }
    .da-table td { padding: 11px 14px; border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
    .da-table tr:last-child td { border-bottom: none; }

    /* ── BOTTOM ROW ── */
    .bottom-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

    /* ── KELAS STATUS GRID ── */
    .kelas-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
    .kelas-card { border: 1.5px solid var(--gray-100); border-radius: 16px; padding: 14px 16px; background: white; }
    .prog-item { text-align: center; padding: 8px 6px; border-radius: 10px; }

    /* ── LEVEL KELAS GRID ── */
    .level-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .level-card { border: 1.5px solid var(--gray-100); border-radius: 16px; padding: 16px; background: white; overflow: hidden; position: relative; }
    .level-badge { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; font-size: 16px; font-weight: 800; margin-bottom: 10px; }
    .level-kelas-name { font-size: 11px; color: var(--gray-400); font-weight: 600; margin-bottom: 12px; }
    .level-bars { display: flex; flex-direction: column; gap: 6px; }
    .level-bar-row { display: flex; align-items: center; gap: 8px; }
    .level-bar-label { font-size: 10px; font-weight: 700; width: 42px; flex-shrink: 0; }
    .level-bar-track { flex: 1; height: 8px; background: var(--gray-100); border-radius: 99px; overflow: hidden; }
    .level-bar-fill { height: 100%; border-radius: 99px; transition: width .4s ease; }
    .level-bar-count { font-size: 11px; font-weight: 800; width: 20px; text-align: right; flex-shrink: 0; }
    .level-total { font-size: 10px; color: var(--gray-400); font-weight: 600; margin-top: 10px; padding-top: 8px; border-top: 1px solid var(--gray-100); }

    /* ── BADGE ROLE ── */
    .role-badge { background: var(--blue-lt); color: var(--blue); font-size: 10px; font-weight: 800; padding: 3px 8px; border-radius: 6px; text-transform: uppercase; }

    /* ── BELL ── */
    .bell-btn { background: var(--gray-50); border: 1.5px solid var(--gray-200); border-radius: 10px; padding: 7px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--gray-500); transition: .2s; position: relative; }
    .bell-btn:hover { background: var(--blue-lt); border-color: #93c5fd; color: var(--blue); }
    .bell-badge { display: none; position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; font-size: 10px; font-weight: 800; border-radius: 999px; min-width: 17px; height: 17px; align-items: center; justify-content: center; padding: 0 3px; border: 2px solid white; }
    .bell-panel { display: none; position: absolute; right: 0; top: calc(100% + 10px); width: 360px; background: white; border: 1px solid var(--gray-200); border-radius: 16px; box-shadow: 0 12px 32px rgba(0,0,0,0.12); z-index: 999; overflow: hidden; }

    .date-chip { font-size: 11px; font-weight: 700; color: var(--gray-500); background: var(--gray-100); padding: 6px 14px; border-radius: 8px; }
    .empty-state { text-align: center; padding: 28px; color: var(--gray-400); font-size: 13px; }
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
            <div class="sb-nav-section">Monitoring</div>
            <a href="{{ route('kepsek.dashboard') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard</a>
            <a href="{{ route('kepsek.kriteria.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Bobot Kriteria</a>
            <a href="{{ route('kepsek.mfep.hasil') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Perhitungan</a>
            <a href="{{ route('kepsek.ranking') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>Ranking Risiko</a>
            <div class="sb-nav-section">Laporan</div>
            <a href="{{ route('kepsek.laporan') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Laporan Akhir</a>
        </div>
        <div class="sb-user">
            <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="sb-user-info">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Kepala Sekolah</div>
            </div>
            <div class="sb-actions">
                <a href="{{ route('profile.edit') }}" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">@csrf
                    <button type="submit" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg></button>
                </form>
            </div>
        </div>
    </aside>

    <main class="da-main">

        {{-- PAGE HEADER --}}
        <div class="da-phead">
            <div>
                <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Dashboard Monitoring Sekolah</h2>
                <p style="font-size:11px; color:var(--gray-400); margin-top:2px;">Ringkasan analisis risiko putus sekolah seluruh kelas.</p>
            </div>
            <div style="display:flex; align-items:center; gap:10px;">
                <div class="date-chip" id="date-indo"></div>
                <div style="position:relative;" id="kepsekBellWrap">
                    <button class="bell-btn" id="kepsekBellBtn">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="bell-badge" id="kepsekBellBadge"></span>
                    </button>
                    <div class="bell-panel" id="kepsekBellPanel">
                        <div style="padding:14px 16px; border-bottom:1px solid var(--gray-100); display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:13px; font-weight:800; color:var(--gray-900);">🔔 Aktivitas Terbaru</span>
                            <button onclick="kepsekMarkAllRead()" style="font-size:11px; font-weight:600; color:var(--blue); background:none; border:none; cursor:pointer;">Tandai semua dibaca</button>
                        </div>
                        <div id="kepsekBellList" style="max-height:320px; overflow-y:auto;">
                            <div style="padding:32px; text-align:center; color:var(--gray-400); font-size:13px;">Memuat aktivitas...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="da-body">

            {{-- ① FILTER --}}
            <form method="GET" action="{{ route('kepsek.dashboard') }}" class="filter-box">
                <div style="display:flex; align-items:center; gap:12px;">
                    <span class="f-label">Periode:</span>
                    <select name="id_periode" class="f-select">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periodes as $p)
                            <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-primary">Tampilkan Data</button>
            </form>

            {{-- ② STAT CARDS --}}
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-lbl">Siswa Dianalisis</div>
                    <div class="stat-val">{{ $totalSiswa }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-lbl" style="color:#ef4444;">Risiko Tinggi</div>
                    <div class="stat-val" style="color:#ef4444;">{{ $jumlahTinggi }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-lbl" style="color:#f59e0b;">Risiko Sedang</div>
                    <div class="stat-val" style="color:#f59e0b;">{{ $jumlahSedang }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-lbl" style="color:#10b981;">Risiko Rendah</div>
                    <div class="stat-val" style="color:#10b981;">{{ $jumlahRendah }}</div>
                </div>
            </div>

            {{-- ③ CHART DISTRIBUSI + INFO --}}
            <div class="mid-row">
                <div class="card">
                    <div class="card-title">Distribusi Risiko Sekolah</div>
                    <div style="display:flex; justify-content:center;">
                        <canvas id="chartRisiko"></canvas>
                    </div>
                </div>
                <div class="card" style="display:flex; flex-direction:column; gap:12px;">
                    <div class="card-title">Info Periode</div>
                    <div class="info-box">
                        <div class="info-box-label">Faktor Dominan</div>
                        <div class="info-box-value" style="color:var(--blue);">{{ $faktorDominanTerbanyak ?? '-' }}</div>
                    </div>
                    <div class="info-box">
                        <div class="info-box-label">Periode Aktif</div>
                        <div class="info-box-value" style="color:var(--gray-800);">
                            @if($periode) {{ $periode->tahun_ajaran }} &mdash; Smstr {{ $periode->semester }} @else — @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ④ RISIKO PER LEVEL KELAS --}}
            <div class="card">
                <div class="card-title">Persentase Risiko per Tingkatan Kelas</div>
                @if($risikoPerLevel->count() > 0)
                    <div class="level-grid">
                        @foreach($risikoPerLevel as $level)
                        @php
                            $total      = max(1, $level->total_siswa);
                            $pctTinggi  = round(($level->jumlah_tinggi  / $total) * 100);
                            $pctSedang  = round(($level->jumlah_sedang  / $total) * 100);
                            $pctRendah  = round(($level->jumlah_rendah  / $total) * 100);

                            // warna badge level
                            $badgeColors = [
                                1 => ['bg'=>'#fee2e2','color'=>'#b91c1c'],
                                2 => ['bg'=>'#ffedd5','color'=>'#c2410c'],
                                3 => ['bg'=>'#fef9c3','color'=>'#854d0e'],
                                4 => ['bg'=>'#d1fae5','color'=>'#065f46'],
                                5 => ['bg'=>'#dbeafe','color'=>'#1e40af'],
                                6 => ['bg'=>'#ede9fe','color'=>'#4c1d95'],
                            ];
                            $bc = $badgeColors[$level->level_kelas] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];
                        @endphp
                        <div class="level-card">
                            <div class="level-badge" style="background:{{ $bc['bg'] }}; color:{{ $bc['color'] }};">
                                {{ $level->level_kelas }}
                            </div>
                            <div class="level-kelas-name">{{ $level->nama_kelas_list }}</div>
                            <div class="level-bars">
                                {{-- Tinggi --}}
                                <div class="level-bar-row">
                                    <span class="level-bar-label" style="color:#ef4444;">Tinggi</span>
                                    <div class="level-bar-track">
                                        <div class="level-bar-fill" style="width:{{ $pctTinggi }}%; background:#ef4444;"></div>
                                    </div>
                                    <span class="level-bar-count" style="color:#ef4444;">{{ $level->jumlah_tinggi }}</span>
                                </div>
                                {{-- Sedang --}}
                                <div class="level-bar-row">
                                    <span class="level-bar-label" style="color:#f59e0b;">Sedang</span>
                                    <div class="level-bar-track">
                                        <div class="level-bar-fill" style="width:{{ $pctSedang }}%; background:#f59e0b;"></div>
                                    </div>
                                    <span class="level-bar-count" style="color:#f59e0b;">{{ $level->jumlah_sedang }}</span>
                                </div>
                                {{-- Rendah --}}
                                <div class="level-bar-row">
                                    <span class="level-bar-label" style="color:#10b981;">Rendah</span>
                                    <div class="level-bar-track">
                                        <div class="level-bar-fill" style="width:{{ $pctRendah }}%; background:#10b981;"></div>
                                    </div>
                                    <span class="level-bar-count" style="color:#10b981;">{{ $level->jumlah_rendah }}</span>
                                </div>
                            </div>
                            <div class="level-total">Total siswa: <strong>{{ $level->total_siswa }}</strong> &nbsp;|&nbsp; Risiko tinggi: <strong style="color:#ef4444;">{{ $pctTinggi }}%</strong></div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="empty-state">Belum ada data risiko per tingkatan kelas.</p>
                @endif
            </div>

            {{-- ⑤ TOP 5 SISWA + CHART KELAS --}}
            <div class="bottom-row">
                <div class="card">
                    <div class="card-title">Top 5 Siswa Risiko Tinggi</div>
                    @if($topSiswaTinggi->count() > 0)
                        <div style="overflow-x:auto;">
                            <table class="da-table">
                                <thead>
                                    <tr>
                                        <th>No</th><th>Nama Siswa</th><th>Kelas</th><th>Preferensi</th><th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topSiswaTinggi as $index => $item)
                                    <tr>
                                        <td style="color:var(--gray-400); font-weight:700;">{{ $index + 1 }}</td>
                                        <td style="font-weight:700; color:var(--gray-900);">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                        <td style="color:var(--gray-500);">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                        <td style="color:#ef4444; font-weight:700; font-family:monospace;">{{ number_format($item->total_nilai_preferensi, 4) }}</td>
                                        <td><span style="background:#fee2e2; color:#b91c1c; padding:3px 10px; border-radius:8px; font-size:11px; font-weight:700;">{{ $item->kategori_risiko }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="empty-state">Tidak ada siswa dengan risiko tinggi.</p>
                    @endif
                </div>
                <div class="card">
                    <div class="card-title">Kelas dengan Risiko Tertinggi</div>
                    <canvas id="chartKelas"></canvas>
                </div>
            </div>

            {{-- ⑥ STATUS REKOMENDASI PER KELAS --}}
            <div class="card">
                <div class="card-title">Status Rekomendasi per Kelas</div>
                @if($statusPerKelas->count() > 0)
                    <div class="kelas-grid">
                        @foreach($statusPerKelas as $item)
                        <div class="kelas-card">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                                <span style="font-weight:800; color:var(--gray-900); font-size:13px;">{{ $item->nama_kelas }}</span>
                                <span style="font-size:11px; font-weight:700; color:var(--gray-400);">Total: {{ $item->total }}</span>
                            </div>
                            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:8px;">
                                <div class="prog-item" style="background:var(--gray-50); color:var(--gray-600);">
                                    <div style="font-size:18px; font-weight:800;">{{ $item->belum }}</div>
                                    <div style="font-size:9px; font-weight:700; text-transform:uppercase; margin-top:2px;">Belum</div>
                                </div>
                                <div class="prog-item" style="background:#fffbeb; color:#d97706;">
                                    <div style="font-size:18px; font-weight:800;">{{ $item->proses }}</div>
                                    <div style="font-size:9px; font-weight:700; text-transform:uppercase; margin-top:2px;">Proses</div>
                                </div>
                                <div class="prog-item" style="background:#ecfdf5; color:#10b981;">
                                    <div style="font-size:18px; font-weight:800;">{{ $item->selesai }}</div>
                                    <div style="font-size:9px; font-weight:700; text-transform:uppercase; margin-top:2px;">Selesai</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="empty-state">Belum ada data progres kelas.</p>
                @endif
            </div>

            {{-- ⑦ AKTIVITAS TERBARU --}}
            <div class="card">
                <div class="card-title">Aktivitas Terbaru</div>
                <div id="dashLogList">
                    <p class="empty-state">Memuat aktivitas...</p>
                </div>
            </div>

        </div>
    </main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('date-indo').textContent = new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });

    new Chart(document.getElementById('chartRisiko').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Tinggi', 'Sedang', 'Rendah'],
            datasets: [{
                data: [{{ $jumlahTinggi }}, {{ $jumlahSedang }}, {{ $jumlahRendah }}],
                backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                borderWidth: 0, hoverOffset: 4
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 16, font: { size: 11, weight: '600' } } } }
        }
    });

    const dataKelas = @json($risikoPerKelas);
    new Chart(document.getElementById('chartKelas').getContext('2d'), {
        type: 'bar',
        data: {
            labels: dataKelas.map(d => d.nama_kelas),
            datasets: [{ label: 'Risiko Tinggi', data: dataKelas.map(d => d.total_risiko_tinggi), backgroundColor: '#ef4444', borderRadius: 5 }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 10 } } }, x: { ticks: { font: { size: 10 } } } }
        }
    });

    // ── BELL ──
    var bellBtn   = document.getElementById('kepsekBellBtn');
    var bellPanel = document.getElementById('kepsekBellPanel');
    var bellBadge = document.getElementById('kepsekBellBadge');
    var bellList  = document.getElementById('kepsekBellList');

    function getReadIds() { return JSON.parse(localStorage.getItem('spk_read_logs') || '[]'); }
    function saveReadIds(ids) { localStorage.setItem('spk_read_logs', JSON.stringify(ids)); }
    function timeAgo(d) {
        var s = Math.floor((new Date() - new Date(d)) / 1000);
        if (s < 60) return s + ' detik lalu';
        if (s < 3600) return Math.floor(s/60) + ' menit lalu';
        if (s < 86400) return Math.floor(s/3600) + ' jam lalu';
        return Math.floor(s/86400) + ' hari lalu';
    }
    function roleLabel(r) { return r === 'wali_kelas' ? 'Wali Kelas' : r === 'kepsek' ? 'Kepsek' : 'Admin'; }

    bellBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        var open = bellPanel.style.display === 'block';
        bellPanel.style.display = open ? 'none' : 'block';
        if (!open) kepsekLoadBellLogs();
    });
    document.addEventListener('click', function(e) {
        if (!document.getElementById('kepsekBellWrap').contains(e.target)) bellPanel.style.display = 'none';
    });

    function kepsekLoadBellLogs() {
        fetch('{{ route("log.activities") }}')
            .then(r => r.json())
            .then(logs => {
                var readIds = getReadIds();
                if (!logs.length) { bellList.innerHTML = '<div style="padding:32px; text-align:center; color:#94a3b8;">Belum ada aktivitas.</div>'; bellBadge.style.display='none'; return; }
                var unread = logs.filter(l => !readIds.includes(l.id)).length;
                bellBadge.textContent = unread > 9 ? '9+' : unread;
                bellBadge.style.display = unread > 0 ? 'flex' : 'none';
                bellList.innerHTML = logs.map(log => {
                    var isRead = readIds.includes(log.id);
                    return `<div onclick="kepsekMarkRead(${log.id})" style="padding:12px 16px; border-bottom:1px solid #f8fafc; display:flex; gap:10px; cursor:pointer; background:${isRead ? '#fff' : '#eff6ff'};">
                        <div style="width:7px; height:7px; border-radius:50%; background:${isRead ? 'transparent' : '#2563eb'}; flex-shrink:0; margin-top:5px;"></div>
                        <div style="flex:1;">
                            <span style="background:#eff6ff; color:#2563eb; font-size:10px; font-weight:800; padding:2px 7px; border-radius:6px; text-transform:uppercase;">${roleLabel(log.role)}</span>
                            <div style="font-size:12px; font-weight:600; color:#334155; margin-top:3px; line-height:1.4;">${log.activity}</div>
                            <div style="font-size:11px; color:#94a3b8; margin-top:1px;">oleh ${log.nama_user}</div>
                            <div style="font-size:10px; color:#cbd5e1; margin-top:1px;">${timeAgo(log.created_at)}</div>
                        </div></div>`;
                }).join('');
            })
            .catch(() => { bellList.innerHTML = '<div style="padding:32px; text-align:center; color:#94a3b8;">Gagal memuat.</div>'; });
    }
    function kepsekMarkRead(id) { var ids = getReadIds(); if (!ids.includes(id)) { ids.push(id); saveReadIds(ids); kepsekLoadBellLogs(); } }
    function kepsekMarkAllRead() { fetch('{{ route("log.activities") }}').then(r => r.json()).then(logs => { saveReadIds(logs.map(l => l.id)); kepsekLoadBellLogs(); }); }

    window.addEventListener('DOMContentLoaded', () => {
        fetch('{{ route("log.activities") }}').then(r => r.json()).then(logs => {
            var unread = logs.filter(l => !getReadIds().includes(l.id)).length;
            if (unread > 0) { bellBadge.textContent = unread > 9 ? '9+' : unread; bellBadge.style.display = 'flex'; }
        });
    });

    fetch('{{ route("log.activities") }}')
        .then(r => r.json())
        .then(logs => {
            var el = document.getElementById('dashLogList');
            if (!logs.length) { el.innerHTML = '<p class="empty-state">Belum ada aktivitas.</p>'; return; }
            var top5 = logs.slice(0, 5);
            el.innerHTML = `<div style="overflow-x:auto;">
                <table class="da-table">
                    <thead><tr><th>User</th><th>Role</th><th>Aktivitas</th><th>Waktu</th></tr></thead>
                    <tbody>
                        ${top5.map(log => `<tr>
                            <td style="font-weight:700; color:var(--gray-900);">${log.nama_user}</td>
                            <td><span class="role-badge">${roleLabel(log.role)}</span></td>
                            <td style="color:var(--gray-500);">${log.activity}</td>
                            <td style="color:var(--gray-400); font-size:11px; white-space:nowrap;">${new Date(log.created_at).toLocaleString('id-ID')}</td>
                        </tr>`).join('')}
                    </tbody>
                </table></div>`;
        });
</script>
</x-app-layout>