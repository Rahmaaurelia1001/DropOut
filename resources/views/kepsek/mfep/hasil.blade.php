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

    .sb-user { padding: 16px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; gap: 10px; background: white; }
    .sb-user-av { width: 36px; height: 36px; border-radius: 50%; background: var(--blue); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
    .sb-user-info { flex: 1; min-width: 0; }
    .sb-user-name { font-size: 13px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { font-size: 11px; color: var(--gray-400); font-weight: 500; }
    .sb-actions { display: flex; gap: 4px; }
    .sb-btn-icon { background: none; border: none; cursor: pointer; padding: 6px; color: var(--gray-400); border-radius: 8px; transition: .15s; display: flex; align-items: center; }
    .sb-btn-icon:hover { background: var(--gray-100); color: var(--gray-800); }

    /* ── MAIN ── */
    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; flex-shrink: 0; }
    .da-body { padding: 24px 32px; }

    /* ── FILTER ── */
    .filter-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; margin-bottom: 24px; }
    .f-grid { display: grid; grid-template-columns: 1fr 1fr 120px; gap: 16px; align-items: flex-end; }
    .f-label { font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-bottom: 8px; display: block; }
    .f-select { width: 100%; border-radius: 12px; border: 1.5px solid var(--gray-200); padding: 10px; font-size: 13px; font-weight: 600; }
    .btn-filter { background: var(--blue); color: white; height: 42px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }

    /* ── TABLE ── */
    .card-table { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 24px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    table { width: 100%; border-collapse: collapse; }
    th { background: var(--gray-50); padding: 14px 20px; text-align: left; font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--gray-100); }
    td { padding: 14px 20px; font-size: 13.5px; border-bottom: 1px solid var(--gray-100); vertical-align: middle; }

    .badge-risiko { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 800; }
    .bg-red    { background: #fef2f2; color: #ef4444; }
    .bg-yellow { background: #fffbeb; color: #d97706; }
    .bg-green  { background: #ecfdf5; color: #10b981; }

    /* ── DROPDOWN REKOMENDASI ── */
    .dd-container { position: relative; width: 100%; }
    .dd-trigger {
        width: 100%; background: white; border: 1.5px solid var(--gray-200); padding: 9px 13px; border-radius: 12px;
        font-size: 12px; font-weight: 700; color: var(--gray-700); text-align: left; cursor: pointer;
        display: flex; justify-content: space-between; align-items: center; transition: .2s;
    }
    .dd-trigger:hover { border-color: var(--blue); background: var(--gray-50); }
    .dd-menu {
        position: absolute; top: 110%; left: 0; width: 300px; background: white; border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid var(--gray-200); z-index: 50; padding: 8px;
    }
    .dd-item { width: 100%; padding: 10px; border-radius: 8px; text-align: left; background: none; border: none; cursor: pointer; transition: .2s; margin-bottom: 4px; }
    .dd-item:hover { background: var(--blue-lt); }
    .dd-text { font-size: 12px; font-weight: 600; color: var(--gray-800); line-height: 1.4; display: block; margin-bottom: 8px; }
    .btn-pilih-dd { background: #10b981; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 11px; font-weight: 800; width: 100%; cursor: pointer; }
    .is-selected-badge { display: block; text-align: center; background: #ecfdf5; color: #059669; padding: 6px; border-radius: 6px; font-size: 10px; font-weight: 800; border: 1px solid #10b981; }

    /* ── TOMBOL BUKA MODAL ── */
    .btn-open-modal {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 14px; border-radius: 10px; border: 1.5px solid var(--gray-200);
        background: white; font-size: 12px; font-weight: 700; color: var(--gray-700);
        cursor: pointer; transition: all .2s; white-space: nowrap;
    }
    .btn-open-modal:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-lt); }
    .btn-open-modal.has-decision { border-color: #10b981; color: #059669; background: #ecfdf5; }
    .btn-open-modal svg { width: 14px; height: 14px; flex-shrink: 0; }

    /* ── MODAL OVERLAY ── */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(15,23,42,0.45);
        backdrop-filter: blur(4px); z-index: 1000;
        display: flex; align-items: center; justify-content: center; padding: 24px;
        opacity: 0; pointer-events: none; transition: opacity .25s ease;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }

    /* ── MODAL BOX ── */
    .modal-box {
        background: white; border-radius: 24px; width: 100%; max-width: 620px;
        box-shadow: 0 24px 60px rgba(0,0,0,0.18); display: flex; flex-direction: column;
        max-height: 90vh; overflow: hidden;
        transform: translateY(24px) scale(0.97); transition: transform .25s ease;
    }
    .modal-overlay.open .modal-box { transform: translateY(0) scale(1); }

    .modal-header {
        padding: 20px 24px 16px; border-bottom: 1px solid var(--gray-100);
        display: flex; align-items: flex-start; justify-content: space-between; flex-shrink: 0;
    }
    .modal-title { font-size: 16px; font-weight: 800; color: var(--gray-900); }
    .modal-subtitle { font-size: 12px; color: var(--gray-400); font-weight: 500; margin-top: 3px; }
    .modal-close {
        background: var(--gray-100); border: none; cursor: pointer; border-radius: 10px;
        width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
        color: var(--gray-500); transition: .15s; flex-shrink: 0;
    }
    .modal-close:hover { background: var(--gray-200); color: var(--gray-900); }

    .modal-body { padding: 20px 24px; overflow-y: auto; flex: 1; display: flex; flex-direction: column; gap: 20px; }

    /* ── SECTION DALAM MODAL ── */
    .modal-section-title {
        font-size: 10px; font-weight: 800; color: var(--gray-400);
        text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 10px;
        display: flex; align-items: center; gap: 6px;
    }

    /* Keputusan final banner */
    .decision-banner {
        background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 12px;
        padding: 12px 16px; font-size: 13px; font-weight: 600; color: #065f46; line-height: 1.5;
    }
    .no-decision { color: var(--gray-400); font-size: 12px; font-style: italic; }

    /* Deskripsi tambahan */
    .desc-existing {
        background: #fffbeb; border: 1px solid #fde68a; border-radius: 10px;
        padding: 10px 14px; font-size: 12px; color: #92400e; margin-bottom: 10px; line-height: 1.5;
    }
    textarea.modal-textarea {
        width: 100%; border-radius: 10px; border: 1.5px solid var(--gray-200);
        padding: 10px 12px; font-size: 12px; resize: vertical; outline: none;
        font-family: inherit; color: var(--gray-800); line-height: 1.5;
        transition: border-color .2s;
    }
    textarea.modal-textarea:focus { border-color: var(--blue); }

    .btn-save-desc {
        margin-top: 8px; width: 100%; background: #f59e0b; color: white;
        border: none; padding: 8px; border-radius: 10px; font-size: 12px;
        font-weight: 700; cursor: pointer; transition: background .2s;
    }
    .btn-save-desc:hover { background: #d97706; }

    /* Chat komentar */
    .chat-scroll {
        max-height: 200px; overflow-y: auto; display: flex; flex-direction: column;
        gap: 8px; margin-bottom: 10px; padding-right: 4px;
    }
    .chat-bubble {
        border-radius: 10px; padding: 10px 12px;
    }
    .chat-bubble.kepsek { background: #eff6ff; border: 1px solid #bfdbfe; }
    .chat-bubble.other  { background: var(--gray-50); border: 1px solid var(--gray-100); }
    .chat-meta { display: flex; justify-content: space-between; margin-bottom: 4px; }
    .chat-sender { font-size: 10px; font-weight: 800; }
    .chat-sender.kepsek { color: #2563eb; }
    .chat-sender.other  { color: var(--gray-500); }
    .chat-time  { font-size: 10px; color: var(--gray-400); }
    .chat-text  { font-size: 12px; color: var(--gray-800); line-height: 1.45; margin: 0; }
    .no-chat    { font-size: 12px; color: var(--gray-400); font-style: italic; }

    .btn-send-comment {
        margin-top: 8px; width: 100%; background: var(--blue); color: white;
        border: none; padding: 8px; border-radius: 10px; font-size: 12px;
        font-weight: 700; cursor: pointer; transition: background .2s;
    }
    .btn-send-comment:hover { background: #1d4ed8; }

    /* divider dalam modal */
    .modal-divider { height: 1px; background: var(--gray-100); flex-shrink: 0; }
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
            <div class="sb-nav-section">Monitoring</div>
            <a href="{{ route('kepsek.dashboard') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard</a>
            <a href="{{ route('kepsek.kriteria.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Bobot Kriteria</a>
            <a href="{{ route('kepsek.mfep.hasil') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Perhitungan</a>
            <a href="{{ route('kepsek.ranking') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>Ranking Risiko</a>
            <div class="sb-nav-section">Laporan</div>
            <a href="{{ route('kepsek.laporan') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Laporan Akhir</a>
        </div>

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
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Keputusan Hasil Analisis</h2>
        </div>

        <div class="da-body">
            @if(session('success'))
                <div style="background:#ecfdf5; color:#059669; padding:12px 20px; border-radius:12px; font-size:13px; font-weight:600; margin-bottom:24px; border:1px solid #d1fae5;">{{ session('success') }}</div>
            @endif

            <div class="filter-card">
                <form method="GET" action="{{ route('kepsek.mfep.hasil') }}" class="f-grid">
                    <div>
                        <label class="f-label">Periode</label>
                        <select name="id_periode" class="f-select">
                            <option value="">Pilih Periode</option>
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
                    <button type="submit" class="btn-filter">Tampilkan</button>
                </form>
            </div>

            <div class="card-table">
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa & Kelas</th>
                                <th>Preferensi</th>
                                <th>Risiko</th>
                                <th>Faktor Dominan</th>
                                <th>Opsi Rekomendasi</th>
                                <th>Keputusan Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hasil as $index => $item)
                            @php
                                $komentarKepsek = DB::table('rekomendasi_komentar')
                                    ->where('id_hasil', $item->id_hasil)
                                    ->orderBy('created_at', 'asc')
                                    ->get();
                                $hasDecision = !empty($item->tindak_lanjut_final);
                            @endphp
                            <tr>
                                {{-- Siswa & Kelas --}}
                                <td>
                                    <div style="font-weight: 700; color: var(--gray-900);">{{ $item->siswa->nama_siswa ?? '-' }}</div>
                                    <div style="font-size: 11px; color: var(--gray-400); margin-top: 2px;">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</div>
                                </td>

                                {{-- Preferensi --}}
                                <td style="font-family: monospace; font-weight: 700;">{{ number_format((float) $item->total_nilai_preferensi, 4) }}</td>

                                {{-- Risiko --}}
                                <td>
                                    <span class="badge-risiko @if($item->kategori_risiko === 'Tinggi') bg-red @elseif($item->kategori_risiko === 'Sedang') bg-yellow @else bg-green @endif">
                                        {{ $item->kategori_risiko }}
                                    </span>
                                </td>

                                {{-- Faktor Dominan --}}
                                <td style="font-size: 11px; color: var(--gray-500); max-width: 130px;">{{ $item->faktor_dominan ?? '-' }}</td>

                                {{-- Opsi Rekomendasi --}}
                                <td style="min-width: 220px;">
                                    <div x-data="{ open: false }" class="dd-container">
                                        <button @click="open = !open" class="dd-trigger">
                                            <span>Pilih Rekomendasi</span>
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition class="dd-menu" style="display:none;">
                                            @forelse($item->rekomendasi as $rek)
                                                <div class="dd-item">
                                                    <span class="dd-text">{{ $rek->deskripsi_rekomendasi }}</span>
                                                    @if((int) $rek->is_selected === 1)
                                                        <div class="is-selected-badge">Sudah Terpilih</div>
                                                    @else
                                                        <form method="POST" action="{{ route('kepsek.pilih.rekomendasi') }}">
                                                            @csrf
                                                            <input type="hidden" name="id_hasil" value="{{ $item->id_hasil }}">
                                                            <input type="hidden" name="id_rekomendasi" value="{{ $rek->id_rekomendasi }}">
                                                            <button type="submit" class="btn-pilih-dd">Pilih Ini</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @empty
                                                <div style="padding:10px; font-size:11px; color:var(--gray-400); text-align:center;">Tidak ada data</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </td>

                                {{-- Keputusan Final → tombol buka modal --}}
                                <td>
                                    <button
                                        class="btn-open-modal {{ $hasDecision ? 'has-decision' : '' }}"
                                        onclick="openModal('modal-{{ $item->id_hasil }}')"
                                    >
                                        @if($hasDecision)
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Lihat Keputusan
                                        @else
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Isi Keputusan
                                        @endif
                                    </button>
                                </td>
                            </tr>

                            {{-- ═══════════════════════════════════════════════════ --}}
                            {{-- MODAL untuk baris ini                              --}}
                            {{-- ═══════════════════════════════════════════════════ --}}
                            <div class="modal-overlay" id="modal-{{ $item->id_hasil }}" onclick="closeModalOnOverlay(event, 'modal-{{ $item->id_hasil }}')">
                                <div class="modal-box">

                                    {{-- Header --}}
                                    <div class="modal-header">
                                        <div>
                                            <div class="modal-title">Keputusan Final</div>
                                            <div class="modal-subtitle">{{ $item->siswa->nama_siswa ?? '-' }} · {{ $item->siswa->kelas->nama_kelas ?? '-' }}</div>
                                        </div>
                                        <button class="modal-close" onclick="closeModal('modal-{{ $item->id_hasil }}')">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>

                                    {{-- Body --}}
                                    <div class="modal-body">

                                        {{-- ① Keputusan Final --}}
                                        <div>
                                            <p class="modal-section-title">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Keputusan Final
                                            </p>
                                            @if($hasDecision)
                                                <div class="decision-banner">{{ $item->tindak_lanjut_final }}</div>
                                            @else
                                                <p class="no-decision">Belum ada keputusan. Pilih rekomendasi terlebih dahulu.</p>
                                            @endif
                                        </div>

                                        @if($hasDecision)
                                        <div class="modal-divider"></div>

                                        {{-- ② Deskripsi Tambahan --}}
                                        <div>
                                            <p class="modal-section-title">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Deskripsi Tambahan
                                            </p>
                                            @if(!empty($item->deskripsi_tambahan))
                                                <div class="desc-existing">{{ $item->deskripsi_tambahan }}</div>
                                            @endif
                                            <form action="{{ route('kepsek.rekomendasi.deskripsi.simpan', $item->id_hasil) }}" method="POST">
                                                @csrf
                                                <textarea name="deskripsi_tambahan" rows="3" placeholder="Tambahkan deskripsi tambahan atau catatan..."
                                                    class="modal-textarea">{{ $item->deskripsi_tambahan }}</textarea>
                                                <button type="submit" class="btn-save-desc">Simpan Deskripsi</button>
                                            </form>
                                        </div>

                                        <div class="modal-divider"></div>

                                        {{-- ③ Komentar / Chat --}}
                                        <div>
                                            <p class="modal-section-title">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                                Komentar & Arahan
                                            </p>

                                            @if($komentarKepsek->count() > 0)
                                                <div class="chat-scroll">
                                                    @foreach($komentarKepsek as $kom)
                                                        <div class="chat-bubble {{ $kom->role === 'kepsek' ? 'kepsek' : 'other' }}">
                                                            <div class="chat-meta">
                                                                <span class="chat-sender {{ $kom->role === 'kepsek' ? 'kepsek' : 'other' }}">
                                                                    {{ $kom->role === 'kepsek' ? '👤 Kepsek' : '👤 ' . $kom->nama_user }}
                                                                </span>
                                                                <span class="chat-time">{{ \Carbon\Carbon::parse($kom->created_at)->translatedFormat('d M Y, H:i') }}</span>
                                                            </div>
                                                            <p class="chat-text">{{ $kom->komentar }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="no-chat" style="margin-bottom:10px;">Belum ada komentar.</p>
                                            @endif

                                            <form action="{{ route('kepsek.rekomendasi.komentar.simpan', $item->id_hasil) }}" method="POST">
                                                @csrf
                                                <textarea name="komentar" rows="3" placeholder="Tulis komentar atau arahan untuk siswa ini..." required
                                                    class="modal-textarea"></textarea>
                                                <button type="submit" class="btn-send-comment">Kirim Komentar</button>
                                            </form>
                                        </div>
                                        @endif

                                    </div>{{-- /modal-body --}}
                                </div>{{-- /modal-box --}}
                            </div>{{-- /modal-overlay --}}

                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 60px; text-align: center; color: var(--gray-400);">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>{{-- /da-body --}}
    </main>
</div>
</div>

<script>
    function openModal(id) {
        const el = document.getElementById(id);
        if (el) el.classList.add('open');
    }
    function closeModal(id) {
        const el = document.getElementById(id);
        if (el) el.classList.remove('open');
    }
    function closeModalOnOverlay(event, id) {
        if (event.target === event.currentTarget) closeModal(id);
    }
    // Tutup modal dengan tombol Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.open').forEach(function(el) {
                el.classList.remove('open');
            });
        }
    });
</script>
</x-app-layout>