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

    /* ── USER SECTION (PROFIL & LOGOUT) ── */
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

    /* ── CARDS & TABLES ── */
    .card-filter { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; margin-bottom: 24px; }
    .f-grid { display: grid; grid-template-columns: 1fr 1fr 160px; gap: 16px; align-items: flex-end; }
    .f-label { font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-bottom: 8px; display: block; }
    .f-select { width: 100%; border-radius: 12px; border: 1.5px solid var(--gray-200); padding: 10px; font-size: 13px; font-weight: 600; }
    .btn-primary { background: var(--blue); color: white; height: 42px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; transition: .2s; }

    .card-table { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 24px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    th { background: var(--gray-50); padding: 14px 20px; text-align: left; font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--gray-100); }
    td { padding: 16px 20px; font-size: 14px; border-bottom: 1px solid var(--gray-100); color: var(--gray-800); }

    .rank-box { width: 32px; height: 32px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 13px; }
    
    .row-tinggi { background-color: rgba(239, 68, 68, 0.03); }
    .rank-tinggi { background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; }
    
    .row-sedang { background-color: rgba(245, 158, 11, 0.03); }
    .rank-sedang { background: #fef3c7; color: #d97706; border: 1px solid #fcd34d; }
    
    .row-rendah { background-color: rgba(16, 185, 129, 0.03); }
    .rank-rendah { background: #d1fae5; color: #10b981; border: 1px solid #6ee7b7; }

    .badge-risiko { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; }
    .bg-red { background: #ef4444; color: white; }
    .bg-yellow { background: #f59e0b; color: white; }
    .bg-green { background: #10b981; color: white; }
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
            <a href="{{ route('kepsek.ranking') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>Ranking Risiko</a>
            <div class="sb-nav-section">Laporan</div>
            <a href="{{ route('kepsek.laporan') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Laporan Akhir</a>
        </div>

        {{-- USER SECTION (ADDED) --}}
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
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Ranking Prioritas Intervensi</h2>
            <p style="font-size:12px; color:var(--gray-400); margin-top:2px;">Siswa diurutkan dari nilai preferensi tertinggi (paling berisiko).</p>
        </div>

        <div class="da-body">
            {{-- FILTER --}}
            <div class="card-filter">
                <form method="GET" action="{{ route('kepsek.ranking') }}" class="f-grid">
                    <div>
                        <label class="f-label">Pilih Periode</label>
                        <select name="id_periode" class="f-select">
                            <option value="">-- Periode --</option>
                            @foreach($periodes as $p)
                                <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                    {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="f-label">Filter Kelas</label>
                        <select name="id_kelas" class="f-select">
                            <option value="">Semua Kelas</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id_kelas }}" {{ (string) $idKelas === (string) $kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-primary">Tampilkan</button>
                </form>
            </div>

            {{-- TABLE --}}
            <div class="card-table">
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 80px;">Ranking</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Nilai Preferensi</th>
                                <th>Kategori Risiko</th>
                                <th>Faktor Dominan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hasil as $index => $item)
                                @php
                                    $rowClass = ''; $rankClass = ''; $badgeClass = '';
                                    if($item->kategori_risiko === 'Tinggi') {
                                        $rowClass = 'row-tinggi'; $rankClass = 'rank-tinggi'; $badgeClass = 'bg-red';
                                    } elseif($item->kategori_risiko === 'Sedang') {
                                        $rowClass = 'row-sedang'; $rankClass = 'rank-sedang'; $badgeClass = 'bg-yellow';
                                    } else {
                                        $rowClass = 'row-rendah'; $rankClass = 'rank-rendah'; $badgeClass = 'bg-green';
                                    }
                                @endphp
                                <tr class="{{ $rowClass }}">
                                    <td>
                                        <div class="rank-box {{ $rankClass }}">
                                            {{ $index + 1 }}
                                        </div>
                                    </td>
                                    <td style="font-weight: 700; color: var(--gray-900);">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                    <td style="font-weight: 600;">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                    <td style="font-family: monospace; font-weight: 700; color: var(--blue);">
                                        {{ number_format((float) $item->total_nilai_preferensi, 4) }}
                                    </td>
                                    <td>
                                        <span class="badge-risiko {{ $badgeClass }}">
                                            {{ $item->kategori_risiko }}
                                        </span>
                                    </td>
                                    <td style="font-size: 13px; color: var(--gray-500);">{{ $item->faktor_dominan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 60px; text-align: center; color: var(--gray-400);">Data tidak ditemukan.</td>
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