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

    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; flex-shrink: 0; }
    .da-body { padding: 24px 32px; }

    .filter-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 16px 24px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .f-label { font-size: 12px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-right: 12px; }
    .f-select { border-radius: 10px; border: 1.5px solid var(--gray-200); padding: 8px 16px; font-size: 13px; font-weight: 600; min-width: 240px; }
    .btn-show { background: var(--blue); color: white; padding: 9px 20px; border-radius: 10px; font-weight: 700; font-size: 13px; border: none; cursor: pointer; transition: .2s; }
    .btn-show:hover { background: #1d4ed8; }

    .table-card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 24px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .t-header { padding: 20px 24px; border-bottom: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: center; }
    
    table { width: 100%; border-collapse: collapse; }
    th { background: var(--gray-50); padding: 14px 24px; text-align: left; font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--gray-200); }
    td { padding: 14px 24px; font-size: 13px; border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
    
    .badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 800; display: inline-flex; align-items: center; }
    .badge-red { background: #fef2f2; color: #ef4444; }
    .badge-yellow { background: #fffbeb; color: #d97706; }
    .badge-green { background: #ecfdf5; color: #10b981; }
    .badge-gray { background: #f3f4f6; color: var(--gray-500); }
    .status-dot { width: 7px; height: 7px; border-radius: 50%; margin-right: 5px; }

    /* Action buttons */
    .btn-aksi { padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; border: none; cursor: pointer; transition: .15s; display: inline-flex; align-items: center; gap: 5px; }
    .btn-update { background: #eff6ff; color: #2563eb; }
    .btn-update:hover { background: #dbeafe; }
    .btn-chat { background: #f0fdf4; color: #10b981; position: relative; }
    .btn-chat:hover { background: #dcfce7; }
    .chat-badge { position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; font-size: 9px; font-weight: 800; border-radius: 999px; min-width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; padding: 0 3px; border: 2px solid white; }

    /* Modal */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 200; align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal-box { background: white; border-radius: 20px; width: 100%; max-width: 480px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
    .modal-head { padding: 20px 24px; border-bottom: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: white; z-index: 1; }
    .modal-title { font-size: 15px; font-weight: 800; color: var(--gray-900); }
    .modal-close { background: var(--gray-100); border: none; border-radius: 8px; padding: 6px 10px; cursor: pointer; font-size: 16px; color: var(--gray-500); }
    .modal-close:hover { background: var(--gray-200); }
    .modal-body { padding: 20px 24px; }

    .form-group { margin-bottom: 14px; }
    .form-label { font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-bottom: 6px; display: block; }
    .form-control { width: 100%; border-radius: 10px; border: 1.5px solid var(--gray-200); padding: 10px 12px; font-size: 13px; font-weight: 500; font-family: inherit; outline: none; transition: .2s; }
    .form-control:focus { border-color: var(--blue); }

    /* Chat */
    .chat-list { max-height: 250px; overflow-y: auto; display: flex; flex-direction: column; gap: 8px; margin-bottom: 14px; }
    .chat-bubble { border-radius: 12px; padding: 10px 12px; }
    .chat-bubble.kepsek { background: #eff6ff; border: 1px solid #bfdbfe; }
    .chat-bubble.walas { background: var(--gray-50); border: 1px solid var(--gray-100); }
    .chat-meta { display: flex; justify-content: space-between; margin-bottom: 4px; }
    .chat-name { font-size: 10px; font-weight: 800; }
    .chat-time { font-size: 10px; color: var(--gray-400); }
    .chat-text { font-size: 12px; color: var(--gray-800); line-height: 1.5; }
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
            @if(session('success'))
                <div style="background:#ecfdf5; color:#059669; padding:12px 20px; border-radius:12px; font-size:13px; font-weight:600; margin-bottom:20px; border:1px solid #d1fae5;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="background:#fef2f2; color:#ef4444; padding:12px 20px; border-radius:12px; font-size:13px; font-weight:600; margin-bottom:20px; border:1px solid #fecaca;">{{ session('error') }}</div>
            @endif

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
                                <th>Rekomendasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hasil as $index => $item)
                            @php
                                $rekomendasiTerpilih = $item->rekomendasi->firstWhere('is_selected', 1);
                                if (!$rekomendasiTerpilih && !empty($item->tindak_lanjut_final)) {
                                    $rekomendasiTerpilih = $item->rekomendasi->firstWhere('deskripsi_rekomendasi', $item->tindak_lanjut_final);
                                }
                                $rekomendasiFinal = $rekomendasiTerpilih?->deskripsi_rekomendasi ?? $item->tindak_lanjut_final;
                                $statusRekomendasi = $rekomendasiTerpilih?->status ?? 'belum_diproses';
                                $tglPelaksanaan = optional($rekomendasiTerpilih)->tanggal_dilaksanakan;
                                $komentarList = DB::table('rekomendasi_komentar')
                                    ->where('id_hasil', $item->id_hasil)
                                    ->orderBy('created_at', 'asc')
                                    ->get();
                                $jumlahKomentar = $komentarList->count();
                            @endphp
                            <tr>
                                <td style="font-weight:800; color:var(--gray-400)">{{ $index + 1 }}</td>
                                <td>
                                    <div style="font-weight:700; color:var(--gray-900)">{{ $item->siswa->nama_siswa ?? '-' }}</div>
                                    @if($tglPelaksanaan)
                                        <div style="font-size:11px; color:var(--gray-400); margin-top:2px;">📅 {{ \Carbon\Carbon::parse($tglPelaksanaan)->translatedFormat('d M Y') }}</div>
                                    @endif
                                </td>
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
                                <td style="font-size:12px; color:var(--gray-500); font-weight:500; max-width:120px;">{{ $item->faktor_dominan ?? '-' }}</td>
                                
                                <td style="max-width:200px;">
    @if($rekomendasiFinal)
        <span style="font-size:12px; font-weight:600; color:var(--gray-800); line-height:1.4;">{{ $rekomendasiFinal }}</span>
        
        @if(!empty($item->deskripsi_tambahan))
            <div style="margin-top:8px; background:#fffbeb; border:1px solid #fde68a; border-radius:8px; padding:8px;">
                <p style="font-size:10px; font-weight:800; color:#92400e; text-transform:uppercase; margin-bottom:3px;">📝 Catatan Kepsek</p>
                <p style="font-size:11px; color:#78350f; line-height:1.4; margin:0;">{{ $item->deskripsi_tambahan }}</p>
            </div>
        @endif
    @else
        <span style="font-size:11px; color:var(--gray-400); font-style:italic;">Menunggu validasi Kepsek</span>
    @endif
</td>




                                <td>
                                    @if($statusRekomendasi === 'belum_diproses')
                                        <span class="badge badge-gray"><span class="status-dot" style="background:#9ca3af"></span>Menunggu</span>
                                    @elseif($statusRekomendasi === 'sedang_diproses')
                                        <span class="badge badge-yellow"><span class="status-dot" style="background:#f59e0b"></span>Dalam Proses</span>
                                    @else
                                        <span class="badge badge-green"><span class="status-dot" style="background:#10b981"></span>Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($rekomendasiFinal)
                                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                            {{-- Tombol Update Status --}}
                                            <button class="btn-aksi btn-update" onclick="openModalUpdate({{ $item->id_hasil }})">
                                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Update
                                            </button>

                                            {{-- Tombol Catatan --}}
                                            <button class="btn-aksi btn-chat" onclick="openModalChat({{ $item->id_hasil }})">
                                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                                Catatan
                                                @if($jumlahKomentar > 0)
                                                    <span class="chat-badge">{{ $jumlahKomentar }}</span>
                                                @endif
                                            </button>
                                        </div>
                                    @else
                                        <span style="font-size:11px; color:var(--gray-400); font-style:italic;">-</span>
                                    @endif
                                </td>
                            </tr>

                            {{-- MODAL UPDATE STATUS --}}
                            <div id="modal-update-{{ $item->id_hasil }}" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modal-update-{{ $item->id_hasil }}')">
                                <div class="modal-box">
                                    <div class="modal-head">
                                        <span class="modal-title">✏️ Update Status Rekomendasi</span>
                                        <button class="modal-close" onclick="closeModal('modal-update-{{ $item->id_hasil }}')">✕</button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="background:var(--gray-50); border-radius:10px; padding:12px; margin-bottom:16px; border:1px solid var(--gray-100);">
                                            <p style="font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:4px;">Rekomendasi</p>
                                            <p style="font-size:13px; font-weight:600; color:var(--gray-800);">{{ $rekomendasiFinal }}</p>
                                        </div>

                                        <form action="{{ route('walas.rekomendasi.updateStatus', $item->id_hasil) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control" required id="modal-status-{{ $item->id_hasil }}" onchange="toggleModalChatbox({{ $item->id_hasil }}, this.value)">
                                                    <option value="belum_diproses" {{ $statusRekomendasi === 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                                    <option value="sedang_diproses" {{ $statusRekomendasi === 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                                    <option value="selesai" {{ $statusRekomendasi === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Tanggal Pelaksanaan</label>
                                                <input type="date" name="tanggal_pelaksanaan" class="form-control" required
                                                    value="{{ $tglPelaksanaan ? \Carbon\Carbon::parse($tglPelaksanaan)->format('Y-m-d') : date('Y-m-d') }}">
                                            </div>
                                            <button type="submit" class="btn-show" style="width:100%; justify-content:center; display:flex;">
                                                Simpan Perubahan
                                            </button>
                                        </form>

                                        {{-- Chatbox muncul saat selesai --}}
                                        <div id="modal-chatbox-{{ $item->id_hasil }}" style="{{ $statusRekomendasi === 'selesai' ? '' : 'display:none;' }} margin-top:20px; border-top:1px solid var(--gray-100); padding-top:16px;">
                                            <p style="font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:10px;">💬 Catatan Penyelesaian</p>
                                            
                                            @if($jumlahKomentar > 0)
                                                <div class="chat-list">
                                                    @foreach($komentarList as $kom)
                                                        <div class="chat-bubble {{ $kom->role === 'kepsek' ? 'kepsek' : 'walas' }}">
                                                            <div class="chat-meta">
                                                                <span class="chat-name" style="color:{{ $kom->role === 'kepsek' ? '#2563eb' : 'var(--gray-500)' }}">
                                                                    {{ $kom->role === 'kepsek' ? '👤 Kepala Sekolah' : '👤 ' . $kom->nama_user }}
                                                                </span>
                                                                <span class="chat-time">{{ \Carbon\Carbon::parse($kom->created_at)->translatedFormat('d M Y, H:i') }}</span>
                                                            </div>
                                                            <p class="chat-text">{{ $kom->komentar }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p style="font-size:11px; color:var(--gray-400); font-style:italic; margin-bottom:10px;">Belum ada catatan.</p>
                                            @endif

                                            <form action="{{ route('walas.rekomendasi.komentar.simpan', $item->id_hasil) }}" method="POST">
                                                @csrf
                                                <textarea name="komentar" rows="3" placeholder="Tulis catatan penyelesaian..." required class="form-control" style="resize:none;"></textarea>
                                                <button type="submit" style="margin-top:8px; width:100%; background:#10b981; color:white; border:none; padding:10px; border-radius:10px; font-size:13px; font-weight:700; cursor:pointer;">
                                                    Kirim Catatan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- MODAL CHATBOX --}}
                            <div id="modal-chat-{{ $item->id_hasil }}" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modal-chat-{{ $item->id_hasil }}')">
                                <div class="modal-box">
                                    <div class="modal-head">
                                        <span class="modal-title">💬 Catatan & Komentar</span>
                                        <button class="modal-close" onclick="closeModal('modal-chat-{{ $item->id_hasil }}')">✕</button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="background:var(--gray-50); border-radius:10px; padding:10px; margin-bottom:14px; border:1px solid var(--gray-100);">
                                            <p style="font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:2px;">Rekomendasi</p>
                                            <p style="font-size:12px; font-weight:600; color:var(--gray-800);">{{ $rekomendasiFinal }}</p>
                                        </div>

                                        @if($jumlahKomentar > 0)
                                            <div class="chat-list">
                                                @foreach($komentarList as $kom)
                                                    <div class="chat-bubble {{ $kom->role === 'kepsek' ? 'kepsek' : 'walas' }}">
                                                        <div class="chat-meta">
                                                            <span class="chat-name" style="color:{{ $kom->role === 'kepsek' ? '#2563eb' : 'var(--gray-500)' }}">
                                                                {{ $kom->role === 'kepsek' ? '👤 Kepala Sekolah' : '👤 ' . $kom->nama_user }}
                                                            </span>
                                                            <span class="chat-time">{{ \Carbon\Carbon::parse($kom->created_at)->translatedFormat('d M Y, H:i') }}</span>
                                                        </div>
                                                        <p class="chat-text">{{ $kom->komentar }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p style="font-size:12px; color:var(--gray-400); font-style:italic; text-align:center; padding:20px 0;">Belum ada catatan atau komentar.</p>
                                        @endif

                                        <form action="{{ route('walas.rekomendasi.komentar.simpan', $item->id_hasil) }}" method="POST">
                                            @csrf
                                            <textarea name="komentar" rows="3" placeholder="Tulis catatan..." required class="form-control" style="resize:none;"></textarea>
                                            <button type="submit" style="margin-top:8px; width:100%; background:#10b981; color:white; border:none; padding:10px; border-radius:10px; font-size:13px; font-weight:700; cursor:pointer;">
                                                Kirim Catatan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="8" style="padding:60px; text-align:center; color:var(--gray-400);">Belum ada hasil analisis. Silakan jalankan proses MFEP terlebih dahulu.</td>
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

<script>
    function openModalUpdate(id) {
        document.getElementById('modal-update-' + id).classList.add('open');
    }

    function openModalChat(id) {
        document.getElementById('modal-chat-' + id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    function closeModalOnOverlay(event, id) {
        if (event.target === document.getElementById(id)) {
            closeModal(id);
        }
    }

    function toggleModalChatbox(idHasil, status) {
        const chatbox = document.getElementById('modal-chatbox-' + idHasil);
        if (chatbox) {
            chatbox.style.display = status === 'selesai' ? 'block' : 'none';
        }
    }
</script>
</x-app-layout>