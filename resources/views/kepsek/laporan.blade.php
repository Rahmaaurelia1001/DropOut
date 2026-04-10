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

    /* ── SIDEBAR ── */
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

    /* ── USER SECTION (ADDED) ── */
    .sb-user { padding: 16px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; background: white; }
    .sb-user-av { width: 36px; height: 36px; border-radius: 50%; background: var(--blue); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
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

    /* ── FILTER & PAPER ── */
    .card-filter { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; margin-bottom: 24px; }
    .f-grid { display: grid; grid-template-columns: 1fr 1fr 160px; gap: 16px; align-items: flex-end; }
    .f-label { font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-bottom: 8px; display: block; }
    .f-select { width: 100%; border-radius: 12px; border: 1.5px solid var(--gray-200); padding: 10px; font-size: 13px; font-weight: 600; }
    .btn-submit { background: var(--blue); color: white; height: 42px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }

    .report-paper { background: white; border: 1.5px solid var(--gray-200); border-radius: 24px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .report-header { text-align: center; border-bottom: 2px solid var(--gray-900); padding-bottom: 20px; margin-bottom: 30px; }
    .report-title { font-size: 18px; font-weight: 800; color: var(--gray-900); text-transform: uppercase; }
    
    .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .data-table th { background: var(--gray-50); border: 1px solid var(--gray-200); padding: 12px 10px; text-align: left; font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; }
    .data-table td { border: 1px solid var(--gray-200); padding: 12px 10px; font-size: 13px; color: var(--gray-800); }

    .badge-risiko { padding: 3px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; }
    .bg-red { background: #fee2e2; color: #ef4444; }
    .bg-yellow { background: #fef3c7; color: #d97706; }
    .bg-green { background: #d1fae5; color: #10b981; }

    .action-row { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; }
    .btn-pdf { background: #ef4444; color: white; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 8px; }
    .btn-print { background: #10b981; color: white; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px; }
</style>

<div class="da-root">
<div class="da-shell">
    
    {{-- SIDEBAR KEPSEK --}}
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
            <a href="{{ route('kepsek.dashboard') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard</a>
            <a href="{{ route('kepsek.kriteria.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Bobot Kriteria</a>
            <a href="{{ route('kepsek.mfep.hasil') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Perhitungan</a>
            <a href="{{ route('kepsek.ranking') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>Ranking Risiko</a>
            <div class="sb-nav-section">Laporan</div>
            <a href="{{ route('kepsek.laporan') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Laporan Akhir</a>
        </div>

        {{-- USER SECTION WITH PROFILE & LOGOUT --}}
        <div class="sb-user">
            <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="sb-user-info">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Kepala Sekolah</div>
            </div>
            <div class="sb-actions">
                <a href="{{ route('profile.edit') }}" class="sb-btn-icon" title="Profil">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="sb-btn-icon" title="Keluar">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="da-main">
        <div class="da-phead">
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Laporan Akhir SPK</h2>
        </div>

        <div class="da-body">
            <div class="card-filter">
                <form method="GET" action="{{ route('kepsek.laporan') }}" class="f-grid">
                    <div>
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
                    <div>
                        <label class="f-label">Kelas</label>
                        <select name="id_kelas" class="f-select">
                            <option value="">Semua Kelas</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id_kelas }}" {{ (string) $idKelas === (string) $kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-submit">Tampilkan</button>
                </form>
            </div>

            <div class="report-paper">
                <div class="report-header">
                    <h3 class="report-title">Laporan Hasil Identifikasi Risiko Putus Sekolah</h3>
                    <p style="font-size:14px; color:var(--gray-500); margin-top:4px; font-weight:600;">SDN 11 Kampung Batu Dalam</p>
                </div>

                <table class="meta-table">
                    <tr>
                        <td class="meta-label">Periode</td>
                        <td style="font-weight:700">: @if($periode) {{ $periode->tahun_ajaran }} - Semester {{ $periode->semester }} @else - @endif</td>
                    </tr>
                    <tr>
                        <td class="meta-label">Kelas</td>
                        <td style="font-weight:700">: @if(!empty($idKelas)) {{ optional($kelasList->firstWhere('id_kelas', $idKelas))->nama_kelas }} @else Semua Kelas @endif</td>
                    </tr>
                </table>

                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Preferensi</th>
                                <th>Risiko</th>
                                <th>Faktor Dominan</th>
                                <th>Keputusan Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hasil as $index => $item)
                                <tr>
                                    <td style="text-align:center; font-weight:700;">{{ $index + 1 }}</td>
                                    <td style="font-weight:700;">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                    <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                    <td style="font-family:monospace; font-weight:600;">{{ number_format((float) $item->total_nilai_preferensi, 4) }}</td>
                                    <td>
                                        <span class="badge-risiko @if($item->kategori_risiko == 'Tinggi') bg-red @elseif($item->kategori_risiko == 'Sedang') bg-yellow @else bg-green @endif">
                                            {{ $item->kategori_risiko }}
                                        </span>
                                    </td>
                                    <td style="font-size:11px; color:var(--gray-500);">{{ $item->faktor_dominan ?? '-' }}</td>
                                    <td style="font-weight:600; font-size:11px;">{{ $item->tindak_lanjut_final ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="padding:40px; text-align:center; color:var(--gray-400);">Silakan pilih periode untuk menampilkan laporan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="action-row">
                    <a href="{{ route('kepsek.laporan.exportPdf', ['id_periode' => $idPeriode, 'id_kelas' => $idKelas]) }}" class="btn-pdf">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path d="M9 9h1.5m1.5 0H13m-4 4h4m-4 4h4"/></svg>
                        Export PDF
                    </a>
                    <button onclick="window.print()" class="btn-print">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Cetak Laporan
                    </button>
                </div>
            </div>
        </div>
    </main>

</div>
</div>
</x-app-layout>