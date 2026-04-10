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

    /* ── SIDEBAR WALAS (FIX: 5 MENU SAJA) ── */
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
    .sb-nav-section:first-child { margin-top: 0; }

    .sb-item { 
        display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; 
        text-decoration: none; font-size: 13px; font-weight: 600; color: var(--gray-500); transition: all .2s; margin-bottom: 2px; 
    }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-900); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }
    .sb-item svg { width: 18px; height: 18px; stroke-width: 2.5; flex-shrink: 0; }

    /* ── FOOTER USER ── */
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
    
    .da-body { padding: 32px; max-width: 900px; }
    .card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 28px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    
    .f-label { display: block; font-size: 13px; font-weight: 700; color: var(--gray-800); margin-bottom: 8px; }
    .f-select { width: 100%; border-radius: 12px; border: 1.5px solid var(--gray-200); padding: 10px 14px; font-size: 14px; background: var(--gray-50); }
    .f-file-input { display: block; width: 100%; font-size: 14px; color: var(--gray-500); background: var(--gray-50); border: 1.5px dashed var(--gray-200); border-radius: 12px; padding: 20px; cursor: pointer; }
    
    .note-box { background: #eff6ff; border: 1px solid #dbeafe; border-radius: 14px; padding: 16px; margin-top: 24px; }
    .btn-primary { background: var(--blue); color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }
    .btn-secondary { background: white; color: var(--gray-800); padding: 12px 24px; border-radius: 12px; font-weight: 700; border: 1.5px solid var(--gray-200); text-decoration: none; }
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
            <a href="{{ route('dashboard') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard
            </a>

            <div class="sb-nav-section">Proses SPK</div>
            <a href="{{ route('walas.import.index') }}" class="sb-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>Import Data
            </a>
            <a href="{{ route('walas.mfep.index') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Analisis Risiko
            </a>
            <a href="{{ route('walas.mfep.hasil') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Analisis
            </a>

            <div class="sb-nav-section">Riwayat</div>
            <a href="{{ route('walas.riwayat') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Riwayat Analisis
            </a>
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
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Upload File Import</h2>
        </div>

        <div class="da-body">
            @if ($errors->any())
                <div style="background:#fef2f2; border:1px solid #fee2e2; padding:16px; border-radius:14px; margin-bottom:24px; color:#b91c1c; font-size:13px;">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </div>
            @endif

            <div class="card">
                <form action="{{ route('walas.import.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom: 24px;">
                        <label class="f-label">Jenis Data Import</label>
                        <select name="jenis_data" class="f-select">
                            <option value="">-- Pilih Jenis Data --</option>
                            <option value="nilai_mapel">Nilai Mapel</option>
                            <option value="evaluasi">Evaluasi Siswa (Rapor)</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label class="f-label">File Excel</label>
                        <input type="file" name="file_excel" class="f-file-input">
                    </div>

                    <div class="note-box">
                        <div style="font-weight:800; color:#1e40af; font-size:13px; margin-bottom:8px;">Catatan:</div>
                        <ul style="font-size:12px; color:#1e40af; line-height:1.6; list-style:inside disc;">
                            <li>Pastikan format kolom sesuai template.</li>
                            <li>Gunakan <b>Evaluasi Siswa</b> untuk data gabungan nilai & profil.</li>
                        </ul>
                    </div>

                    <div style="margin-top: 32px; display: flex; gap: 12px;">
                        <button type="submit" class="btn-primary">Upload & Preview</button>
                        <a href="{{ route('walas.import.index') }}" class="btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
</div>
</x-app-layout>