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

    .da-root {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--gray-50); color: var(--gray-800);
        height: 100vh; overflow: hidden;
    }

    .da-shell { display: flex; height: 100vh; }

    /* ── SIDEBAR WALAS (KONSISTEN 5 MENU) ── */
    .da-sidebar {
        width: var(--sidebar-w); background: var(--white); border-right: 1px solid var(--gray-200);
        display: flex; flex-direction: column; flex-shrink: 0;
    }
    .sb-brand { padding: 24px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--gray-100); }
    .sb-logo { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #1d4ed8, #2563eb); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(37,99,235,.2); flex-shrink: 0; }
    .sb-brand-name { font-size: 14px; font-weight: 800; color: var(--gray-900); line-height: 1.2; letter-spacing: -0.2px; }
    .sb-brand-sub { font-size: 10px; color: var(--gray-400); font-weight: 600; margin-top: 1px; }

    .sb-nav { padding: 16px 12px; flex: 1; overflow-y: auto; }
    .sb-nav-section { font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.1em; padding: 0 10px; margin: 20px 0 8px; }
    
    .sb-item { 
        display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; 
        text-decoration: none; font-size: 13px; font-weight: 600; color: var(--gray-500); transition: all .2s; margin-bottom: 2px; 
    }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-900); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }
    .sb-item svg { width: 18px; height: 18px; stroke-width: 2.5; flex-shrink: 0; }

    .sb-user { padding: 16px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; background: white; }
    .sb-user-av { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #38bdf8); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
    .sb-user-info { flex: 1; min-width: 0; }
    .sb-user-name { font-size: 13px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { font-size: 11px; color: var(--gray-400); font-weight: 500; }
    .sb-actions { display: flex; gap: 4px; }
    .sb-btn-icon { background: none; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn-icon:hover { background: var(--gray-100); color: var(--gray-800); }

    /* ── MAIN AREA ── */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; flex-shrink: 0; }
    
    .da-body { padding: 24px 32px; }

    /* ── SEARCH CARD ── */
    .search-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; margin-bottom: 24px; }
    .f-input { border-radius: 12px; border: 1.5px solid var(--gray-200); padding: 10px 16px; font-size: 14px; width: 100%; transition: .2s; }
    .f-input:focus { outline: none; border-color: var(--blue); box-shadow: 0 0 0 4px var(--blue-lt); }
    .btn-search { background: var(--blue); color: white; padding: 10px 24px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; transition: .2s; }

    /* ── PROFILE MINI STATS ── */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
    .stat-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; }
    .stat-lbl { font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; margin-bottom: 4px; }
    .stat-val { font-size: 18px; font-weight: 800; color: var(--gray-900); }

    /* ── TIMELINE ── */
    .timeline-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 24px; padding: 32px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .timeline-container { position: relative; padding-left: 32px; }
    .timeline-line { position: absolute; left: 11px; top: 8px; bottom: 8px; width: 2px; background: var(--gray-100); }
    
    .tm-item { position: relative; margin-bottom: 32px; }
    .tm-dot { position: absolute; left: -32px; top: 4px; width: 24px; height: 24px; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800; color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 2; }
    
    .tm-box { background: var(--gray-50); border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; transition: .2s; }
    .tm-box:hover { border-color: var(--blue); transform: translateX(8px); background: white; }

    .badge-risiko { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; }
    .bg-red { background: #fef2f2; color: #ef4444; }
    .bg-yellow { background: #fffbeb; color: #d97706; }
    .bg-green { background: #ecfdf5; color: #10b981; }

    .detail-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 16px; }
    .detail-item { background: white; border: 1px solid var(--gray-200); padding: 12px; border-radius: 12px; }
    .detail-lbl { font-size: 10px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; margin-bottom: 2px; }
    .detail-val { font-size: 13px; font-weight: 700; color: var(--gray-800); }
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
            <a href="{{ route('dashboard') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard</a>
            <div class="sb-nav-section">Proses SPK</div>
            <a href="{{ route('walas.import.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>Import Data</a>
            <a href="{{ route('walas.mfep.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Analisis Risiko</a>
            <a href="{{ route('walas.mfep.hasil') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Analisis</a>
            <div class="sb-nav-section">Riwayat</div>
            <a href="{{ route('walas.riwayat') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Riwayat Analisis</a>
        </div>

        <div class="sb-user">
            <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="sb-user-info">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Wali Kelas</div>
            </div>
            <div class="sb-actions">
                <a href="{{ route('profile.edit') }}" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">@csrf<button type="submit" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg></button></form>
            </div>
        </div>
    </aside>

    <main class="da-main">
        <div class="da-phead">
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Riwayat Analisis Siswa</h2>
            <p style="font-size:12px; color:var(--gray-400); margin-top:2px;">Pantau tren risiko putus sekolah siswa secara berkelanjutan.</p>
        </div>

        <div class="da-body">
            {{-- Search --}}
            <div class="search-card">
                <form action="{{ route('walas.riwayat') }}" method="GET" style="display:flex; gap:12px;">
                    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Ketik NISN atau Nama Siswa..." class="f-input">
                    <button type="submit" class="btn-search">Cari Siswa</button>
                </form>
            </div>

            @if($keyword && !$siswa)
                <div style="background:#fef2f2; color:#ef4444; padding:16px; border-radius:14px; font-size:14px; font-weight:600; border:1px solid #fee2e2;">Siswa dengan identitas tersebut tidak ditemukan dalam database kelas Anda.</div>
            @endif

            @if($siswa)
                <div class="stats-grid">
                    <div class="stat-card"><p class="stat-lbl">NISN Siswa</p><h3 class="stat-val">{{ $siswa->nisn }}</h3></div>
                    <div class="stat-card"><p class="stat-lbl">Nama Lengkap</p><h3 class="stat-val">{{ $siswa->nama_siswa }}</h3></div>
                    <div class="stat-card"><p class="stat-lbl">Total Record</p><h3 class="stat-val" style="color:var(--blue)">{{ $riwayat->count() }} Analisis</h3></div>
                </div>

                <div class="timeline-card">
                    <h3 style="font-size:16px; font-weight:800; color:var(--gray-900); margin-bottom:24px;">Timeline Perkembangan</h3>
                    
                    @if($riwayat->count() > 0)
                        <div class="timeline-container">
                            <div class="timeline-line"></div>
                            @foreach($riwayat as $index => $item)
                                <div class="tm-item">
                                    <div class="tm-dot 
                                        @if($item->kategori_risiko === 'Tinggi') bg-red 
                                        @elseif($item->kategori_risiko === 'Sedang') bg-yellow 
                                        @else bg-green @endif" 
                                        style="background-color: currentColor;">
                                        {{ $riwayat->count() - $index }}
                                    </div>

                                    <div class="tm-box">
                                        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                                            <div>
                                                <h4 style="font-size:15px; font-weight:800; color:var(--gray-900);">
                                                    {{ $item->periode->tahun_ajaran ?? 'Periode' }} - Semester {{ $item->periode->semester ?? '?' }}
                                                </h4>
                                                <p style="font-size:11px; color:var(--gray-400); margin-top:4px;">Diproses pada: {{ $item->tanggal_proses ? \Carbon\Carbon::parse($item->tanggal_proses)->format('d M Y, H:i') : '-' }}</p>
                                            </div>
                                            <span class="badge-risiko 
                                                @if($item->kategori_risiko === 'Tinggi') bg-red 
                                                @elseif($item->kategori_risiko === 'Sedang') bg-yellow 
                                                @else bg-green @endif">
                                                Risiko {{ $item->kategori_risiko }}
                                            </span>
                                        </div>

                                        <div class="detail-grid">
                                            <div class="detail-item">
                                                <p class="detail-lbl">Nilai Preferensi</p>
                                                <p class="detail-val">{{ number_format((float) $item->total_nilai_preferensi, 4) }}</p>
                                            </div>
                                            <div class="detail-item">
                                                <p class="detail-lbl">Faktor Dominan</p>
                                                <p class="detail-val" style="font-size:11px;">{{ $item->faktor_dominan ?? '-' }}</p>
                                            </div>
                                            <div class="detail-item" style="grid-column: span 2;">
                                                <p class="detail-lbl">Keputusan Final</p>
                                                <p class="detail-val" style="font-size:11px; line-height:1.3;">{{ $item->tindak_lanjut_final ?? 'Menunggu Keputusan' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align:center; padding:40px; color:var(--gray-400); font-size:14px;">Belum ada riwayat analisis terekam.</div>
                    @endif
                </div>
            @endif
        </div>
    </main>
</div>
</div>
</x-app-layout>