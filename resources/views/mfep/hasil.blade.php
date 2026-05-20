<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap');

    :root {
        --blue:     #2563eb; 
        --blue-dark:#1d4ed8;
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

    /* SIDEBAR: UTUH SESUAI KODE ASLI */
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
    .sb-btn-icon { background: none; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn-icon:hover { background: var(--gray-100); color: var(--gray-800); }

    /* AREA KONTEN UTAMA */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 24px; flex-shrink: 0; border-top: 3px solid var(--blue); }
    .da-body { padding: 20px 24px; }

    /* Filter Bar */
    .filter-card { background: white; border: 1px solid var(--gray-200); border-radius: 12px; padding: 14px 16px; margin-bottom: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.01); }
    .filter-container { display: flex; flex-wrap: wrap; align-items: flex-end; gap: 14px; }
    .filter-wrapper { display: flex; flex: 1; flex-wrap: wrap; gap: 14px; }
    .filter-field { display: flex; flex-direction: column; gap: 4px; flex: 1; min-width: 140px; }
    .f-label { font-size: 11px; font-weight: 700; color: var(--gray-500); text-transform: capitalize; }
    .f-select { border-radius: 8px; border: 1px solid var(--gray-200); padding: 6px 12px; font-size: 12.5px; font-weight: 600; color: var(--gray-800); background-color: var(--white); outline: none; width: 100%; height: 36px; transition: all 0.2s; }
    .f-select:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.15); }
    .btn-show { background: linear-gradient(135deg, var(--blue), var(--blue-dark)); color: white; padding: 0 20px; border-radius: 8px; font-weight: 700; font-size: 12.5px; border: none; cursor: pointer; transition: .2s; height: 36px; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(37,99,235,0.15); margin-left: auto; }
    .btn-show:hover { transform: translateY(-1px); box-shadow: 0 6px 12px rgba(37,99,235,0.2); }

    /* Tabel dengan Fixed Layout & Presisi Kolom */
    .table-card { background: var(--white); border: 1px solid var(--gray-200); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
    .t-header { padding: 16px 20px; border-bottom: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: center; background: linear-gradient(to right, #ffffff, var(--gray-50)); }
    
    .table-responsive { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; table-layout: fixed; min-width: 950px; }
    
    /* Ukuran Lebar Kolom Diatur Rapi */
    th:nth-child(1), td:nth-child(1) { width: 55px; text-align: center; } /* Kolom No */
    th:nth-child(2), td:nth-child(2) { width: 170px; }
    th:nth-child(3), td:nth-child(3) { width: 90px; }
    th:nth-child(4), td:nth-child(4) { width: 105px; }
    th:nth-child(5), td:nth-child(5) { width: 120px; }
    th:nth-child(6), td:nth-child(6) { width: 220px; }
    th:nth-child(7), td:nth-child(7) { width: 115px; }
    th:nth-child(8), td:nth-child(8) { width: 155px; }

    th { background: var(--gray-100); padding: 12px 16px; text-align: left; font-size: 11.5px; font-weight: 700; color: var(--gray-500); border-bottom: 1px solid var(--gray-200); text-transform: none; letter-spacing: normal; }
    td { padding: 12px 16px; font-size: 12.5px; border-bottom: 0.5px solid var(--gray-200); vertical-align: middle; word-break: break-word; }
    tr:hover td { background-color: #f8fafc; }
    
    /* KOLOM NO: Diperbaiki Agar Sejajar Sempurna dan Terpusat */
    .ranking-container { display: flex; align-items: center; justify-content: center; width: 100%; }
    .ranking-number { font-weight: 700; color: #2563eb; background: #eff6ff; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; border: 1px solid #bfdbfe; flex-shrink: 0; }

    /* Badge & Status */
    .badge { padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; line-height: 1; box-shadow: 0 1px 2px rgba(0,0,0,0.02); }
    .badge-red { background: #fef2f2; color: #dc2626; border: 1px solid #fca5a5; }
    .badge-yellow { background: #fffbeb; color: #d97706; border: 1px solid #fcd34d; }
    .badge-green { background: #f0fdf4; color: #16a34a; border: 1px solid #86efac; }
    .badge-gray { background: #f8fafc; color: #475569; border: 1px solid #cbd5e1; }
    .status-dot { width: 6px; height: 6px; border-radius: 50%; margin-right: 6px; flex-shrink: 0; }

    /* Tombol Aksi */
    .btn-aksi { padding: 5px 10px; border-radius: 6px; font-size: 11.5px; font-weight: 700; border: 1px solid var(--gray-200); cursor: pointer; transition: .15s; display: inline-flex; align-items: center; gap: 4px; background: white; }
    .btn-update { color: var(--blue); border-color: #bfdbfe; background: #f0f6ff; }
    .btn-update:hover { background: var(--blue); color: white; border-color: var(--blue); }
    .btn-chat { color: #16a34a; border-color: #bbf7d0; background: #f0fdf4; position: relative; }
    .btn-chat:hover { background: #16a34a; color: white; border-color: #16a34a; }
    .chat-badge { position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; font-size: 9px; font-weight: 800; border-radius: 999px; min-width: 14px; height: 14px; display: flex; align-items: center; justify-content: center; padding: 0 2px; border: 1.5px solid white; box-shadow: 0 2px 4px rgba(239,68,68,0.3); }

    /* Modal */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.4); z-index: 200; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
    .modal-overlay.open { display: flex; }
    .modal-box { background: white; border-radius: 12px; width: 100%; max-width: 450px; max-height: 85vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); border: 1px solid var(--gray-200); }
    .modal-head { padding: 16px 20px; border-bottom: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: white; z-index: 1; border-left: 4px solid var(--blue); }
    .modal-title { font-size: 14px; font-weight: 700; color: var(--gray-900); }
    .modal-close { background: transparent; border: none; border-radius: 6px; padding: 4px; cursor: pointer; color: var(--gray-400); display: flex; align-items: center; }
    .modal-close:hover { background: #f1f5f9; color: #334155; }
    .modal-body { padding: 16px 20px; }

    .form-group { margin-bottom: 12px; }
    .form-label { font-size: 11px; font-weight: 700; color: var(--gray-500); margin-bottom: 4px; display: block; }
    .form-control { width: 100%; border-radius: 8px; border: 1px solid var(--gray-200); padding: 8px 12px; font-size: 12.5px; font-weight: 500; font-family: inherit; outline: none; transition: .2s; background: white; }
    .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }

    /* Chat Bubble */
    .chat-list { max-height: 220px; overflow-y: auto; display: flex; flex-direction: column; gap: 6px; margin-bottom: 12px; padding: 2px; }
    .chat-bubble { border-radius: 8px; padding: 8px 12px; border: 1px solid transparent; }
    .chat-bubble.kepsek { background: #e0f2fe; border-color: #bae6fd; } 
    .chat-bubble.walas { background: #f1f5f9; border-color: #e2e8f0; } 
    .chat-meta { display: flex; justify-content: space-between; margin-bottom: 2px; gap: 10px; }
    .chat-name { font-size: 10.5px; font-weight: 700; }
    .chat-time { font-size: 10px; color: var(--gray-500); }
    .chat-text { font-size: 12px; color: var(--gray-900); line-height: 1.4; font-weight: 500; }
</style>

<div class="da-root">
<div class="da-shell">
    
    <!-- SIDEBAR UTUH SESUAI KODE ASLI -->
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
            <a href="{{ route('walas.mfep.hasil') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Analisis</a>
            <div class="sb-nav-section">Riwayat</div>
            <a href="{{ route('walas.riwayat') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Riwayat Analisis</a>
        </div>

        <div class="sb-user">
            <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="sb-user-info">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Wali Kelas</div>
            </div>
            <div class="sb-actions">
                <a href="{{ route('profile.edit') }}" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">@csrf<button type="submit" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg></button></form>
            </div>
        </div>
    </aside>

    <!-- AREA KONTEN UTAMA -->
    <main class="da-main">
        <div class="da-phead">
            <h2 style="font-size:16px; font-weight:700; color:var(--gray-900); letter-spacing:-0.3px;">Hasil Analisis Risiko</h2>
            <p style="font-size:12px; color:var(--gray-500); margin-top:1px;">Hasil identifikasi risiko putus sekolah siswa berdasarkan perhitungan MFEP.</p>
        </div>

        <div class="da-body">
            @if(session('success'))
                <div style="background:#ecfdf5; color:#059669; padding:10px 16px; border-radius:8px; font-size:12.5px; font-weight:600; margin-bottom:16px; border:1px solid #d1fae5;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="background:#fef2f2; color:#ef4444; padding:10px 16px; border-radius:8px; font-size:12.5px; font-weight:600; margin-bottom:16px; border:1px solid #fecaca;">{{ session('error') }}</div>
            @endif

            <!-- Filter Horizontal Satu Baris -->
            <form method="GET" action="{{ route('walas.mfep.hasil') }}" class="filter-card">
                <div class="filter-container">
                    <div class="filter-wrapper">
                        <div class="filter-field">
                            <label class="f-label">Periode</label>
                            <select name="id_periode" class="f-select">
                                <option value="">-- Pilih Periode --</option>
                                @foreach($periodes as $p)
                                    <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                        {{ $p->tahun_ajaran }} - Smstr {{ $p->semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-field">
                            <label class="f-label">Kategori risiko</label>
                            <select name="kategori" class="f-select">
                                <option value="">Semua Kategori</option>
                                <option value="Tinggi" {{ ($kategori ?? '') === 'Tinggi' ? 'selected' : '' }}>🔴 Tinggi</option>
                                <option value="Sedang" {{ ($kategori ?? '') === 'Sedang' ? 'selected' : '' }}>🟡 Sedang</option>
                                <option value="Rendah" {{ ($kategori ?? '') === 'Rendah' ? 'selected' : '' }}>🟢 Rendah</option>
                            </select>
                        </div>
                        <div class="filter-field">
                            <label class="f-label">Status</label>
                            <select name="status" class="f-select">
                                <option value="">Semua Status</option>
                                <option value="belum_diproses"  {{ ($status ?? '') === 'belum_diproses'  ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="sedang_diproses" {{ ($status ?? '') === 'sedang_diproses' ? 'selected' : '' }}>🔄 Dalam Proses</option>
                                <option value="selesai"         {{ ($status ?? '') === 'selesai'         ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                        </div>
                        <div class="filter-field">
                            <label class="f-label">Faktor dominan</label>
                            <select name="faktor" class="f-select">
                                <option value="">Semua Faktor</option>
                                @foreach($faktorList as $f)
                                    <option value="{{ $f }}" {{ ($faktorFilter ?? '') === $f ? 'selected' : '' }}>{{ $f }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-show">Tampilkan</button>
                </div>
            </form>

            <div class="table-card">
                <div class="t-header">
                    <div>
                        <h3 style="font-size:14px; font-weight:700; color:var(--gray-900)">Ranking Identifikasi</h3>
                        <p style="font-size:11px; color:var(--gray-400); margin-top:2px;">
                            @if($periode) Periode Aktif: <b style="color:var(--blue);">{{ $periode->tahun_ajaran }} - Smstr {{ $periode->semester }}</b> @else Silakan pilih periode @endif
                        </p>
                    </div>
                    <a href="{{ route('walas.mfep.index') }}" style="font-size:12px; font-weight:700; color:var(--blue); text-decoration:none;">Ulangi Analisis</a>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th>Nama siswa</th>
                                <th>Preferensi</th>
                                <th>Risiko</th>
                                <th>Faktor dominan</th>
                                <th>Rekomendasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hasil as $index => $item)
                            @php
                                $rekomendasiTerpilih = $item->rekomendasi->firstWhere('is_selected', 1);
                                if (!$rekomendasiTerpilih && !empty($item->tindak_lanjut_final)) {
                                    $rekomendasiTerpilih = $item->rekomendasi->firstWhere('deskripsi_rekomendasi', $item->tindak_lanjut_final);
                                }
                                $rekomendasiFinal = $rekomendasiTerpilih?->deskripsi_rekomendasi ?? $item->tindak_lanjut_final;
                                $statusRekomendasi = $rekomendasiTerpilih?->status ?? 'belum_diproses';
                                $tglPelaksanaan = optional($rekomendasiTerpilih)->tanggal_dilaksanakan;
                                $komentarList = DB::table('rekomendasi_komentar')
                                    ->where('id_hasil', $item->id_hasil)
                                    ->orderBy('created_at', 'asc')
                                    ->get();
                                $jumlahKomentar = $komentarList->count();
                            @endphp
                            <tr>
                                <!-- Bagian Kolom Nomor Urut yang Dirapikan Sejajar Tengah -->
                                <td>
                                    <div class="ranking-container">
                                        <span class="ranking-number">{{ $index + 1 }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight:700; color:var(--gray-900)">{{ $item->siswa->nama_siswa ?? '-' }}</div>
                                    @if($tglPelaksanaan)
                                        <div style="font-size:11px; color:var(--blue); font-weight:500; margin-top:1px;">📅 {{ \Carbon\Carbon::parse($tglPelaksanaan)->translatedFormat('d M Y') }}</div>
                                    @endif
                                </td>
                                <td style="font-family:monospace; font-weight:700; color:var(--gray-900);">{{ number_format((float) $item->total_nilai_preferensi, 4) }}</td>
                                <td>
                                    @if($item->kategori_risiko === 'Tinggi')
                                        <span class="badge badge-red"><span class="status-dot" style="background:#ef4444"></span>Tinggi</span>
                                    @elseif($item->kategori_risiko === 'Sedang')
                                        <span class="badge badge-yellow"><span class="status-dot" style="background:#d97706"></span>Sedang</span>
                                    @else
                                        <span class="badge badge-green"><span class="status-dot" style="background:#10b981"></span>Rendah</span>
                                    @endif
                                </td>
                                <td style="font-size:12px; color:var(--gray-500); font-weight:600;">{{ $item->faktor_dominan ?? '-' }}</td>
                                <td>
                                    @if($rekomendasiFinal)
                                        <span style="font-size:12px; font-weight:600; color:var(--gray-800); line-height:1.4;">{{ $rekomendasiFinal }}</span>
                                        @if(!empty($item->deskripsi_tambahan))
                                            <div style="margin-top:6px; background:#fffbeb; border:1px solid #fcd34d; border-radius:6px; padding:6px; box-shadow: 0 1px 2px rgba(217,119,6,0.05);">
                                                <p style="font-size:9.5px; font-weight:800; color:#b45309; text-transform:uppercase; margin-bottom:2px;">📝 Catatan Kepsek</p>
                                                <p style="font-size:11px; color:#78350f; line-height:1.3; margin:0; font-weight: 500;">{{ $item->deskripsi_tambahan }}</p>
                                            </div>
                                        @endif
                                    @else
                                        <span style="font-size:11px; color:var(--gray-400); font-style:italic;">Menunggu validasi Kepsek</span>
                                    @endif
                                </td>
                                <td>
                                    @if($statusRekomendasi === 'belum_diproses')
                                        <span class="badge badge-gray"><span class="status-dot" style="background:#64748b"></span>Menunggu</span>
                                    @elseif($statusRekomendasi === 'sedang_diproses')
                                        <span class="badge badge-yellow"><span class="status-dot" style="background:#d97706"></span>Proses</span>
                                    @else
                                        <span class="badge badge-green"><span class="status-dot" style="background:#16a34a"></span>Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($rekomendasiFinal)
                                        <div style="display:flex; gap:4px; flex-wrap:wrap;">
                                            <button class="btn-aksi btn-update" onclick="openModalUpdate({{ $item->id_hasil }})">
                                                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="margin-bottom:-1px;"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Update
                                            </button>
                                            <button class="btn-aksi btn-chat" onclick="openModalChat({{ $item->id_hasil }})">
                                                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="margin-bottom:-1px;"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg> Catatan
                                                @if($jumlahKomentar > 0)
                                                    <span class="chat-badge">{{ $jumlahKomentar }}</span>
                                                @endif
                                            </button>
                                        </div>
                                    @else
                                        <span style="font-size:11px; color:var(--gray-400); font-style:italic;">-</span>
                                    @endif
                                </td>
                            </tr>

                            <!-- MODAL UPDATE STATUS -->
                            <div id="modal-update-{{ $item->id_hasil }}" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modal-update-{{ $item->id_hasil }}')">
                                <div class="modal-box">
                                    <div class="modal-head">
                                        <span class="modal-title">✏️ Update Status Rekomendasi</span>
                                        <button class="modal-close" onclick="closeModal('modal-update-{{ $item->id_hasil }}')"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg></button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="background:var(--blue-lt); border-radius:8px; padding:10px; margin-bottom:12px; border:1px solid #bfdbfe;">
                                            <p style="font-size:10px; font-weight:700; color:var(--blue); text-transform:uppercase; margin-bottom:2px;">Rekomendasi</p>
                                            <p style="font-size:12.5px; font-weight:600; color:var(--gray-800);">{{ $rekomendasiFinal }}</p>
                                        </div>

                                        <form action="{{ route('walas.rekomendasi.updateStatus', $item->id_hasil) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control" required id="modal-status-{{ $item->id_hasil }}" onchange="toggleModalChatbox({{ $item->id_hasil }}, this.value)">
                                                    <option value="belum_diproses" {{ $statusRekomendasi === 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                                    <option value="sedang_diproses" {{ $statusRekomendasi === 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                                    <option value="selesai" {{ $statusRekomendasi === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Tanggal Pelaksanaan</label>
                                                <input type="date" name="tanggal_pelaksanaan" class="form-control" required
                                                    value="{{ $tglPelaksanaan ? \Carbon\Carbon::parse($tglPelaksanaan)->format('Y-m-d') : date('Y-m-d') }}">
                                            </div>
                                            <button type="submit" class="btn-show" style="width:100%; margin-top:4px;">
                                                Simpan Perubahan
                                            </button>
                                        </form>

                                        <div id="modal-chatbox-{{ $item->id_hasil }}" style="{{ $statusRekomendasi === 'selesai' ? '' : 'display:none;' }} margin-top:16px; border-top:1px solid var(--gray-100); padding-top:12px;">
                                            <p style="font-size:10.5px; font-weight:700; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px;">💬 Catatan Penyelesaian</p>
                                            
                                            @if($jumlahKomentar > 0)
                                                <div class="chat-list">
                                                    @foreach($komentarList as $kom)
                                                        <div class="chat-bubble {{ $kom->role === 'kepsek' ? 'kepsek' : 'walas' }}">
                                                            <div class="chat-meta">
                                                                <span class="chat-name" style="color:{{ $kom->role === 'kepsek' ? '#1d4ed8' : '#475569' }}">
                                                                    {{ $kom->role === 'kepsek' ? '👤 Kepala Sekolah' : '👤 ' . $kom->nama_user }}
                                                                </span>
                                                                <span class="chat-time">{{ \Carbon\Carbon::parse($kom->created_at)->translatedFormat('d M Y, H:i') }}</span>
                                                            </div>
                                                            <p class="chat-text">{{ $kom->komentar }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p style="font-size:11px; color:var(--gray-400); font-style:italic; margin-bottom:8px;">Belum ada catatan.</p>
                                            @endif

                                            <form action="{{ route('walas.rekomendasi.komentar.simpan', $item->id_hasil) }}" method="POST">
                                                @csrf
                                                <textarea name="komentar" rows="2" placeholder="Tulis catatan penyelesaian..." required class="form-control" style="resize:none;"></textarea>
                                                <button type="submit" style="margin-top:6px; width:100%; background:#16a34a; color:white; border:none; padding:8px; border-radius:8px; font-size:12.5px; font-weight:700; cursor:pointer; box-shadow: 0 2px 4px rgba(22,163,74,0.2);">
                                                    Kirim Catatan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL CHATBOX UTAMA -->
                            <div id="modal-chat-{{ $item->id_hasil }}" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modal-chat-{{ $item->id_hasil }}')">
                                <div class="modal-box">
                                    <div class="modal-head">
                                        <span class="modal-title">💬 Catatan & Komentar</span>
                                        <button class="modal-close" onclick="closeModal('modal-chat-{{ $item->id_hasil }}')"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg></button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="background:var(--gray-50); border-radius:8px; padding:8px; margin-bottom:12px; border:1px solid var(--gray-200);">
                                            <p style="font-size:10px; font-weight:700; color:var(--gray-400); text-transform:uppercase; margin-bottom:2px;">Rekomendasi</p>
                                            <p style="font-size:12px; font-weight:600; color:var(--gray-800);">{{ $rekomendasiFinal }}</p>
                                        </div>

                                        @if($jumlahKomentar > 0)
                                            <div class="chat-list">
                                                @foreach($komentarList as $kom)
                                                    <div class="chat-bubble {{ $kom->role === 'kepsek' ? 'kepsek' : 'walas' }}">
                                                        <div class="chat-meta">
                                                            <span class="chat-name" style="color:{{ $kom->role === 'kepsek' ? '#1d4ed8' : '#475569' }}">
                                                                {{ $kom->role === 'kepsek' ? '👤 Kepala Sekolah' : '👤 ' . $kom->nama_user }}
                                                            </span>
                                                            <span class="chat-time">{{ \Carbon\Carbon::parse($kom->created_at)->translatedFormat('d M Y, H:i') }}</span>
                                                        </div>
                                                        <p class="chat-text">{{ $kom->komentar }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:12px; color:var(--gray-400); font-style:italic; text-align:center; padding:16px 0;">Belum ada catatan atau komentar.</p>
                                        @endif

                                        <form action="{{ route('walas.rekomendasi.komentar.simpan', $item->id_hasil) }}" method="POST">
                                            @csrf
                                            <textarea name="komentar" rows="2" placeholder="Tulis catatan..." required class="form-control" style="resize:none;"></textarea>
                                            <button type="submit" style="margin-top:6px; width:100%; background:#16a34a; color:white; border:none; padding:8px; border-radius:8px; font-size:12.5px; font-weight:700; cursor:pointer; box-shadow: 0 2px 4px rgba(22,163,74,0.2);">
                                                Kirim Catatan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="8" style="padding:40px; text-align:center; color:var(--gray-400); font-size:13px;">Belum ada hasil analisis. Silakan jalankan proses MFEP terlebih dahulu.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
</div>

<script>
    function openModalUpdate(id) {
        document.getElementById('modal-update-' + id).classList.add('open');
    }

    function openModalChat(id) {
        document.getElementById('modal-chat-' + id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    function closeModalOnOverlay(event, id) {
        if (event.target === document.getElementById(id)) {
            closeModal(id);
        }
    }

    function toggleModalChatbox(idHasil, status) {
        const chatbox = document.getElementById('modal-chatbox-' + idHasil);
        if (chatbox) {
            chatbox.style.display = status === 'selesai' ? 'block' : 'none';
        }
    }
</script>
</x-app-layout>