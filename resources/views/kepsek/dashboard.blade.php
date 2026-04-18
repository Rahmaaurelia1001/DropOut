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

    /* ── SIDEBAR (KONSISTEN) ── */
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
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }
    .da-body { padding: 24px 32px; }

    .card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .card-title { font-size: 14px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
    .card-title::before { content: ''; width: 4px; height: 14px; background: var(--blue); border-radius: 4px; }

    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
    .stat-card { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; }
    .stat-lbl { font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; }
    .stat-val { font-size: 26px; font-weight: 800; color: var(--gray-900); margin-top: 8px; }

    .filter-box { background: white; border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 16px 24px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .f-select { border-radius: 10px; border: 1.5px solid var(--gray-200); padding: 8px 16px; font-size: 13px; font-weight: 600; min-width: 240px; }
    .btn-primary { background: var(--blue); color: white; padding: 10px 24px; border-radius: 10px; font-weight: 700; font-size: 13px; border: none; cursor: pointer; transition: .2s; }

    .grid-dashboard { display: grid; grid-template-columns: 1.5fr 1.1fr; gap: 24px; margin-bottom: 24px; }
    canvas { max-height: 240px; width: 100% !important; }

    .kelas-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .kelas-card { border: 1.5px solid var(--gray-100); border-radius: 18px; padding: 16px; background: white; }
    .prog-item { text-align: center; padding: 10px; border-radius: 12px; }
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
            <div class="sb-nav-section">Monitoring</div>
            <a href="{{ route('kepsek.dashboard') }}" class="sb-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard</a>
            <a href="{{ route('kepsek.kriteria.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Bobot Kriteria</a>
            <a href="{{ route('kepsek.mfep.hasil') }}" class="sb-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Hasil Perhitungan</a>
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
    <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Dashboard Monitoring Sekolah</h2>
    <div style="display:flex; align-items:center; gap:12px;">
        <div style="font-size:10px; font-weight:700; color:var(--gray-500); background:var(--gray-100); padding:6px 12px; border-radius:8px;" id="date-indo"></div>

        {{-- 🔔 BELL ICON --}}
<div style="position:relative;" id="kepsekBellWrap">
    <button id="kepsekBellBtn" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:8px; cursor:pointer; display:flex; align-items:center; justify-content:center; color:#64748b; transition:.15s;"
        onmouseover="this.style.background='#eff6ff'; this.style.borderColor='#93c5fd'; this.style.color='#2563eb';"
        onmouseout="this.style.background='#f8fafc'; this.style.borderColor='#e2e8f0'; this.style.color='#64748b';">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <span id="kepsekBellBadge" style="display:none; position:absolute; top:-4px; right:-4px; background:#ef4444; color:white; font-size:10px; font-weight:700; border-radius:999px; min-width:18px; height:18px; align-items:center; justify-content:center; padding:0 4px; border:2px solid white;"></span>
    </button>
    <div id="kepsekBellPanel" style="display:none; position:absolute; right:0; top:calc(100% + 10px); width:360px; background:#fff; border:1px solid #e2e8f0; border-radius:16px; box-shadow:0 12px 32px rgba(0,0,0,0.12); z-index:999; overflow:hidden;">
        <div style="padding:14px 16px; border-bottom:1px solid #f1f5f9; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:13px; font-weight:800; color:#1e293b;">🔔 Aktivitas Terbaru</span>
            <button onclick="kepsekMarkAllRead()" style="font-size:11px; font-weight:600; color:#2563eb; background:none; border:none; cursor:pointer;">Tandai semua dibaca</button>
        </div>
        <div id="kepsekBellList" style="max-height:320px; overflow-y:auto;">
            <div style="padding:32px 16px; text-align:center; color:#94a3b8; font-size:13px;">Memuat aktivitas...</div>
        </div>
    </div>
</div>


    </div>
</div>

<script>
    var kepsekBellBtn   = document.getElementById('kepsekBellBtn');
    var kepsekBellPanel = document.getElementById('kepsekBellPanel');
    var kepsekBellBadge = document.getElementById('kepsekBellBadge');
    var kepsekBellList  = document.getElementById('kepsekBellList');

    function getReadIds() { return JSON.parse(localStorage.getItem('spk_read_logs') || '[]'); }
    function saveReadIds(ids) { localStorage.setItem('spk_read_logs', JSON.stringify(ids)); }

    kepsekBellBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        var isOpen = kepsekBellPanel.style.display === 'block';
        kepsekBellPanel.style.display = isOpen ? 'none' : 'block';
        if (!isOpen) kepsekLoadBellLogs();
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('kepsekBellWrap').contains(e.target)) {
            kepsekBellPanel.style.display = 'none';
        }
    });

    function kepsekTimeAgo(dateStr) {
        var diff = Math.floor((new Date() - new Date(dateStr)) / 1000);
        if (diff < 60) return diff + ' detik lalu';
        if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
        return Math.floor(diff / 86400) + ' hari lalu';
    }

    function kepsekRoleLabel(role) {
        if (role === 'wali_kelas') return 'Wali Kelas';
        if (role === 'kepsek') return 'Kepsek';
        return 'Admin';
    }

    function kepsekLoadBellLogs() {
        fetch('{{ route("log.activities") }}')
            .then(function(r) { return r.json(); })
            .then(function(logs) {
                var readIds = getReadIds();
                if (!logs.length) {
                    kepsekBellList.innerHTML = '<div style="padding:32px 16px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada aktivitas.</div>';
                    kepsekBellBadge.style.display = 'none';
                    return;
                }
                var unread = logs.filter(function(l){ return !readIds.includes(l.id); }).length;
                if (unread > 0) {
                    kepsekBellBadge.textContent = unread > 9 ? '9+' : unread;
                    kepsekBellBadge.style.display = 'flex';
                } else {
                    kepsekBellBadge.style.display = 'none';
                }
                kepsekBellList.innerHTML = logs.map(function(log) {
                    var isRead = readIds.includes(log.id);
                    return '<div onclick="kepsekMarkRead(' + log.id + ')" style="padding:12px 16px; border-bottom:1px solid #f8fafc; display:flex; gap:10px; cursor:pointer; background:' + (isRead ? '#fff' : '#eff6ff') + ';">'
                        + '<div style="width:8px; height:8px; border-radius:50%; background:' + (isRead ? 'transparent' : '#2563eb') + '; flex-shrink:0; margin-top:5px;"></div>'
                        + '<div style="flex:1; min-width:0;">'
                        + '<span style="background:#eff6ff; color:#2563eb; font-size:10px; font-weight:800; padding:2px 7px; border-radius:6px; text-transform:uppercase;">' + kepsekRoleLabel(log.role) + '</span>'
                        + '<div style="font-size:12px; font-weight:600; color:#334155; margin-top:3px; line-height:1.4;">' + log.activity + '</div>'
                        + '<div style="font-size:11px; color:#94a3b8; margin-top:2px;">oleh ' + log.nama_user + '</div>'
                        + '<div style="font-size:10px; color:#cbd5e1; margin-top:2px;">' + kepsekTimeAgo(log.created_at) + '</div>'
                        + '</div></div>';
                }).join('');
            })
            .catch(function() {
                kepsekBellList.innerHTML = '<div style="padding:32px 16px; text-align:center; color:#94a3b8; font-size:13px;">Gagal memuat aktivitas.</div>';
            });
    }

    function kepsekMarkRead(id) {
        var ids = getReadIds();
        if (!ids.includes(id)) { ids.push(id); saveReadIds(ids); kepsekLoadBellLogs(); }
    }

    function kepsekMarkAllRead() {
        fetch('{{ route("log.activities") }}')
            .then(function(r) { return r.json(); })
            .then(function(logs) { saveReadIds(logs.map(function(l){ return l.id; })); kepsekLoadBellLogs(); });
    }

    // Auto load badge
    window.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route("log.activities") }}')
            .then(function(r) { return r.json(); })
            .then(function(logs) {
                var unread = logs.filter(function(l){ return !getReadIds().includes(l.id); }).length;
                if (unread > 0) {
                    kepsekBellBadge.textContent = unread > 9 ? '9+' : unread;
                    kepsekBellBadge.style.display = 'flex';
                }
            });
    });
