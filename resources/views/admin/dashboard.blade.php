<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
* { box-sizing: border-box; }
.d { font-family: 'Inter', sans-serif; background: #fff; min-height: 100vh; }

/* BANNER */
.d-banner {
    background: #fff;
    padding: 28px 40px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.d-banner h1 { font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 3px; letter-spacing: -0.4px; }
.d-banner p  { font-size: 12px; color: #94a3b8; margin: 0; }
.d-banner-date { font-size: 12px; color: #94a3b8; }

/* STAT STRIP */
.stat-strip {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    border-bottom: 1px solid #f1f5f9;
    background: #fff;
}
.stat-cell {
    padding: 28px 28px;
    border-right: 1px solid #f1f5f9;
    background: #fff;
}
.stat-cell:last-child { border-right: none; }
.stat-cell-label {
    font-size: 10px; font-weight: 600; color: #94a3b8;
    text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 10px;
}
.stat-cell-val {
    font-size: 32px; font-weight: 800; color: #0f172a;
    margin: 0; letter-spacing: -1.5px; line-height: 1;
}

/* BODY */
.d-body {
    padding: 32px 40px;
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 48px;
}

/* SECTION LABEL */
.sec-lbl {
    font-size: 10px; font-weight: 700; color: #cbd5e1;
    text-transform: uppercase; letter-spacing: 0.12em;
    margin: 0 0 14px;
}

/* NAV GRID */
.nav-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.nav-item {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 16px;
    border-radius: 10px;
    text-decoration: none;
    border: 1px solid #f1f5f9;
    transition: all 0.12s;
}
.nav-item:hover { border-color: #bfdbfe; background: #eff6ff; }
.nav-item:hover .nav-title { color: #2563eb; }
.nav-ico {
    width: 34px; height: 34px; border-radius: 9px;
    background: #eff6ff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.nav-title { font-size: 13px; font-weight: 600; color: #1e293b; margin: 0 0 1px; }
.nav-sub   { font-size: 11px; color: #94a3b8; margin: 0; }

/* SIDEBAR */
.tb-head {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 12px;
}
.tb-title { font-size: 13px; font-weight: 700; color: #0f172a; }
.tb-link  { font-size: 11px; color: #94a3b8; text-decoration: none; }
.tb-link:hover { color: #2563eb; }

.row-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #f8fafc;
}
.row-item:last-child { border-bottom: none; }
.av {
    width: 28px; height: 28px; border-radius: 50%;
    background: #eff6ff; color: #3b82f6;
    font-size: 11px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.row-name { font-size: 12px; font-weight: 600; color: #1e293b; margin: 0 0 1px; }
.row-sub  { font-size: 11px; color: #94a3b8; margin: 0; }

.periode-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f8fafc;
}
.periode-row:last-child { border-bottom: none; }
.periode-ta  { font-size: 12px; font-weight: 600; color: #1e293b; margin: 0 0 1px; }
.periode-sem { font-size: 11px; color: #94a3b8; margin: 0; }
.badge-on  { font-size: 10px; font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 2px 8px; border-radius: 999px; white-space: nowrap; }
.badge-off { font-size: 10px; font-weight: 700; color: #94a3b8; background: #f8fafc; padding: 2px 8px; border-radius: 999px; white-space: nowrap; }

.empty-txt { font-size: 12px; color: #e2e8f0; padding: 20px 0; text-align: center; }

.divider { height: 1px; background: #f1f5f9; margin: 28px 0; }

@media (max-width: 1024px) {
    .stat-strip { grid-template-columns: repeat(3,1fr); }
    .d-body { grid-template-columns: 1fr; gap: 32px; padding: 24px 20px; }
    .d-banner { padding: 20px; }
}
@media (max-width: 600px) {
    .stat-strip { grid-template-columns: repeat(2,1fr); }
    .nav-grid { grid-template-columns: 1fr; }
}
</style>

<div class="d">

    {{-- Banner --}}
    <div class="d-banner">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Sistem Identifikasi Risiko Putus Sekolah</p>
        </div>
        <span class="d-banner-date" id="spk-date"></span>
    </div>

    {{-- Stat Strip --}}
    <div class="stat-strip">
        <div class="stat-cell">
            <p class="stat-cell-label">User</p>
            <p class="stat-cell-val">{{ $totalUsers }}</p>
        </div>
        <div class="stat-cell">
            <p class="stat-cell-label">Kelas</p>
            <p class="stat-cell-val">{{ $totalKelas }}</p>
        </div>
        <div class="stat-cell">
            <p class="stat-cell-label">Siswa</p>
            <p class="stat-cell-val">{{ $totalSiswa }}</p>
        </div>
        <div class="stat-cell">
            <p class="stat-cell-label">Kriteria</p>
            <p class="stat-cell-val">{{ $totalKriteria }}</p>
        </div>
        <div class="stat-cell">
            <p class="stat-cell-label">Subkriteria</p>
            <p class="stat-cell-val">{{ $totalSubkriteria }}</p>
        </div>
        <div class="stat-cell">
            <p class="stat-cell-label">Periode</p>
            <p class="stat-cell-val">{{ $totalPeriode }}</p>
        </div>
    </div>

    {{-- Body --}}
    <div class="d-body">

        {{-- Left --}}
        <div>
            <p class="sec-lbl">Menu Utama</p>
            <div class="nav-grid">

                <a href="{{ route('admin.user.index') }}" class="nav-item">
                    <div class="nav-ico">
                        <svg width="17" height="17" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="nav-title">Manajemen User</p>
                        <p class="nav-sub">Admin, wali kelas, kepsek</p>
                    </div>
                </a>

                <a href="{{ route('admin.kelas.index') }}" class="nav-item">
                    <div class="nav-ico">
                        <svg width="17" height="17" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="nav-title">Data Kelas</p>
                        <p class="nav-sub">Kelola kelas & tahun ajaran</p>
                    </div>
                </a>

                <a href="{{ route('admin.siswa.index') }}" class="nav-item">
                    <div class="nav-ico">
                        <svg width="17" height="17" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="nav-title">Data Siswa</p>
                        <p class="nav-sub">Kelola data siswa per kelas</p>
                    </div>
                </a>

                <a href="{{ route('admin.kriteria.index') }}" class="nav-item">
                    <div class="nav-ico">
                        <svg width="17" height="17" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="nav-title">Data Kriteria</p>
                        <p class="nav-sub">Kriteria penilaian risiko</p>
                    </div>
                </a>

                <a href="{{ route('admin.subkriteria.index') }}" class="nav-item">
                    <div class="nav-ico">
                        <svg width="17" height="17" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h10M4 18h6"/>
                        </svg>
                    </div>
                    <div>
                        <p class="nav-title">Data Subkriteria</p>
                        <p class="nav-sub">Subkriteria & nilai skala</p>
                    </div>
                </a>

                <a href="{{ route('admin.periode.index') }}" class="nav-item">
                    <div class="nav-ico">
                        <svg width="17" height="17" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="nav-title">Periode Penilaian</p>
                        <p class="nav-sub">Periode aktif & riwayat</p>
                    </div>
                </a>

            </div>
        </div>

        {{-- Right Sidebar --}}
        <div>
            {{-- Siswa --}}
            <div class="tb-head">
                <span class="tb-title">Siswa Terbaru</span>
                <a href="{{ route('admin.siswa.index') }}" class="tb-link">Lihat semua →</a>
            </div>
            @forelse ($siswaTerbaru as $siswa)
                <div class="row-item">
                    <div class="av">{{ strtoupper(substr($siswa->nama_siswa,0,1)) }}</div>
                    <div>
                        <p class="row-name">{{ $siswa->nama_siswa }}</p>
                        <p class="row-sub">{{ $siswa->nisn }}</p>
                    </div>
                </div>
            @empty
                <p class="empty-txt">Belum ada data</p>
            @endforelse

            <div class="divider"></div>

            {{-- Periode --}}
            <div class="tb-head">
                <span class="tb-title">Periode Terbaru</span>
                <a href="{{ route('admin.periode.index') }}" class="tb-link">Lihat semua →</a>
            </div>
            @forelse ($periodeTerbaru as $periode)
                <div class="periode-row">
                    <div>
                        <p class="periode-ta">{{ $periode->tahun_ajaran }}</p>
                        <p class="periode-sem">{{ $periode->semester }}</p>
                    </div>
                    @if($periode->status == 'aktif')
                        <span class="badge-on">Aktif</span>
                    @else
                        <span class="badge-off">Nonaktif</span>
                    @endif
                </div>
            @empty
                <p class="empty-txt">Belum ada data</p>
            @endforelse
        </div>

    </div>
</div>

<script>
    const el = document.getElementById('spk-date');
    if (el) el.textContent = new Date().toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
</script>

</x-app-layout>