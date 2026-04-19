<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue: #2563eb; --blue-lt: #eff6ff; --white: #ffffff;
        --gray-50: #f9fafb; --gray-100: #f3f4f6; --gray-200: #e5e7eb;
        --gray-400: #9ca3af; --gray-500: #64748b; --gray-800: #1e293b; --gray-900: #0f172a;
        --sidebar-w: 240px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    nav[x-data], header { display: none !important; }

    .da-root { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--gray-50); color: var(--gray-800); height: 100vh; overflow: hidden; }
    .da-shell { display: flex; height: 100vh; }

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
    .sb-actions { display: flex; gap: 4px; }
    .sb-btn-icon { background: none; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn-icon:hover { background: var(--gray-100); color: var(--gray-800); }

    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }
    .da-body { padding: 32px; }

    .btn-upload { background: var(--blue); color: white; padding: 10px 20px; border-radius: 12px; font-weight: 700; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: .2s; }
    .btn-upload:hover { background: #1d4ed8; }

    .status-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 28px; }
    .status-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 24px; display: flex; gap: 16px; align-items: flex-start; }
    .status-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
    .status-icon.blue { background: #eff6ff; }
    .status-icon.green { background: #ecfdf5; }
    .status-info { flex: 1; min-width: 0; }
    .status-title { font-size: 12px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
    .status-file { font-size: 13px; font-weight: 700; color: var(--gray-900); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-bottom: 4px; }
    .status-date { font-size: 11px; color: var(--gray-400); font-weight: 500; }
    .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 800; margin-top: 8px; }
    .status-badge.done { background: #ecfdf5; color: #059669; }
    .status-badge.empty { background: var(--gray-100); color: var(--gray-400); }

    .checklist-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 24px; }
    .check-item { display: flex; align-items: center; gap: 14px; padding: 14px 0; border-bottom: 1px solid var(--gray-100); }
    .check-item:last-child { border-bottom: none; padding-bottom: 0; }
    .check-item:first-child { padding-top: 0; }
    .check-dot { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800; flex-shrink: 0; }
    .check-dot.done { background: #ecfdf5; color: #059669; }
    .check-dot.pending { background: var(--gray-100); color: var(--gray-400); font-size: 12px; }
    .check-label { font-size: 13px; font-weight: 700; color: var(--gray-800); }
    .check-sub { font-size: 11px; color: var(--gray-400); margin-top: 2px; line-height: 1.4; }
</style>

<div class="da-root">
<div class="da-shell">

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
            <a href="{{ route('walas.import.index') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>Import Data</a>
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
            <div class="sb-actions">
                <a href="{{ route('profile.edit') }}" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">@csrf<button type="submit" class="sb-btn-icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg></button></form>
            </div>
        </div>
    </aside>

    <main class="da-main">
        <div class="da-phead">
            <div>
                <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Import Data Akademik</h2>
                <p style="font-size:12px; color:var(--gray-400); margin-top:2px;">Status upload data untuk periode aktif</p>
            </div>
            <a href="{{ route('walas.import.create') }}" class="btn-upload">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                Upload File Baru
            </a>
        </div>

        <div class="da-body">
            @if(session('success'))
                <div style="background:#ecfdf5; border:1px solid #d1fae5; padding:14px 20px; border-radius:14px; margin-bottom:24px; color:#059669; font-size:13px; font-weight:600;">
                    ✅ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background:#fef2f2; border:1px solid #fee2e2; padding:14px 20px; border-radius:14px; margin-bottom:24px; color:#b91c1c; font-size:13px; font-weight:600;">
                    ❌ {{ session('error') }}
                </div>
            @endif

            {{-- Periode Aktif --}}
            @if($periodeAktif)
                <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:14px; padding:14px 20px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
                    <span style="font-size:16px;">📅</span>
                    <span style="font-size:13px; font-weight:700; color:#1d4ed8;">Periode Aktif: {{ $periodeAktif->tahun_ajaran }} - Semester {{ $periodeAktif->semester }}</span>
                </div>
            @else
                <div style="background:#fef2f2; border:1px solid #fee2e2; border-radius:14px; padding:14px 20px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
                    <span style="font-size:16px;">⚠️</span>
                    <span style="font-size:13px; font-weight:700; color:#b91c1c;">Belum ada periode aktif. Hubungi admin.</span>
                </div>
            @endif

            {{-- Status Upload Cards --}}
            <div class="status-grid">
                <div class="status-card">
                    <div class="status-icon blue">📊</div>
                    <div class="status-info">
                        <div class="status-title">Nilai Mapel</div>
                        @if($importNilai)
                            <div class="status-file" title="{{ $importNilai->nama_file }}">
                                {{ Str::limit($importNilai->nama_file, 35) }}
                            </div>
                            <div class="status-date">
                                Diupload: {{ \Carbon\Carbon::parse($importNilai->tanggal_upload)->translatedFormat('d M Y, H:i') }}
                            </div>
                            <span class="status-badge done">✅ Sudah Diupload</span>
                        @else
                            <div class="status-file" style="color:var(--gray-400); font-style:italic;">Belum ada file</div>
                            <div class="status-date">—</div>
                            <span class="status-badge empty">⏳ Belum Diupload</span>
                        @endif
                    </div>
                </div>

                <div class="status-card">
                    <div class="status-icon green">📋</div>
                    <div class="status-info">
                        <div class="status-title">Evaluasi Siswa</div>
                        @if($importEvaluasi)
                            <div class="status-file" title="{{ $importEvaluasi->nama_file }}">
                                {{ Str::limit($importEvaluasi->nama_file, 35) }}
                            </div>
                            <div class="status-date">
                                Diupload: {{ \Carbon\Carbon::parse($importEvaluasi->tanggal_upload)->translatedFormat('d M Y, H:i') }}
                            </div>
                            <span class="status-badge done">✅ Sudah Diupload</span>
                        @else
                            <div class="status-file" style="color:var(--gray-400); font-style:italic;">Belum ada file</div>
                            <div class="status-date">—</div>
                            <span class="status-badge empty">⏳ Belum Diupload</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Checklist panduan --}}
            <div class="checklist-card">
                <div style="font-size:14px; font-weight:800; color:var(--gray-900); margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                    📌 Panduan Upload Data
                </div>
                <div class="check-item">
                    <div class="check-dot {{ $importNilai ? 'done' : 'pending' }}">
                        {{ $importNilai ? '✅' : '1' }}
                    </div>
                    <div>
                        <div class="check-label">Upload file Nilai Mapel</div>
                        <div class="check-sub">File Excel berisi NISN, nama siswa, dan nilai per mata pelajaran</div>
                    </div>
                </div>
                <div class="check-item">
                    <div class="check-dot {{ $importEvaluasi ? 'done' : 'pending' }}">
                        {{ $importEvaluasi ? '✅' : '2' }}
                    </div>
                    <div>
                        <div class="check-label">Upload file Evaluasi Siswa</div>
                        <div class="check-sub">File Excel berisi NISN, presensi, pekerjaan dan pendidikan orang tua</div>
                    </div>
                </div>
                <div class="check-item">
                    <div class="check-dot {{ ($importNilai && $importEvaluasi) ? 'done' : 'pending' }}">
                        {{ ($importNilai && $importEvaluasi) ? '✅' : '3' }}
                    </div>
                    <div>
                        <div class="check-label">Jalankan Analisis Risiko</div>
                        <div class="check-sub">Setelah kedua file terupload, buka menu Analisis Risiko dan klik Proses</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
</x-app-layout>