</script>

        <div class="da-body">
            {{-- FILTER --}}
            <form method="GET" action="{{ route('kepsek.dashboard') }}" class="filter-box">
                <div style="display:flex; align-items:center; gap:12px">
                    <span style="font-size:12px; font-weight:800; color:var(--gray-400); text-transform:uppercase;">Periode:</span>
                    <select name="id_periode" class="f-select">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periodes as $p)
                            <option value="{{ $p->id_periode }}" {{ (string) $idPeriode === (string) $p->id_periode ? 'selected' : '' }}>
                                {{ $p->tahun_ajaran }} - Semester {{ $p->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-primary">Tampilkan Data</button>
            </form>

            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-lbl">Siswa Dianalisis</div>
                    <div class="stat-val">{{ $totalSiswa }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-lbl" style="color:#ef4444">Risiko Tinggi</div>
                    <div class="stat-val" style="color:#ef4444">{{ $jumlahTinggi }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-lbl" style="color:#f59e0b">Risiko Sedang</div>
                    <div class="stat-val" style="color:#f59e0b">{{ $jumlahSedang }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-lbl" style="color:#10b981">Risiko Rendah</div>
                    <div class="stat-val" style="color:#10b981">{{ $jumlahRendah }}</div>
                </div>
            </div>

            <div class="grid-dashboard">
                <div class="card">
                    <div class="card-title">Distribusi Risiko (Sekolah)</div>
                    <div style="display:flex; justify-content:center;">
                        <canvas id="chartRisiko"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Faktor Dominan</div>
                    <div class="space-y-4">
                        <div style="background:var(--gray-50); border-radius:14px; padding:16px; border:1px solid var(--gray-100)">
                            <p style="font-size:11px; font-weight:700; color:var(--gray-400); text-transform:uppercase;">Penyebab Utama</p>
                            <p style="font-size:16px; font-weight:800; color:var(--blue); margin-top:4px;">{{ $faktorDominanTerbanyak ?? '-' }}</p>
                        </div>
                        <div style="background:var(--gray-50); border-radius:14px; padding:16px; border:1px solid var(--gray-100)">
                            <p style="font-size:11px; font-weight:700; color:var(--gray-400); text-transform:uppercase;">Periode Aktif</p>
                            <p style="font-size:14px; font-weight:700; color:var(--gray-800); margin-top:4px;">
                                @if($periode) {{ $periode->tahun_ajaran }} - Smstr {{ $periode->semester }} @else - @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
            <div class="card-title">Top 5 Siswa Risiko Tinggi</div>

                @if($topSiswaTinggi->count() > 0)
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse: collapse; font-size:13px;">
                            <thead>
                                <tr style="background:#f9fafb; text-align:left;">
                                    <th style="padding:10px;">No</th>
                                    <th style="padding:10px;">Nama Siswa</th>
                                    <th style="padding:10px;">Kelas</th>
                                    <th style="padding:10px;">Nilai Preferensi</th>
                                    <th style="padding:10px;">Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topSiswaTinggi as $index => $item)
                                    <tr style="border-top:1px solid #e5e7eb;">
                                        <td style="padding:10px;">{{ $index + 1 }}</td>

                                        <td style="padding:10px; font-weight:600;">
                                            {{ $item->siswa->nama_siswa ?? 'Tidak ada data' }}
                                        </td>

                                        <td style="padding:10px;">
                                            {{ $item->siswa->kelas->nama_kelas ?? '-' }}
                                        </td>

                                        <td style="padding:10px; color:#ef4444; font-weight:700;">
                                            {{ number_format($item->total_nilai_preferensi, 4) }}
                                        </td>

                                        {{-- ✅ TAMBAHAN KATEGORI --}}
                                        <td style="padding:10px;">
                                            <span style="
                                                background:#fee2e2;
                                                color:#b91c1c;
                                                padding:4px 10px;
                                                border-radius:8px;
                                                font-size:11px;
                                                font-weight:700;">
                                                {{ $item->kategori_risiko }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="text-align:center; color:#9ca3af; font-size:13px;">
                        Tidak ada siswa dengan risiko tinggi.
                    </p>
                @endif
            </div>

<div class="card">
    <div class="card-title">Kelas dengan Risiko Tertinggi</div>

    <canvas id="chartKelas"></canvas>
</div>



 <div class="card">
                <div class="card-title">Status Rekomendasi per Kelas</div>
                <div class="kelas-grid">
                    @forelse($statusPerKelas as $item)
                        <div class="kelas-card">
                            <div style="display:flex; justify-content:space-between; margin-bottom:12px">
                                <h4 style="font-weight:800; color:var(--gray-900)">{{ $item->nama_kelas }}</h4>
                                <span style="font-size:11px; font-weight:700; color:var(--gray-400)">Total: {{ $item->total }}</span>
                            </div>
                            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:8px;">
                                <div class="prog-item" style="background:var(--gray-50); color:var(--gray-600)">
                                    <div style="font-size:16px; font-weight:800">{{ $item->belum }}</div>
                                    <div style="font-size:9px; font-weight:700; text-transform:uppercase">Belum</div>
                                </div>
                                <div class="prog-item" style="background:#fffbeb; color:#d97706">
                                    <div style="font-size:16px; font-weight:800">{{ $item->proses }}</div>
                                    <div style="font-size:9px; font-weight:700; text-transform:uppercase">Proses</div>
                                </div>
                                <div class="prog-item" style="background:#ecfdf5; color:#10b981">
                                    <div style="font-size:16px; font-weight:800">{{ $item->selesai }}</div>
                                    <div style="font-size:9px; font-weight:700; text-transform:uppercase">Selesai</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="grid-column: span 2; text-align:center; padding:20px; color:var(--gray-400); font-size:13px;">Belum ada data progres kelas.</p>
                    @endforelse
                </div>  {{-- ← TUTUP kelas-grid DULU --}}
            </div>      {{-- ← TUTUP card status rekomendasi --}}

            {{-- 📋 LOG ACTIVITY — di luar card sebelumnya --}}
            <div class="card" style="margin-top:24px;">
                <div class="card-title">Aktivitas Terbaru</div>
                <div id="dashLogList">
                    <p style="text-align:center; color:#94a3b8; font-size:13px;">Memuat aktivitas...</p>
                </div>
            </div>

            <script>
                fetch('{{ route("log.activities") }}')
                    .then(r => r.json())
                    .then(logs => {
                        const el = document.getElementById('dashLogList');
                        if (!logs.length) {
                            el.innerHTML = '<p style="text-align:center; color:#94a3b8; font-size:13px;">Belum ada aktivitas.</p>';
                            return;
                        }
                        el.innerHTML = `
                            <table style="width:100%; border-collapse:collapse; font-size:13px;">
                                <thead>
                                    <tr style="background:#f9fafb; text-align:left;">
                                        <th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">User</th>
                                        <th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">Role</th>
                                        <th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">Aktivitas</th>
                                        <th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${logs.map(log => `
                                        <tr style="border-top:1px solid #f1f5f9;">
                                            <td style="padding:10px; font-weight:700; color:#1e293b;">${log.nama_user}</td>
                                            <td style="padding:10px;">
                                                <span style="background:#eff6ff; color:#2563eb; font-size:10px; font-weight:700; padding:3px 8px; border-radius:6px; text-transform:uppercase;">
                                                    ${log.role === 'wali_kelas' ? 'Wali Kelas' : log.role === 'kepsek' ? 'Kepsek' : 'Admin'}
                                                </span>
                                            </td>
                                            <td style="padding:10px; color:#475569;">${log.activity}</td>
                                            <td style="padding:10px; color:#94a3b8; font-size:11px; white-space:nowrap;">${new Date(log.created_at).toLocaleString('id-ID')}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>`;
                    });
            </script>
            </div>
        </div>
    </main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('date-indo').textContent = new Date().toLocaleDateString('id-ID', options);

    const ctx = document.getElementById('chartRisiko').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Tinggi', 'Sedang', 'Rendah'],
            datasets: [{
                data: [{{ $jumlahTinggi }}, {{ $jumlahSedang }}, {{ $jumlahRendah }}],
                backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12, padding: 20, font: { size: 11, weight: '600' } }
                }
            }
        }
    });
</script>

<script>
    const dataKelas = @json($risikoPerKelas);

    const labelsKelas = dataKelas.map(item => item.nama_kelas);
    const dataJumlah = dataKelas.map(item => item.total_risiko_tinggi);

    const ctxKelas = document.getElementById('chartKelas');

    if (ctxKelas) {
        new Chart(ctxKelas, {
            type: 'bar',
            data: {
                labels: labelsKelas,
                datasets: [{
                    label: 'Jumlah Risiko Tinggi',
                    data: dataJumlah,
                    backgroundColor: '#ef4444'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
</x-app-layout>