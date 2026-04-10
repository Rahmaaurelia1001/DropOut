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
        --red-lt:   #fef2f2;
        --red:      #ef4444;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    nav[x-data], header { display: none !important; }

    .da-root {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--gray-50); color: var(--gray-800);
        min-height: 100vh; -webkit-font-smoothing: antialiased;
    }

    /* ── HEADER AREA ── */
    .p-header {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        padding: 40px 20px;
        text-align: center;
    }
    .p-back-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 8px 16px; border-radius: 10px;
        background: var(--gray-100); color: var(--gray-800);
        text-decoration: none; font-size: 13px; font-weight: 700;
        margin-bottom: 20px; transition: .2s;
    }
    .p-back-btn:hover { background: var(--gray-200); }

    .p-title { font-size: 28px; font-weight: 800; color: var(--gray-900); letter-spacing: -0.8px; }
    .p-sub { font-size: 14px; color: var(--gray-400); margin-top: 5px; }

    /* ── CONTENT AREA ── */
    .p-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .p-card {
        background: var(--white);
        border: 1.5px solid var(--gray-200);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    }

    /* Override gaya form bawaan Breeze agar lebih mewah */
    .p-card h2 { font-size: 18px; font-weight: 800; color: var(--gray-900); margin-bottom: 8px; }
    .p-card p { font-size: 13px; color: var(--gray-500); margin-bottom: 24px; line-height: 1.5; }
    
    input[type="text"], input[type="email"], input[type="password"] {
        width: 100%; padding: 12px 16px; border: 1.5px solid var(--gray-200);
        border-radius: 12px; font-family: inherit; font-size: 14px;
        transition: .2s; margin-top: 6px;
    }
    input:focus { outline: none; border-color: var(--blue); box-shadow: 0 0 0 4px var(--blue-lt); }

    .p-danger-zone { border-color: var(--red-lt); }
</style>

<div class="da-root">
    {{-- Header --}}
    <div class="p-header">
        <a href="{{ route('dashboard') }}" class="p-back-btn">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Dashboard
        </a>
        <h1 class="p-title">Pengaturan Akun</h1>
        <p class="p-sub">Kelola informasi profil, keamanan kata sandi, dan privasi akun Anda</p>
    </div>

    {{-- Forms Container --}}
    <div class="p-container">
        
        {{-- Update Profile Info --}}
        <div class="p-card">
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div class="p-card">
            @include('profile.partials.update-password-form')
        </div>

        {{-- Delete Account --}}
        <div class="p-card p-danger-zone">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
</x-app-layout>