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

    .da-root {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--gray-50); color: var(--gray-800);
    height: 100vh;
}

    .da-shell { display: flex; height: 100vh; }

    .da-sidebar {
        width: var(--sidebar-w); background: var(--white); border-right: 1px solid var(--gray-200);
        display: flex; flex-direction: column; flex-shrink: 0;
    }
    .sb-brand { padding: 24px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid var(--gray-100); }
    .sb-logo { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #1d4ed8, #2563eb); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(37,99,235,.2); flex-shrink: 0; }
    .sb-brand-name { font-size: 14px; font-weight: 800; color: var(--gray-900); line-height: 1.2; letter-spacing: -0.2px; }

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
    .sb-user-av { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #2563eb, #38bdf8); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
    .sb-user-info { flex: 1; min-width: 0; }
    .sb-user-name { font-size: 13px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 2px; }
    .sb-user-role { font-size: 11px; color: var(--gray-400); font-weight: 500; }
    
    .sb-actions { display: flex; align-items: center; gap: 4px; }
    .sb-btn { 
        background: transparent; border: none; cursor: pointer; padding: 6px; 
        color: var(--gray-400); border-radius: 8px; transition: .15s; 
        display: flex; align-items: center; justify-content: center;
    }
    .sb-btn:hover { background: var(--gray-100); color: var(--gray-800); }
    .sb-btn-logout:hover { background: #fee2e2; color: #ef4444; }

    .da-main { flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh; overflow-y: auto; position: relative; }
    .da-phead { background: var(--white); border-bottom: 1px solid var(--gray-200); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; position: sticky; top: 0; z-index: 50; }
    .da-stats { display: grid; grid-template-columns: repeat(6, 1fr); background: var(--white); border-bottom: 1px solid var(--gray-200); flex-shrink: 0; }
    .da-stat { padding: 16px 24px; border-right: 1px solid var(--gray-200); }
    .da-stat-lbl { font-size: 9px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-bottom: 4px; }
    .da-stat-num { font-size: 22px; font-weight: 800; color: var(--gray-900); letter-spacing: -0.5px; }

    .da-body { padding: 24px 32px; display: grid; grid-template-columns: 1.8fr 1fr; gap: 24px; }
    .card { background: var(--white); border: 1.5px solid var(--gray-200); border-radius: 20px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column; }
    .card-title { font-size: 14px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
    .card-title::before { content: ''; width: 4px; height: 14px; background: var(--blue); border-radius: 4px; }
    .chart-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; }
    .stu-list { overflow-y: auto; flex: 1; }
    .stu-row { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid var(--gray-100); }
    .stu-row:last-child { border-bottom: none; }
    .stu-av { width: 32px; height: 32px; border-radius: 50%; background: #eff6ff; color: var(--blue); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; }

    /* Bell */
    .bell-wrap { position: relative; display: inline-flex; }
    .bell-btn { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b; transition: .15s; }
    .bell-btn:hover { background: #eff6ff; border-color: #93c5fd; color: #2563eb; }
    .bell-badge { display: none; position: absolute; top: -4px; right: -4px; background: #ef4444; color: white; font-size: 10px; font-weight: 700; border-radius: 999px; min-width: 18px; height: 18px; align-items: center; justify-content: center; padding: 0 4px; border: 2px solid white; }
    .bell-panel { display: none; position: absolute; right: 0; top: calc(100% + 10px); width: 360px; background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 12px 32px rgba(0,0,0,0.12); z-index: 999; overflow: hidden; }
    .bell-panel.show { display: block; }

</style>

<div class="da-root">
<div class="da-shell">
    
    <aside class="da-sidebar">
        <div class="sb-brand">
            <div class="sb-logo"><svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg></div>
            <div class="sb-brand-name">SPK Putus Sekolah</div>
        </div>

        <div class="sb-nav">
            <div class="sb-nav-section">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="sb-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dashboard
            </a>

            <div class="sb-nav-section">Manajemen</div>
            <a href="{{ route('admin.user.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>Data User</a>
            <a href="{{ route('admin.kelas.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>Data Kelas</a>
            <a href="{{ route('admin.siswa.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>Data Siswa</a>
            <a href="{{ route('admin.mapel.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>Mapel</a>

            <div class="sb-nav-section">Sistem SPK</div>
            <a href="{{ route('admin.kriteria.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>Kriteria</a>
            <a href="{{ route('admin.subkriteria.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg>Subkriteria</a>
            <a href="{{ route('admin.periode.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Periode</a>
            <a href="{{ route('admin.master-rekomendasi.index') }}" class="sb-item"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>Rekomendasi</a>
        </div>

        <div class="sb-user">
            <div class="sb-user-av">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="sb-user-info">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Administrator</div>
            </div>
            <div class="sb-actions">
                <a href="{{ route('profile.edit') }}" class="sb-btn" title="Profil">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="sb-btn sb-btn-logout" title="Keluar">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="da-main">
        <div class="da-phead">
            <h2 style="font-size:18px; font-weight:800; letter-spacing:-0.5px;">Statistik Dashboard</h2>
            <div style="display:flex; align-items:center; gap:12px;">
                <div style="font-size:10px; font-weight:700; color:var(--gray-500); background:var(--gray-100); padding:7px 14px; border-radius:10px;" id="date"></div>

              {{-- 🔔 BELL --}}
<div class="bell-wrap" id="adminBellWrap">
    <button class="bell-btn" id="adminBellBtn">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <span class="bell-badge" id="adminBellBadge"></span>
    </button>
    <div class="bell-panel" id="adminBellPanel">
        <div style="padding:14px 16px; border-bottom:1px solid #f1f5f9; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:13px; font-weight:800; color:#1e293b;">🔔 Aktivitas Terbaru</span>
            <button id="adminMarkAllBtn" style="font-size:11px; font-weight:600; color:#2563eb; background:none; border:none; cursor:pointer;">Tandai semua dibaca</button>
        </div>
        <div id="adminBellList" style="max-height:320px; overflow-y:auto;">
            <div style="padding:32px 16px; text-align:center; color:#94a3b8; font-size:13px;">Memuat aktivitas...</div>
        </div>
    </div>
</div>
                
            </div>
        </div>

        <div class="da-stats">
            <div class="da-stat"><div class="da-stat-lbl">User</div><div class="da-stat-num">{{ $totalUsers }}</div></div>
            <div class="da-stat"><div class="da-stat-lbl">Kriteria</div><div class="da-stat-num">{{ $totalKriteria }}</div></div>
            <div class="da-stat"><div class="da-stat-lbl">Subkriteria</div><div class="da-stat-num">{{ $totalSubkriteria }}</div></div>
            <div class="da-stat"><div class="da-stat-lbl">Siswa</div><div class="da-stat-num" style="color:var(--blue)">{{ $totalSiswa }}</div></div>
            <div class="da-stat"><div class="da-stat-lbl">Kelas</div><div class="da-stat-num">{{ $totalKelas }}</div></div>
            <div class="da-stat" style="border:none"><div class="da-stat-lbl">Periode</div><div class="da-stat-num">{{ $totalPeriode }}</div></div>
        </div>

        <div class="da-body">
            <div>
                <div class="card">
                    <div class="card-title">Sebaran Subkriteria per Kriteria</div>
                    <canvas id="kriteriaChart" style="max-height: 180px;"></canvas>
                </div>
                <div class="chart-grid">
                    <div class="card"><div class="card-title">Komposisi Akun</div><canvas id="userChart" style="max-height: 140px;"></canvas></div>
                    <div class="card"><div class="card-title">Status Periode</div><canvas id="periodeChart" style="max-height: 140px;"></canvas></div>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Siswa Baru</div>
                <div class="stu-list">
                    @foreach($siswaTerbaru as $s)
                    <div class="stu-row">
                        <div class="stu-av">{{ substr($s->nama_siswa, 0, 1) }}</div>
                        <div style="min-width:0; flex:1">
                            <div style="font-size:12px; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--gray-900);">{{ $s->nama_siswa }}</div>
                            <div style="font-size:10px; color:var(--gray-400);">{{ $s->nisn }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 📋 TABEL AKTIVITAS TERBARU --}}
        <div style="padding: 0 32px 32px;">
            <div class="card" style="margin-top:0;">
                <div class="card-title">Aktivitas Terbaru</div>
                <div id="adminDashLogList">
                    <p style="text-align:center; color:#94a3b8; font-size:13px;">Memuat aktivitas...</p>
                </div>
            </div>
        </div>

    </main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('date').textContent = new Date().toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
    new Chart(document.getElementById('kriteriaChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelsKriteria) !!},
            datasets: [{ label: 'Subkriteria', data: {!! json_encode($countSubkriteria) !!}, backgroundColor: '#2563eb', borderRadius: 6, barThickness: 20 }]
        },
        options: { plugins:{legend:{display:false}}, scales:{ y:{beginAtZero:true, ticks:{stepSize:1, font:{size:10}}}, x:{ticks:{font:{size:10}}} } }
    });
    new Chart(document.getElementById('userChart'), {
        type: 'doughnut',
        data: {
            labels: ['Admin', 'Wali Kelas', 'Kepsek'],
            datasets: [{ data: {!! json_encode($dataUserRoles) !!}, backgroundColor: ['#2563eb', '#38bdf8', '#cbd5e1'], borderWidth: 0 }]
        },
        options: { cutout:'75%', plugins:{ legend:{position:'bottom', labels:{boxWidth:8, font:{size:9, weight:'600'}}} } }
    });
    new Chart(document.getElementById('periodeChart'), {
        type: 'pie',
        data: {
            labels: ['Aktif', 'Nonaktif'],
            datasets: [{ data: {!! json_encode($dataPeriodeStatus) !!}, backgroundColor: ['#10b981', '#f59e0b'], borderWidth: 0 }]
        },
        options: { plugins:{ legend:{position:'bottom', labels:{boxWidth:8, font:{size:9, weight:'600'}}} } }
    });
</script>

<script>
    var adminBellBtn    = document.getElementById('adminBellBtn');
    var adminBellPanel  = document.getElementById('adminBellPanel');
    var adminBellBadge  = document.getElementById('adminBellBadge');
    var adminBellList   = document.getElementById('adminBellList');

    function getReadIds() { return JSON.parse(localStorage.getItem('spk_read_logs') || '[]'); }
    function saveReadIds(ids) { localStorage.setItem('spk_read_logs', JSON.stringify(ids)); }

    adminBellBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        var isOpen = adminBellPanel.style.display === 'block';
        adminBellPanel.style.display = isOpen ? 'none' : 'block';
        if (!isOpen) loadBellLogs();
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('adminBellWrap').contains(e.target)) {
            adminBellPanel.style.display = 'none';
        }
    });

    document.getElementById('adminMarkAllBtn').addEventListener('click', function() {
        fetch('{{ route("log.activities") }}')
            .then(r => r.json())
            .then(logs => { saveReadIds(logs.map(l => l.id)); loadBellLogs(); });
    });

    function timeAgo(dateStr) {
        var diff = Math.floor((new Date() - new Date(dateStr)) / 1000);
        if (diff < 60) return diff + ' detik lalu';
        if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
        return Math.floor(diff / 86400) + ' hari lalu';
    }

    function roleLabel(role) {
        if (role === 'wali_kelas') return 'Wali Kelas';
        if (role === 'kepsek') return 'Kepsek';
        return 'Admin';
    }

    function loadBellLogs() {
        fetch('{{ route("log.activities") }}')
            .then(r => r.json())
            .then(logs => {
                var readIds = getReadIds();
                if (!logs.length) {
                    adminBellList.innerHTML = '<div style="padding:32px 16px; text-align:center; color:#94a3b8; font-size:13px;">Belum ada aktivitas.</div>';
                    adminBellBadge.style.display = 'none';
                    return;
                }
                var unread = logs.filter(function(l){ return !readIds.includes(l.id); }).length;
                if (unread > 0) {
                    adminBellBadge.textContent = unread > 9 ? '9+' : unread;
                    adminBellBadge.style.display = 'flex';
                } else {
                    adminBellBadge.style.display = 'none';
                }
                adminBellList.innerHTML = logs.map(function(log) {
                    var isRead = readIds.includes(log.id);
                    return '<div onclick="adminMarkRead(' + log.id + ')" style="padding:12px 16px; border-bottom:1px solid #f8fafc; display:flex; gap:10px; cursor:pointer; background:' + (isRead ? '#fff' : '#eff6ff') + ';">'
                        + '<div style="width:8px; height:8px; border-radius:50%; background:' + (isRead ? 'transparent' : '#2563eb') + '; flex-shrink:0; margin-top:5px;"></div>'
                        + '<div style="flex:1; min-width:0;">'
                        + '<span style="background:#eff6ff; color:#2563eb; font-size:10px; font-weight:800; padding:2px 7px; border-radius:6px; text-transform:uppercase;">' + roleLabel(log.role) + '</span>'
                        + '<div style="font-size:12px; font-weight:600; color:#334155; margin-top:3px; line-height:1.4;">' + log.activity + '</div>'
                        + '<div style="font-size:11px; color:#94a3b8; margin-top:2px;">oleh ' + log.nama_user + '</div>'
                        + '<div style="font-size:10px; color:#cbd5e1; margin-top:2px;">' + timeAgo(log.created_at) + '</div>'
                        + '</div></div>';
                }).join('');
            })
            .catch(function() {
                adminBellList.innerHTML = '<div style="padding:32px 16px; text-align:center; color:#94a3b8; font-size:13px;">Gagal memuat aktivitas.</div>';
            });
    }

    function adminMarkRead(id) {
        var ids = getReadIds();
        if (!ids.includes(id)) { ids.push(id); saveReadIds(ids); loadBellLogs(); }
    }

    // Auto load badge saat halaman buka
    fetch('{{ route("log.activities") }}')
        .then(r => r.json())
        .then(logs => {
            var unread = logs.filter(function(l){ return !getReadIds().includes(l.id); }).length;
            if (unread > 0) {
                adminBellBadge.textContent = unread > 9 ? '9+' : unread;
                adminBellBadge.style.display = 'flex';
            }
        });
</script>

<script>
    fetch('{{ route("log.activities") }}')
        .then(function(r) { return r.json(); })
        .then(function(logs) {
            var el = document.getElementById('adminDashLogList');
            if (!logs.length) {
                el.innerHTML = '<p style="text-align:center; color:#94a3b8; font-size:13px;">Belum ada aktivitas.</p>';
                return;
            }
            var rows = logs.map(function(log) {
                var roleText = log.role === 'wali_kelas' ? 'Wali Kelas' : log.role === 'kepsek' ? 'Kepsek' : 'Admin';
                return '<tr style="border-top:1px solid #f1f5f9;">'
                    + '<td style="padding:10px; font-weight:700; color:#1e293b;">' + log.nama_user + '</td>'
                    + '<td style="padding:10px;"><span style="background:#eff6ff; color:#2563eb; font-size:10px; font-weight:700; padding:3px 8px; border-radius:6px; text-transform:uppercase;">' + roleText + '</span></td>'
                    + '<td style="padding:10px; color:#475569;">' + log.activity + '</td>'
                    + '<td style="padding:10px; color:#94a3b8; font-size:11px; white-space:nowrap;">' + new Date(log.created_at).toLocaleString('id-ID') + '</td>'
                    + '</tr>';
            }).join('');
            el.innerHTML = '<div style="overflow-x:auto;">'
                + '<table style="width:100%; border-collapse:collapse; font-size:13px;">'
                + '<thead><tr style="background:#f9fafb; text-align:left;">'
                + '<th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">User</th>'
                + '<th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">Role</th>'
                + '<th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">Aktivitas</th>'
                + '<th style="padding:10px; font-size:11px; color:#64748b; text-transform:uppercase;">Waktu</th>'
                + '</tr></thead>'
                + '<tbody>' + rows + '</tbody>'
                + '</table></div>';
        });
</script>
</x-app-layout>