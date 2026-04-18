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

    .da-root { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--gray-50); color: var(--gray-800); height: 100vh; overflow: hidden; }
    .da-shell { display: flex; height: 100vh; }

    /* ── SIDEBAR ── */
    .da-sidebar { width: var(--sidebar-w); background: var(--white); border-right: 1px solid var(--gray-200); display: flex; flex-direction: column; flex-shrink: 0; }
    .sb-brand { padding: 24px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--gray-100); }
    .sb-logo { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #1d4ed8, #2563eb); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(37,99,235,.2); flex-shrink: 0; }
    .sb-brand-name { font-size: 14px; font-weight: 800; color: var(--gray-900); line-height: 1.2; letter-spacing: -0.2px; }
    .sb-brand-sub { font-size: 10px; color: var(--gray-400); font-weight: 600; margin-top: 1px; }
    .sb-nav { padding: 16px 12px; flex: 1; overflow-y: auto; }
    .sb-nav-section { font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.1em; padding: 0 10px; margin: 20px 0 8px; }
    .sb-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: 600; color: var(--gray-500); transition: all .2s; margin-bottom: 2px; }
    .sb-item:hover { background: var(--gray-100); color: var(--gray-900); }
    .sb-item.active { background: var(--blue-lt); color: var(--blue); }
    .sb-item svg { width: 18px; height: 18px; stroke-width: 2.5; flex-shrink: 0; }
    .sb-user { padding: 16px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; background: white; }
    .sb-user-av { width: 36px; height: 36px; border-radius: 50%; background: var(--blue); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
    .sb-user-info { flex: 1; min-width: 0; }
    .sb-user-name { font-size: 13px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { font-size: 11px; color: var(--gray-400); font-weight: 500; }
    .sb-btn-icon { background: none; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn-icon:hover { background: var(--gray-100); color: var(--gray-800); }

    /* ── MAIN ── */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; flex-shrink: 0; }
    .da-body { padding: 32px; max-width: 860px; display: flex; flex-direction: column; gap: 20px; }

    /* ── CARD ── */
    .card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
    .card-title { font-size: 14px; font-weight: 800; color: var(--gray-900); margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .card-title::before { content: ''; width: 3px; height: 13px; background: var(--blue); border-radius: 4px; flex-shrink: 0; }

    /* ── PERIODE GRID ── */
    .period-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .p-item { padding: 14px 16px; border-radius: 12px; background: var(--gray-50); border: 1px solid var(--gray-100); }
    .p-lbl { font-size: 10px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; }
    .p-val { font-size: 15px; font-weight: 800; color: var(--gray-800); }

    /* ── CHECKLIST PRASYARAT ── */
    .checklist { display: flex; flex-direction: column; gap: 10px; }
    .check-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; border: 1.5px solid; }
    .check-item.ok    { background: #f0fdf4; border-color: #bbf7d0; }
    .check-item.fail  { background: #fef2f2; border-color: #fecaca; }
    .check-item.warn  { background: #fffbeb; border-color: #fde68a; }
    .check-icon { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .check-item.ok   .check-icon { background: #dcfce7; color: #16a34a; }
    .check-item.fail .check-icon { background: #fee2e2; color: #dc2626; }
    .check-item.warn .check-icon { background: #fef9c3; color: #ca8a04; }
    .check-label { font-size: 13px; font-weight: 700; }
    .check-item.ok   .check-label { color: #15803d; }
    .check-item.fail .check-label { color: #b91c1c; }
    .check-item.warn .check-label { color: #92400e; }
    .check-desc { font-size: 11px; font-weight: 500; margin-top: 2px; }
    .check-item.ok   .check-desc { color: #4ade80; }
    .check-item.fail .check-desc { color: #f87171; }
    .check-item.warn .check-desc { color: #d97706; }
    .check-action { margin-left: auto; flex-shrink: 0; }
    .link-fix { font-size: 11px; font-weight: 700; color: var(--blue); text-decoration: none; background: var(--blue-lt); padding: 5px 12px; border-radius: 8px; }
    .link-fix:hover { background: #dbeafe; }

    /* ── RUN CARD ── */
    .run-card { text-align: center; padding: 48px 32px; }
    .run-icon { width: 64px; height: 64px; background: var(--blue-lt); color: var(--blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }

    /* ── TOMBOL ── */
    .btn-run {
        background: var(--blue); color: white; padding: 14px 32px; border-radius: 14px;
        font-weight: 800; font-size: 14px; border: none; cursor: pointer; transition: .2s;
        display: inline-flex; align-items: center; gap: 10px;
    }
    .btn-run:hover:not(:disabled) { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37,99,235,0.2); }
    .btn-run:disabled { background: var(--gray-200); color: var(--gray-400); cursor: not-allowed; transform: none; box-shadow: none; }

    /* ── ALERT (no-periode) ── */
    .alert-block { display: flex; align-items: flex-start; gap: 14px; padding: 20px 24px; border-radius: 16px; border: 1.5px solid; }
    .alert-block.warning { background: #fffbeb; border-color: #fde68a; color: #92400e; }
    .alert-block.danger  { background: #fef2f2; border-color: #fecaca; color: #991b1b; }
    .alert-block svg { flex-shrink: 0; margin-top: 1px; }
    .alert-block h4 { font-size: 14px; font-weight: 800; margin-bottom: 4px; }
    .alert-block p { font-size: 12.5px; font-weight: 500; opacity: 0.85; line-height: 1.5; }

    /* ── MODAL KONFIRMASI ── */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(15,23,42,0.45);
        backdrop-filter: blur(4px); z-index: 1000;
        display: flex; align-items: center; justify-content: center; padding: 24px;
        opacity: 0; pointer-events: none; transition: opacity .25s ease;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal-box {
        background: white; border-radius: 24px; width: 100%; max-width: 440px;
        box-shadow: 0 24px 60px rgba(0,0,0,0.18); padding: 32px;
        transform: translateY(20px) scale(0.97); transition: transform .25s ease; text-align: center;
    }
    .modal-overlay.open .modal-box { transform: translateY(0) scale(1); }
    .modal-icon { width: 64px; height: 64px; background: #fff7ed; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
    .modal-title { font-size: 18px; font-weight: 800; color: var(--gray-900); margin-bottom: 10px; }
    .modal-desc { font-size: 13px; color: var(--gray-500); line-height: 1.6; margin-bottom: 28px; }
    .modal-actions { display: flex; gap: 12px; }
    .btn-cancel { flex: 1; padding: 12px; border-radius: 12px; border: 1.5px solid var(--gray-200); background: white; font-size: 13px; font-weight: 700; color: var(--gray-500); cursor: pointer; transition: .15s; }
    .btn-cancel:hover { background: var(--gray-50); border-color: var(--gray-300); }
    .btn-confirm { flex: 1; padding: 12px; border-radius: 12px; border: none; background: var(--blue); color: white; font-size: 13px; font-weight: 800; cursor: pointer; transition: .2s; display: flex; align-items: center; justify-content: center; gap: 6px; }
    .btn-confirm:hover { background: #1d4ed8; }
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
            <a href="{{ route('walas.mfep.index') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Analisis Risiko</a>
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
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Analisis Risiko Putus Sekolah</h2>
            <p style="font-size:11px; color:var(--gray-400); margin-top:2px;">Jalankan kalkulasi MFEP untuk menghitung risiko siswa di kelas Anda.</p>
        </div>

        <div class="da-body">

            @if(!$periodeAktif)
                {{-- ══ TIDAK ADA PERIODE AKTIF ══ --}}
                <div class="alert-block warning">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div>
                        <h4>Tidak Ada Periode Aktif</h4>
                        <p>Saat ini tidak ada periode penilaian yang aktif. Hubungi Administrator untuk mengaktifkan periode terlebih dahulu sebelum menjalankan analisis.</p>
                    </div>
                </div>

            @else
                {{-- ══ PERIODE AKTIF ══ --}}
                <div class="card">
                    <div class="card-title">Periode Penilaian Aktif</div>
                    <div class="period-grid">
                        <div class="p-item">
                            <p class="p-lbl">Tahun Ajaran</p>
                            <h4 class="p-val">{{ $periodeAktif->tahun_ajaran }}</h4>
                        </div>
                        <div class="p-item">
                            <p class="p-lbl">Semester</p>
                            <h4 class="p-val">{{ $periodeAktif->semester }}</h4>
                        </div>
                        <div class="p-item">
                            <p class="p-lbl">Status</p>
                            <h4 class="p-val" style="color:#059669;">{{ $periodeAktif->status }}</h4>
                        </div>
                    </div>
                </div>

                {{-- ══ CHECKLIST PRASYARAT ══ --}}
                @php
                    $adaData    = isset($jumlahSiswa) && $jumlahSiswa > 0;
                    $adaBobot   = isset($jumlahKriteria) && $jumlahKriteria > 0;
                    $bisaProses = $adaData && $adaBobot;
                @endphp

                <div class="card">
                    <div class="card-title">Prasyarat Analisis</div>
                    <div class="checklist">

                        {{-- Cek 1: Data Siswa --}}
                        <div class="check-item {{ $adaData ? 'ok' : 'fail' }}">
                            <div class="check-icon">
                                @if($adaData)
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                @else
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                @endif
                            </div>
                            <div>
                                <div class="check-label">
                                    @if($adaData)
                                        Data siswa tersedia — {{ $jumlahSiswa }} siswa siap dianalisis
                                    @else
                                        Data siswa belum diimport
                                    @endif
                                </div>
                                <div class="check-desc">
                                    @if($adaData)
                                        Data evaluasi periode ini sudah ada.
                                    @else
                                        Import data nilai dan pendukung siswa terlebih dahulu.
                                    @endif
                                </div>
                            </div>
                            @if(!$adaData)
                                <div class="check-action">
                                    <a href="{{ route('walas.import.index') }}" class="link-fix">Import Sekarang →</a>
                                </div>
                            @endif
                        </div>

                        {{-- Cek 2: Bobot Kriteria --}}
                        <div class="check-item {{ $adaBobot ? 'ok' : 'fail' }}">
                            <div class="check-icon">
                                @if($adaBobot)
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                @else
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                @endif
                            </div>
                            <div>
                                <div class="check-label">
                                    @if($adaBobot)
                                        Bobot kriteria tersedia — {{ $jumlahKriteria }} kriteria aktif
                                    @else
                                        Bobot kriteria belum dikonfigurasi
                                    @endif
                                </div>
                                <div class="check-desc">
                                    @if($adaBobot)
                                        Kriteria MFEP sudah siap digunakan.
                                    @else
                                        Hubungi Kepala Sekolah untuk mengatur bobot kriteria.
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Cek 3: Hasil sebelumnya (peringatan kalau ada) --}}
                        @if(isset($sudahAdaHasil) && $sudahAdaHasil)
                        <div class="check-item warn">
                            <div class="check-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01"/></svg>
                            </div>
                            <div>
                                <div class="check-label">Hasil analisis sebelumnya akan ditimpa</div>
                                <div class="check-desc">Periode ini sudah pernah dianalisis. Menjalankan ulang akan mengganti semua data hasil yang lama.</div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                {{-- ══ TOMBOL JALANKAN ══ --}}
                <div class="card run-card">
                    <div class="run-icon">
                        <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 style="font-size:20px; font-weight:800; color:var(--gray-900); margin-bottom:10px;">Mulai Proses Perhitungan</h3>
                    <p style="font-size:13.5px; color:var(--gray-500); max-width:480px; margin: 0 auto 28px; line-height:1.65;">
                        Sistem akan menghitung <strong>Multi-Factor Evaluation Process (MFEP)</strong> pada seluruh data siswa di periode ini secara otomatis.
                    </p>

                    {{-- Form disembunyikan, submit dipicu dari modal --}}
                    <form id="mfepForm" action="{{ route('walas.mfep.proses') }}" method="POST" style="display:none;">
                        @csrf
                    </form>

                    @if($bisaProses)
                        <button type="button" class="btn-run" onclick="openConfirm()">
                            Jalankan Analisis Sekarang
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    @else
                        <button type="button" class="btn-run" disabled>
                            Prasyarat Belum Terpenuhi
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                        </button>
                        <p style="font-size:12px; color:var(--gray-400); margin-top:14px;">Lengkapi prasyarat di atas terlebih dahulu untuk mengaktifkan tombol ini.</p>
                    @endif
                </div>

            @endif
        </div>{{-- /da-body --}}
    </main>
</div>
</div>

{{-- ══ MODAL KONFIRMASI ══ --}}
<div class="modal-overlay" id="confirmModal" onclick="closeConfirmOnOverlay(event)">
    <div class="modal-box">
        <div class="modal-icon">
            <svg width="30" height="30" fill="none" stroke="#f59e0b" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <div class="modal-title">Jalankan Analisis MFEP?</div>
        <div class="modal-desc">
            Proses ini akan menghitung ulang seluruh nilai risiko siswa.
            @if(isset($sudahAdaHasil) && $sudahAdaHasil)
                <br><br><strong style="color:#b91c1c;">⚠️ Hasil analisis sebelumnya akan ditimpa dan tidak dapat dikembalikan.</strong>
            @else
                Hasil analisis akan disimpan dan bisa dilihat di menu <strong>Hasil Analisis</strong>.
            @endif
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeConfirm()">Batal</button>
            <button class="btn-confirm" onclick="submitMfep()">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                Ya, Jalankan
            </button>
        </div>
    </div>
</div>

<script>
    function openConfirm() {
        document.getElementById('confirmModal').classList.add('open');
    }
    function closeConfirm() {
        document.getElementById('confirmModal').classList.remove('open');
    }
    function closeConfirmOnOverlay(event) {
        if (event.target === event.currentTarget) closeConfirm();
    }
    function submitMfep() {
        // Ubah tombol jadi loading state
        var btn = document.querySelector('.btn-confirm');
        btn.disabled = true;
        btn.innerHTML = '<svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="animation:spin 1s linear infinite"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Memproses...';
        document.getElementById('mfepForm').submit();
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeConfirm();
    });
</script>

<style>
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>
</x-app-layout>