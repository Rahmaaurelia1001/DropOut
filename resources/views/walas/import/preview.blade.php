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
    .sb-nav-section:first-child { margin-top: 0; }

    .sb-item { 
        display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; 
        text-decoration: none; font-size: 13px; font-weight: 600; color: var(--gray-500); transition: all .2s; margin-bottom: 2px; 
    }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-900); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }
    .sb-item svg { width: 18px; height: 18px; stroke-width: 2.5; flex-shrink: 0; }

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
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 20px 32px; flex-shrink: 0; }
    
    .da-body { padding: 32px; }

    /* ── PREVIEW CARD & TABLE ── */
    .card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .card-header { padding: 20px 24px; border-bottom: 1px solid var(--gray-100); background: var(--gray-50); display: flex; justify-content: space-between; align-items: center; }

    .table-container { overflow-x: auto; width: 100%; }
    table { width: 100%; border-collapse: collapse; }
    td { padding: 12px 20px; font-size: 13px; border-bottom: 1px solid var(--gray-100); color: var(--gray-700); white-space: nowrap; }
    tr:nth-child(even) { background: rgba(249, 250, 251, 0.5); }
    tr:hover td { background: rgba(37, 99, 235, 0.05); }

    .btn-confirm { background: var(--blue); color: white; padding: 10px 24px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; transition: .2s; }
    .btn-confirm:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37,99,235,0.2); }
    
    .btn-cancel { background: white; color: var(--gray-500); padding: 10px 24px; border-radius: 12px; font-weight: 700; font-size: 14px; border: 1.5px solid var(--gray-200); text-decoration: none; transition: .2s; display: inline-block; }
    .btn-cancel:hover { background: var(--gray-50); color: var(--gray-800); }
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
            <a href="{{ route('dashboard') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard
            </a>

            <div class="sb-nav-section">Proses SPK</div>
            <a href="{{ route('walas.import.index') }}" class="sb-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>Import Data
            </a>
            <a href="{{ route('walas.mfep.index') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Analisis Risiko
            </a>
            <a href="{{ route('walas.mfep.hasil') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Analisis
            </a>

            <div class="sb-nav-section">Riwayat</div>
            <a href="{{ route('walas.riwayat') }}" class="sb-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Riwayat Analisis
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
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Preview Import Data</h2>
            <p style="font-size:12px; color:var(--gray-400); margin-top:2px;">Mohon periksa baris data di bawah ini sebelum disimpan secara permanen.</p>
        </div>

        <div class="da-body">
            <div class="card">
                <div class="card-header">
                    <div style="font-size:13px; font-weight:700; color:var(--gray-800);">
                        Jenis Data: <span style="color:var(--blue)">{{ ucfirst($jenis_data) }}</span>
                    </div>
                    <div style="font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em;">Tampilan 10 Baris Pertama</div>
                </div>

                <div class="table-container">
                    <table>
                        <tbody>
                            @foreach($rows as $index => $row)
                                @if($index > 10) @break @endif
                                <tr>
                                    @foreach($row as $cell)
                                        <td>{{ $cell }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Warning NISN tidak cocok --}}
@if(count($nisnTidakCocok) > 0)
    <div style="margin: 16px 24px 0; padding: 16px; background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 14px;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:10px;">
            <span style="font-size:18px;">🚫</span>
            <span style="font-size:13px; font-weight:800; color:#b91c1c;">Import Diblokir — {{ count($nisnTidakCocok) }} Data Siswa Tidak Cocok</span>
        </div>
        <p style="font-size:12px; color:#991b1b; margin-bottom:10px; line-height:1.5;">
            NISN berikut tidak ditemukan di daftar siswa kelas Anda. Anda <b>tidak dapat menyimpan</b> file ini. Silakan upload ulang file yang benar:
        </p>
        <div style="background:#fee2e2; border-radius:8px; padding:10px; max-height:120px; overflow-y:auto;">
            @foreach($nisnTidakCocok as $item)
                <div style="font-size:11px; font-weight:600; color:#b91c1c; padding:3px 0; border-bottom:1px solid #fecaca;">
                    ❌ {{ $item }}
                </div>
            @endforeach
        </div>
        <p style="font-size:11px; color:#b91c1c; margin-top:8px; font-weight:700;">
            ⚠️ Pastikan file yang diupload hanya berisi data siswa di kelas Anda.
        </p>
    </div>
@endif

<div style="padding:24px; display:flex; gap:12px; border-top:1px solid var(--gray-100); background:var(--gray-50); margin-top:16px;">
    @if(count($nisnTidakCocok) === 0)
        {{-- Tombol simpan hanya muncul kalau semua NISN cocok --}}
        <form action="{{ route('walas.import.store') }}" method="POST" id="storeForm">
            @csrf
            <input type="hidden" name="jenis_data" value="{{ $jenis_data }}">
            <button type="button" class="btn-confirm" onclick="confirmSimpan()">
                ✅ Konfirmasi & Simpan
            </button>
        </form>
    @else
        {{-- Tombol diblokir --}}
        <button disabled style="background:#e5e7eb; color:#9ca3af; padding:10px 24px; border-radius:12px; font-weight:700; font-size:14px; border:none; cursor:not-allowed;">
            🚫 Tidak Dapat Disimpan
        </button>
    @endif
    <a href="{{ route('walas.import.create') }}" class="btn-cancel">⬅️ Upload Ulang</a>
</div>


            </div>
        </div>
    </main>

</div>
</div>

{{-- ALERT: Konfirmasi Simpan --}}
<div id="alertConfirmSimpan" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:300; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:20px; padding:32px; max-width:400px; width:90%; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
        <div style="font-size:48px; margin-bottom:12px;">💾</div>
        <div style="font-size:16px; font-weight:800; color:#0f172a; margin-bottom:8px;">Konfirmasi Simpan Data</div>
        <div style="font-size:13px; color:#64748b; line-height:1.5; margin-bottom:20px;" id="alertConfirmMsg"></div>
        <div style="display:flex; gap:10px; justify-content:center;">
            <button style="background:#f3f4f6; color:#374151; padding:10px 24px; border-radius:10px; font-weight:700; border:none; cursor:pointer; font-size:13px;"
                onclick="document.getElementById('alertConfirmSimpan').style.display='none'">Batal</button>
            <button style="background:#2563eb; color:white; padding:10px 24px; border-radius:10px; font-weight:700; border:none; cursor:pointer; font-size:13px;"
                onclick="doSimpan()">Ya, Simpan</button>
        </div>
    </div>
</div>

{{-- Loading --}}
<div id="loadingOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:400; align-items:center; justify-content:center; flex-direction:column; gap:16px;">
    <div style="width:48px; height:48px; border:4px solid rgba(255,255,255,0.3); border-top-color:white; border-radius:50%; animation:spin 0.8s linear infinite;"></div>
    <div style="color:white; font-size:14px; font-weight:700; font-family:'Plus Jakarta Sans',sans-serif;">Menyimpan data, mohon tunggu...</div>
</div>

<style>
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
    function confirmSimpan() {
        document.getElementById('alertConfirmMsg').innerHTML = 
            'Semua data siswa cocok. Data akan disimpan secara permanen ke database. Lanjutkan?';
        document.getElementById('alertConfirmSimpan').style.display = 'flex';
    }

    function doSimpan() {
        document.getElementById('alertConfirmSimpan').style.display = 'none';
        document.getElementById('loadingOverlay').style.display = 'flex';
        document.getElementById('storeForm').submit();
    }
</script>
</x-app-layout>