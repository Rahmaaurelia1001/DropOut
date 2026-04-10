<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue:     #2563eb;
        --blue-lt:  #eff6ff;
        --blue-mid: #dbeafe;
        --white:    #ffffff;
        --gray-50:  #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --green-lt: #f0fdf4;
        --green-bd: #bbf7d0;
        --green-dk: #16a34a;
        --red:      #ef4444;
        --red-lt:   #fef2f2;
        --red-bd:   #fecaca;
        --sidebar-w: 224px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    nav[x-data], header { display: none !important; }

    .da-root {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--gray-50); color: var(--gray-800);
        -webkit-font-smoothing: antialiased; min-height: 100vh;
    }

    .da-shell { display: flex; min-height: 100vh; }

    /* ── SIDEBAR LENGKAP ── */
    .da-sidebar {
        width: var(--sidebar-w); background: var(--white);
        border-right: 1px solid var(--gray-200);
        position: fixed; top: 0; left: 0; bottom: 0;
        z-index: 40; display: flex; flex-direction: column; overflow: hidden;
    }
    .sb-brand { padding: 18px 16px 14px; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid var(--gray-100); }
    .sb-logo { width: 36px; height: 36px; border-radius: 9px; background: linear-gradient(135deg, #1d4ed8, #2563eb); display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(37,99,235,.25); }
    .sb-brand-name { font-size: 13px; font-weight: 800; color: var(--gray-900); line-height: 1.2; }
    .sb-brand-sub  { font-size: 10px; color: var(--gray-400); font-weight: 500; margin-top: 1px; }

    .sb-nav { padding: 12px 10px; flex: 1; overflow-y: auto; }
    .sb-nav-section { font-size: 9.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.1em; padding: 0 8px; margin: 14px 0 5px; }
    
    .sb-item { display: flex; align-items: center; gap: 9px; padding: 8px 10px; border-radius: 8px; text-decoration: none; font-size: 12.5px; font-weight: 600; color: var(--gray-500); transition: all .13s; margin-bottom: 1px; }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-800); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }

    .sb-user { padding: 12px 14px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; gap: 9px; background: var(--white); }
    .sb-user-av { width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #38bdf8); color: white; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; }
    .sb-action-btn { background: none; border: none; padding: 5px; color: var(--gray-400); border-radius: 6px; transition: all .13s; cursor: pointer; display: flex; text-decoration: none; }
    .sb-action-btn:hover { background: var(--gray-100); color: var(--gray-700); }
    .sb-action-logout:hover { background: #fee2e2; color: var(--red); }

    /* ── MAIN AREA ── */
    .da-main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-width: 0; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 20px 28px; display: flex; align-items: center; gap: 12px; }
    .da-phead-back { width: 32px; height: 32px; border-radius: 8px; border: 1.5px solid var(--gray-200); display: flex; align-items: center; justify-content: center; text-decoration: none; color: var(--gray-500); transition: .13s; }
    .da-phead-back:hover { border-color: var(--blue-mid); background: var(--blue-lt); color: var(--blue); }
    .da-phead-title { font-size: 18px; font-weight: 800; color: var(--gray-900); letter-spacing: -0.3px; }

    /* ── FORM STYLING ── */
    .da-content { padding: 28px; max-width: 600px; }
    .form-card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .form-card-head { padding: 16px 22px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; gap: 12px; }
    .form-card-ico { width: 34px; height: 34px; background: var(--blue-lt); border: 1.5px solid var(--blue-mid); border-radius: 9px; display: flex; align-items: center; justify-content: center; color: var(--blue); }
    
    .form-body { padding: 22px; display: flex; flex-direction: column; gap: 18px; }
    .form-group { display: flex; flex-direction: column; gap: 6px; }

    .form-label { font-size: 12px; font-weight: 700; color: var(--gray-700); }
    .form-control {
        width: 100%; padding: 10px 12px; border: 1.5px solid var(--gray-200);
        border-radius: 9px; font-size: 13px; font-weight: 500; outline: none; transition: all .15s; font-family: inherit;
    }
    .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
    .form-hint { font-size: 11px; color: var(--gray-400); font-weight: 500; margin-top: 2px; }

    .form-foot { padding: 16px 22px; background: var(--gray-50); border-top: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: center; }

    .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; cursor: pointer; text-decoration: none; border: none; transition: all .15s; font-family: inherit; }
    .btn-primary { background: var(--blue); color: white; }
    .btn-primary:hover { background: #1d4ed8; box-shadow: 0 3px 10px rgba(37,99,235,.2); }
    .btn-secondary { background: white; color: var(--gray-700); border: 1.5px solid var(--gray-200); }
</style>

<div class="da-root">
<div class="da-shell">

    {{-- ══ SIDEBAR LENGKAP 100% ══ --}}
    <aside class="da-sidebar">
        <div class="sb-brand">
            <div class="sb-logo"><svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg></div>
            <div>
                <div class="sb-brand-name">SPK Putus Sekolah</div>
                <div class="sb-brand-sub">SDN 11 Kampung Batu</div>
            </div>
        </div>

        <div class="sb-nav">
            <div class="sb-nav-section">Menu</div>
            <a href="{{ route('dashboard') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard</a>

            <div class="sb-nav-section">Manajemen</div>
            <a href="{{ route('admin.user.index') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>Manajemen User</a>
            <a href="{{ route('admin.kelas.index') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>Data Kelas</a>
            <a href="{{ route('admin.siswa.index') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>Data Siswa</a>
            <a href="{{ route('admin.mapel.index') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>Mata Pelajaran</a>

            <div class="sb-nav-section">SPK</div>
            <a href="{{ route('admin.kriteria.index') }}" class="sb-item active"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>Data Kriteria</a>
            <a href="{{ route('admin.subkriteria.index') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg>Data Subkriteria</a>
            <a href="{{ route('admin.periode.index') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Periode Penilaian</a>
            <a href="{{ route('admin.master-rekomendasi.index') }}" class="sb-item"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>Rekomendasi</a>
        </div>

        <div class="sb-user">
            <div class="sb-user-av">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div style="flex:1; min-width:0">
                <div class="sb-user-name" style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap; font-weight:700; font-size:12px;">{{ Auth::user()->name }}</div>
                <div style="font-size:10px; color:var(--gray-400)">Administrator</div>
            </div>
            <div style="display:flex; gap:2px">
                <a href="{{ route('profile.edit') }}" class="sb-action-btn"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></a>
                <form action="{{ route('logout') }}" method="POST" style="margin:0">@csrf
                    <button type="submit" class="sb-action-btn sb-action-logout"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg></button>
                </form>
            </div>
        </div>
    </aside>

    <main class="da-main">
        {{-- Header --}}
        <div class="da-phead">
            <a href="{{ route('admin.kriteria.index') }}" class="da-phead-back" title="Kembali">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="da-phead-title">Tambah Kriteria Baru</h2>
                <p style="font-size:12px; color:var(--gray-400); margin-top:2px">Definisikan parameter penilaian SPK baru</p>
            </div>
        </div>

        <div class="da-content">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div style="margin-bottom: 20px; padding: 12px 16px; background: var(--green-lt); border: 1.5px solid var(--green-bd); border-radius: 10px; color: var(--green-dk); font-size: 13px; font-weight: 600;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="margin-bottom: 20px; padding: 12px 16px; background: var(--red-lt); border: 1.5px solid var(--red-bd); border-radius: 10px; color: var(--red); font-size: 13px; font-weight: 600;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.kriteria.store') }}" method="POST">
                @csrf
                <div class="form-card">
                    <div class="form-card-head">
                        <div class="form-card-ico">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <div style="font-weight: 800; font-size: 14px;">Parameter Kriteria</div>
                            <div style="font-size: 11px; color: var(--gray-400);">Lengkapi nama dan nilai bobot kriteria</div>
                        </div>
                    </div>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="form-label">Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" class="form-control" placeholder="Contoh: Kehadiran / Penghasilan Orang Tua" required autofocus>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nilai Bobot</label>
                            <input type="number" step="0.01" name="bobot" class="form-control" placeholder="Contoh: 0.25" required>
                            <span class="form-hint">Gunakan angka desimal (titik). Total seluruh kriteria harus 1.00</span>
                        </div>
                    </div>

                    <div class="form-foot">
                        <a href="{{ route('admin.kriteria.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M5 13l4 4L19 7"/></svg>
                            Simpan Kriteria
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
</div>
</x-app-layout>