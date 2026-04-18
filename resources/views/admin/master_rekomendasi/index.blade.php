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

nav[x-data] { display: none !important; }
header { display: none !important; }

.da-root {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--gray-50);
    color: var(--gray-800);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
}

/* ── SIDEBAR ── */
.da-shell { display: flex; min-height: 100vh; }
.da-sidebar {
    width: var(--sidebar-w);
    background: var(--white);
    border-right: 1px solid var(--gray-200);
    position: fixed; top: 0; left: 0; bottom: 0;
    z-index: 40; display: flex; flex-direction: column; overflow: hidden;
}
.sb-brand {
    padding: 18px 16px 14px;
    display: flex; align-items: center; gap: 10px;
    border-bottom: 1px solid var(--gray-100); flex-shrink: 0;
}
.sb-logo {
    width: 36px; height: 36px; border-radius: 9px;
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(37,99,235,.25);
}
.sb-brand-name { font-size: 13px; font-weight: 800; color: var(--gray-900); line-height: 1.2; }
.sb-brand-sub  { font-size: 10px; color: var(--gray-400); font-weight: 500; margin-top: 1px; }
.sb-nav { padding: 12px 10px; flex: 1; overflow-y: auto; min-height: 0; }
.sb-nav-section {
    font-size: 9.5px; font-weight: 700; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.1em;
    padding: 0 8px; margin: 14px 0 5px;
}
.sb-item {
    display: flex; align-items: center; gap: 9px;
    padding: 8px 10px; border-radius: 8px;
    text-decoration: none; font-size: 12.5px; font-weight: 600;
    color: var(--gray-500); transition: all .13s; margin-bottom: 1px;
}
.sb-item:hover { background: var(--gray-100); color: var(--gray-800); }
.sb-item.active { background: var(--blue-lt); color: var(--blue); }
.sb-item svg { flex-shrink: 0; }
.sb-user {
    padding: 12px 14px; border-top: 1px solid var(--gray-100);
    display: flex; align-items: center; gap: 9px;
    flex-shrink: 0; background: var(--white);
}
.sb-user-av {
    width: 30px; height: 30px; border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #38bdf8);
    color: white; font-size: 11px; font-weight: 800;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.sb-user-name { font-size: 12px; font-weight: 700; color: var(--gray-800); line-height: 1.2; }
.sb-user-role { font-size: 10.5px; color: var(--gray-400); font-weight: 500; }
.sb-action-btn {
    background: none; border: none; cursor: pointer;
    padding: 5px; color: var(--gray-400); border-radius: 6px;
    transition: all .13s; display: flex; align-items: center;
    text-decoration: none; flex-shrink: 0;
}
.sb-action-btn:hover { background: var(--gray-100); color: var(--gray-700); }
.sb-action-logout:hover { background: #fee2e2; color: var(--red); }

/* ── MAIN ── */
.da-main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-width: 0; }

.da-phead {
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
    padding: 20px 28px;
    display: flex; align-items: center; justify-content: space-between;
}
.da-phead-title { font-size: 20px; font-weight: 800; color: var(--gray-900); letter-spacing: -0.4px; }
.da-phead-sub   { font-size: 12px; color: var(--gray-400); font-weight: 500; margin-top: 2px; }

/* Tambah btn */
.btn-add {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 16px; border-radius: 9px;
    background: var(--blue); color: var(--white);
    font-size: 13px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-decoration: none; border: none; cursor: pointer;
    transition: all .15s; white-space: nowrap;
}
.btn-add:hover { background: #1d4ed8; box-shadow: 0 3px 10px rgba(37,99,235,.25); }

/* ── CONTENT ── */
.da-content { padding: 24px 28px; display: flex; flex-direction: column; gap: 16px; }

/* Alert */
.alert-success {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 16px;
    background: var(--green-lt); border: 1.5px solid var(--green-bd);
    border-radius: 10px;
    font-size: 13px; font-weight: 600; color: var(--green-dk);
}

/* Table card */
.table-card {
    background: var(--white);
    border: 1.5px solid var(--gray-200);
    border-radius: 14px; overflow: hidden;
}
.table-card-head {
    padding: 14px 20px;
    border-bottom: 1px solid var(--gray-100);
    display: flex; align-items: center; justify-content: space-between;
}
.table-card-title { font-size: 13px; font-weight: 800; color: var(--gray-900); }
.table-card-count {
    font-size: 11px; font-weight: 600; color: var(--gray-400);
    background: var(--gray-100); padding: 2px 9px; border-radius: 99px;
}

/* Table */
.spk-table { width: 100%; border-collapse: collapse; }
.spk-table thead tr { background: var(--gray-50); border-bottom: 1px solid var(--gray-200); }
.spk-table th {
    padding: 10px 20px;
    font-size: 10.5px; font-weight: 700; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.07em;
    text-align: left; white-space: nowrap;
}
.spk-table th.center { text-align: center; }
.spk-table td {
    padding: 13px 20px;
    font-size: 13px; font-weight: 500; color: var(--gray-700);
    border-bottom: 1px solid var(--gray-100);
    vertical-align: middle;
}
.spk-table tbody tr:last-child td { border-bottom: none; }
.spk-table tbody tr { transition: background .1s; }
.spk-table tbody tr:hover { background: var(--gray-50); }

/* Badge risiko */
.badge-risiko {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 10px; border-radius: 99px;
    font-size: 11px; font-weight: 700; white-space: nowrap;
}
.badge-tinggi  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.badge-sedang  { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
.badge-rendah  { background: var(--green-lt); color: var(--green-dk); border: 1px solid var(--green-bd); }

/* Badge status */
.badge-aktif {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 10.5px; font-weight: 700; color: var(--green-dk);
    background: var(--green-lt); border: 1px solid var(--green-bd);
    padding: 3px 9px; border-radius: 99px;
}
.badge-aktif::before {
    content: ''; width: 5px; height: 5px; border-radius: 50%;
    background: var(--green-dk); animation: blink 2s ease-in-out infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }
.badge-nonaktif {
    font-size: 10.5px; font-weight: 700; color: var(--gray-400);
    background: var(--gray-100); border: 1px solid var(--gray-200);
    padding: 3px 9px; border-radius: 99px;
}

/* Deskripsi truncate */
.td-desc {
    max-width: 300px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    color: var(--gray-500);
}

/* Action buttons */
.td-actions { display: flex; align-items: center; justify-content: center; gap: 6px; }
.act-btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px; border-radius: 7px;
    font-size: 11.5px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-decoration: none; border: none; cursor: pointer;
    transition: all .13s;
}
.act-edit {
    color: var(--blue); background: var(--blue-lt);
    border: 1px solid var(--blue-mid);
}
.act-edit:hover { background: var(--blue-mid); }
.act-delete {
    color: var(--red); background: var(--red-lt);
    border: 1px solid var(--red-bd);
}
.act-delete:hover { background: #fee2e2; }

/* Empty */
.spk-empty {
    text-align: center; padding: 40px 20px;
    font-size: 13px; color: var(--gray-400); font-style: italic;
}
</style>

<div class="da-root" id="spk-admin-dash">
<div class="da-shell">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="da-sidebar">
        <div class="sb-brand">
            <div class="sb-logo">
                <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <div>
                <div class="sb-brand-name">SPK Putus Sekolah</div>
                <div class="sb-brand-sub">SDN 11 Kampung Batu</div>
            </div>
        </div>

        <div class="sb-nav">
            <div class="sb-nav-section">Menu</div>
            <a href="{{ route('dashboard') }}" class="sb-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="sb-nav-section">Manajemen</div>
            <a href="{{ route('admin.user.index') }}" class="sb-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Manajemen User
            </a>
            <a href="{{ route('admin.kelas.index') }}" class="sb-item {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Data Kelas
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="sb-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Data Siswa
            </a>
            <a href="{{ route('admin.mapel.index') }}" class="sb-item {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Mata Pelajaran
            </a>

            <div class="sb-nav-section">SPK</div>
            <a href="{{ route('admin.kriteria.index') }}" class="sb-item {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Data Kriteria
            </a>
            <a href="{{ route('admin.subkriteria.index') }}" class="sb-item {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg>
                Data Subkriteria
            </a>
            <a href="{{ route('admin.periode.index') }}" class="sb-item {{ request()->routeIs('admin.periode.*') ? 'active' : '' }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Periode Penilaian
            </a>
            <a href="{{ route('admin.master-rekomendasi.index') }}" class="sb-item active">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Rekomendasi
            </a>
        </div>

        <div class="sb-user">
            <div class="sb-user-av">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div style="min-width:0; flex:1">
                <div class="sb-user-name">{{ Auth::user()->name }}</div>
                <div class="sb-user-role">Administrator</div>
            </div>
            <div style="display:flex; align-items:center; gap:4px; flex-shrink:0;">
                <a href="{{ route('profile.edit') }}" class="sb-action-btn" title="Profil">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="sb-action-btn sb-action-logout" title="Log Out">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ══ MAIN ══ --}}
    <main class="da-main">

        {{-- Page Header --}}
        <div class="da-phead">
            <div>
                <div class="da-phead-title">Master Rekomendasi</div>
                <div class="da-phead-sub">Kelola daftar rekomendasi tindak lanjut berdasarkan kategori risiko dan faktor dominan</div>
            </div>
            <a href="{{ route('admin.master-rekomendasi.create') }}" class="btn-add">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Rekomendasi
            </a>
        </div>

        {{-- Content --}}
        <div class="da-content">

            

            {{-- Table --}}
            <div class="table-card">
                <div class="table-card-head">
                    <span class="table-card-title">Daftar Rekomendasi</span>
                    <span class="table-card-count">{{ $masterRekomendasi->count() }} data</span>
                </div>

                <div style="overflow-x:auto;">
                    <table class="spk-table">
                        <thead>
                            <tr>
                                <th>Kategori Risiko</th>
                                <th>Faktor Dominan</th>
                                <th>Deskripsi Rekomendasi</th>
                                <th>Status</th>
                                <th class="center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($masterRekomendasi as $item)
                                <tr>
                                    <td>
                                        @php
                                            $kat = strtolower($item->kategori_risiko);
                                        @endphp
                                        <span class="badge-risiko {{ $kat === 'tinggi' ? 'badge-tinggi' : ($kat === 'sedang' ? 'badge-sedang' : 'badge-rendah') }}">
                                            {{ $item->kategori_risiko }}
                                        </span>
                                    </td>
                                    <td style="font-weight:600; color:var(--gray-800);">
                                        {{ $item->faktor_dominan }}
                                    </td>
                                    <td class="td-desc" title="{{ $item->deskripsi_rekomendasi }}">
                                        {{ $item->deskripsi_rekomendasi }}
                                    </td>
                                    <td>
                                        @if($item->is_active)
                                            <span class="badge-aktif">Aktif</span>
                                        @else
                                            <span class="badge-nonaktif">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="td-actions">
                                            <a href="{{ route('admin.master-rekomendasi.edit', $item->id_master_rekomendasi) }}" class="act-btn act-edit">
                                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.master-rekomendasi.destroy', $item->id_master_rekomendasi) }}" method="POST" style="margin:0"
                                                onsubmit="return confirm('Hapus rekomendasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="act-btn act-delete">
                                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="spk-empty">Belum ada data rekomendasi</td>
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

</x-app-layout>