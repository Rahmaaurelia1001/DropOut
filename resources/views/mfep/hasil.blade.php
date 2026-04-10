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
    .sb-btn-icon { background: none; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn-icon:hover { background: var(--gray-100); color: var(--gray-800); }

    /* ── MAIN AREA ── */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; flex-shrink: 0; }
    
    .da-body { padding: 24px 32px; }

    /* ── FILTER CARD ── */
    .filter-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 16px 24px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .f-label { font-size: 12px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-right: 12px; }
    .f-select { border-radius: 10px; border: 1.5px solid var(--gray-200); padding: 8px 16px; font-size: 13px; font-weight: 600; min-width: 240px; }
    .btn-show { background: var(--blue); color: white; padding: 9px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; border: none; cursor: pointer; transition: .2s; }
    .btn-show:hover { background: #1d4ed8; }

    /* ── TABLE CARD ── */
    .table-card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 24px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .t-header { padding: 20px 24px; border-bottom: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: center; }
    
    table { width: 100%; border-collapse: collapse; }
    th { background: var(--gray-50); padding: 14px 24px; text-align: left; font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--gray-200); }
    td { padding: 16px 24px; font-size: 13.5px; border-bottom: 1px solid var(--gray-100); vertical-align: top; }
    
    /* ── BADGES ── */
    .badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 800; display: inline-flex; align-items: center; }
    .badge-red { background: #fef2f2; color: #ef4444; }
    .badge-yellow { background: #fffbeb; color: #d97706; }
    .badge-green { background: #ecfdf5; color: #10b981; }
    .badge-gray { background: #f3f4f6; color: var(--gray-500); }

    .status-dot { width: 8px; height: 8px; border-radius: 50%; margin-right: 6px; }
    
    .rekom-box { border: 1.5px solid var(--gray-100); border-radius: 12px; padding: 12px; background: white; max-width: 400px; }
    .rekom-select { width: 100%; margin-top: 10px; border-radius: 8px; border: 1px solid var(--gray-200); padding: 6px 10px; font-size: 12px; font-weight: 600; }
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

    <main class="da-main">
        <div class="da-phead">
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Hasil Analisis Risiko</h2>
            <p style="font-size:12px; color:var(--gray-400); margin-top:2px;">Hasil identifikasi risiko putus sekolah siswa berdasarkan perhitungan MFEP.</p>
        </div>

        <div class="da-body">
            {{-- Filter --}}
            <form method="GET" action="{{ route('walas.mfep.hasil') }}" class="filter-card">
                <div style="display:flex; align-items:center">
                    <span class="f-label">Filter Periode:</span>
                    <select name="id_periode" class="f-select">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periodes as $p)
                            <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-show">Tampilkan Data</button>
            </form>

            {{-- Table --}}
            <div class="table-card">
                <div class="t-header">
                    <div>
                        <h3 style="font-size:15px; font-weight:800; color:var(--gray-900)">Ranking Identifikasi</h3>
                        <p style="font-size:11px; color:var(--gray-400); margin-top:4px;">
                            @if($periode) Periode Aktif: <b>{{ $periode->tahun_ajaran }} - Smstr {{ $periode->semester }}</b> @else Silakan pilih periode @endif
                        </p>
                    </div>
                    <a href="{{ route('walas.mfep.index') }}" style="font-size:12px; font-weight:700; color:var(--blue); text-decoration:none;">Ulangi Analisis</a>
                </div>

                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Preferensi</th>
                                <th>Risiko</th>
                                <th>Faktor Dominan</th>
                                <th>Rekomendasi & Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hasil as $index => $item)
                            <tr>
                                <td style="font-weight:800; color:var(--gray-400)">{{ $index + 1 }}</td>
                                <td style="font-weight:700; color:var(--gray-900)">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <td style="font-family:monospace; font-weight:600;">{{ number_format((float) $item->total_nilai_preferensi, 4) }}</td>
                                <td>
                                    @if($item->kategori_risiko === 'Tinggi')
                                        <span class="badge badge-red">Tinggi</span>
                                    @elseif($item->kategori_risiko === 'Sedang')
                                        <span class="badge badge-yellow">Sedang</span>
                                    @else
                                        <span class="badge badge-green">Rendah</span>
                                    @endif
                                </td>
                                <td style="font-size:12px; color:var(--gray-500); font-weight:500;">{{ $item->faktor_dominan ?? '-' }}</td>
                                <td>
                                    @php
                                        $rekomendasiTerpilih = $item->rekomendasi->firstWhere('is_selected', 1);
                                        if (!$rekomendasiTerpilih && !empty($item->tindak_lanjut_final)) {
                                            $rekomendasiTerpilih = $item->rekomendasi->firstWhere('deskripsi_rekomendasi', $item->tindak_lanjut_final);
                                        }
                                        $rekomendasiFinal = $rekomendasiTerpilih?->deskripsi_rekomendasi ?? $item->tindak_lanjut_final;
                                        $statusRekomendasi = $rekomendasiTerpilih?->status ?? 'belum_diproses';
                                    @endphp

                                    @if($rekomendasiFinal)
                                        <div class="rekom-box">
                                            <div style="font-size:12px; font-weight:700; color:var(--gray-800); line-height:1.4">{{ $rekomendasiFinal }}</div>
                                            
                                            <div style="margin-top:8px">
                                                @if($statusRekomendasi === 'belum_diproses')
                                                    <span class="badge badge-gray"><span class="status-dot" style="background:#9ca3af"></span>Menunggu</span>
                                                @elseif($statusRekomendasi === 'sedang_diproses')
                                                    <span class="badge badge-yellow"><span class="status-dot" style="background:#f59e0b"></span>Proses</span>
                                                @else
                                                    <span class="badge badge-green"><span class="status-dot" style="background:#10b981"></span>Selesai</span>
                                                @endif
                                            </div>

                                            <form action="{{ route('walas.rekomendasi.updateStatus', $item->id_hasil) }}" method="POST">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="rekom-select">
                                                    <option value="belum_diproses" {{ $statusRekomendasi === 'belum_diproses' ? 'selected' : '' }}>Set Belum Diproses</option>
                                                    <option value="sedang_diproses" {{ $statusRekomendasi === 'sedang_diproses' ? 'selected' : '' }}>Set Sedang Diproses</option>
                                                    <option value="selesai" {{ $statusRekomendasi === 'selesai' ? 'selected' : '' }}>Set Selesai</option>
                                                </select>
                                            </form>
                                        </div>
                                    @else
                                        <span style="font-size:11px; color:var(--gray-400); font-style:italic;">Menunggu validasi Kepsek</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="padding:60px; text-align:center; color:var(--gray-400);">Belum ada hasil analisis. Silakan jalankan proses MFEP terlebih dahulu.</td>
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
</x-app-layout>