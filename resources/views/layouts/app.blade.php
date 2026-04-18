<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── MODAL KONFIRMASI HAPUS GLOBAL ── */
        #delete-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
        }
        #delete-modal-overlay.open {
            display: flex;
        }
        #delete-modal-box {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif;
            animation: modalIn .2s ease;
        }
        @keyframes modalIn {
            from { opacity:0; transform: scale(0.95) translateY(10px); }
            to   { opacity:1; transform: scale(1) translateY(0); }
        }
        #delete-modal-icon {
            width: 52px; height: 52px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        #delete-modal-title {
            font-size: 17px; font-weight: 800;
            color: #111827; text-align: center; margin-bottom: 8px;
        }
        #delete-modal-desc {
            font-size: 13px; color: #6b7280;
            text-align: center; line-height: 1.6; margin-bottom: 24px;
        }
        #delete-modal-desc strong { color: #111827; }
        .delete-modal-actions {
            display: flex; gap: 10px;
        }
        .delete-modal-actions button {
            flex: 1; padding: 11px;
            border-radius: 10px; font-size: 13px; font-weight: 700;
            cursor: pointer; border: none; font-family: inherit; transition: .15s;
        }
        #delete-modal-cancel {
            background: #f3f4f6; color: #374151;
        }
        #delete-modal-cancel:hover { background: #e5e7eb; }
        #delete-modal-confirm {
            background: #ef4444; color: white;
        }
        #delete-modal-confirm:hover { background: #dc2626; box-shadow: 0 3px 10px rgba(239,68,68,.3); }
    </style>
</head>
<body class="font-sans antialiased" style="background:#f1f5f9; color:#1e293b; margin:0; padding:0;">
    <div style="min-height:100vh;">

        @include('layouts.navigation')

{{-- ── FLASH MESSAGE GLOBAL ── --}}
@if(session('success') || session('error') || session('warning'))
<div id="flash-container" style="position:fixed; top:20px; right:20px; z-index:9998; display:flex; flex-direction:column; gap:10px; max-width:380px;">
    
    @if(session('success'))
    <div class="flash-msg" style="display:flex; align-items:flex-start; gap:12px; background:white; border:1.5px solid #bbf7d0; border-left:4px solid #10b981; border-radius:12px; padding:14px 16px; box-shadow:0 8px 24px rgba(0,0,0,0.08); animation: flashIn .3s ease;">
        <div style="width:32px; height:32px; background:#ecfdf5; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg width="16" height="16" fill="none" stroke="#10b981" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <div style="flex:1; min-width:0;">
            <div style="font-size:12px; font-weight:800; color:#065f46; margin-bottom:2px;">Berhasil</div>
            <div style="font-size:12px; color:#047857; line-height:1.5;">{{ session('success') }}</div>
        </div>
        <button onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; color:#9ca3af; padding:2px; flex-shrink:0;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="flash-msg" style="display:flex; align-items:flex-start; gap:12px; background:white; border:1.5px solid #fecaca; border-left:4px solid #ef4444; border-radius:12px; padding:14px 16px; box-shadow:0 8px 24px rgba(0,0,0,0.08); animation: flashIn .3s ease;">
        <div style="width:32px; height:32px; background:#fef2f2; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg width="16" height="16" fill="none" stroke="#ef4444" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </div>
        <div style="flex:1; min-width:0;">
            <div style="font-size:12px; font-weight:800; color:#991b1b; margin-bottom:2px;">Gagal</div>
            <div style="font-size:12px; color:#b91c1c; line-height:1.5;">{{ session('error') }}</div>
        </div>
        <button onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; color:#9ca3af; padding:2px; flex-shrink:0;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    @if(session('warning'))
    <div class="flash-msg" style="display:flex; align-items:flex-start; gap:12px; background:white; border:1.5px solid #fde68a; border-left:4px solid #f59e0b; border-radius:12px; padding:14px 16px; box-shadow:0 8px 24px rgba(0,0,0,0.08); animation: flashIn .3s ease;">
        <div style="width:32px; height:32px; background:#fffbeb; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg width="16" height="16" fill="none" stroke="#f59e0b" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
        </div>
        <div style="flex:1; min-width:0;">
            <div style="font-size:12px; font-weight:800; color:#92400e; margin-bottom:2px;">Peringatan</div>
            <div style="font-size:12px; color:#b45309; line-height:1.5;">{{ session('warning') }}</div>
        </div>
        <button onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; color:#9ca3af; padding:2px; flex-shrink:0;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

</div>

<style>
@keyframes flashIn {
    from { opacity:0; transform: translateX(20px); }
    to   { opacity:1; transform: translateX(0); }
}
</style>

<script>
    // Auto hilang setelah 4 detik
    setTimeout(function() {
        var msgs = document.querySelectorAll('.flash-msg');
        msgs.forEach(function(msg) {
            msg.style.transition = 'opacity .4s, transform .4s';
            msg.style.opacity = '0';
            msg.style.transform = 'translateX(20px)';
            setTimeout(function() { msg.remove(); }, 400);
        });
    }, 4000);
</script>
@endif

        <main style="width:100%; padding:0;">
            {{ $slot }}
        </main>

    </div>

    {{-- ── MODAL KONFIRMASI HAPUS GLOBAL ── --}}
    <div id="delete-modal-overlay">
        <div id="delete-modal-box">
            <div id="delete-modal-icon">
                <svg width="24" height="24" fill="none" stroke="#ef4444" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <div id="delete-modal-title">Konfirmasi Hapus</div>
            <div id="delete-modal-desc">Apakah kamu yakin ingin menghapus <strong id="delete-modal-target">data ini</strong>? Tindakan ini <strong>tidak dapat dibatalkan</strong>.</div>
            <div class="delete-modal-actions">
                <button id="delete-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button id="delete-modal-confirm" onclick="submitDeleteForm()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
        var _deleteForm = null;

        function confirmDelete(formId, targetName) {
            _deleteForm = document.getElementById(formId);
            var desc = document.getElementById('delete-modal-target');
            desc.textContent = targetName || 'data ini';
            document.getElementById('delete-modal-overlay').classList.add('open');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal-overlay').classList.remove('open');
            _deleteForm = null;
        }

        function submitDeleteForm() {
            if (_deleteForm) _deleteForm.submit();
        }

        // Tutup modal kalau klik overlay
        document.getElementById('delete-modal-overlay').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Tutup dengan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
    </script>
</body>
</html>