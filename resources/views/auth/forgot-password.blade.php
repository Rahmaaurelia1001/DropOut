<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue:     #2563eb;
        --blue-dk:  #1d4ed8;
        --blue-lt:  #eff6ff;
        --white:    #ffffff;
        --gray-50:  #f8fafc;
        --gray-200: #e2e8f0;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-900: #0f172a;
        --red:      #ef4444;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; margin: 0; overflow: hidden; }
    
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--gray-50);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    /* ── CARD UTAMA (KUNCI LANDSCAPE) ── */
    .login-card {
        width: 100%;
        max-width: 1100px;
        height: 600px;
        background: var(--white);
        border-radius: 32px;
        display: flex;
        flex-direction: row;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
    }

    /* SISI KIRI: VISUAL */
    .login-side-visual {
        width: 45%;
        background: linear-gradient(135deg, var(--blue-dk), var(--blue));
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        padding: 40px;
        text-align: center;
    }

    .login-logo-box {
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* SISI KANAN: FORM */
    .login-side-form {
        width: 55%;
        background: white;
        padding: 60px 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-title {
        font-size: 32px;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -1px;
        margin-bottom: 12px;
    }

    .info-text {
        font-size: 14px;
        line-height: 1.6;
        color: var(--gray-500);
        margin-bottom: 32px;
    }

    /* ── FORM ELEMENTS ── */
    .form-group { margin-bottom: 24px; }
    .form-label { display: block; font-size: 12px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }

    .input-wrapper { position: relative; display: flex; align-items: center; }
    .input-icon { position: absolute; left: 16px; color: var(--gray-400); pointer-events: none; }

    .form-input {
        width: 100%;
        height: 54px;
        border: 1.5px solid var(--gray-200);
        border-radius: 14px;
        padding: 0 16px 0 52px;
        font-family: inherit;
        font-size: 15px;
        font-weight: 600;
        color: var(--gray-900);
        transition: all 0.2s;
        outline: none;
    }

    .form-input:focus { border-color: var(--blue); background-color: var(--blue-lt); }

    .btn-submit {
        width: 100%;
        height: 56px;
        background: var(--blue);
        color: white;
        border: none;
        border-radius: 18px;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        transition: all 0.3s;
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
    }

    .btn-submit:hover { background: var(--blue-dk); transform: translateY(-2px); }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 24px;
        font-size: 14px;
        font-weight: 700;
        color: var(--blue);
        text-decoration: none;
        transition: 0.2s;
    }
    .back-link:hover { color: var(--blue-dk); text-decoration: underline; }

    /* Session Status Alert */
    .status-alert {
        background: #ecfdf5;
        border: 1px solid #10b981;
        color: #047857;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="login-card">
    <div class="login-side-visual">
        <div class="login-logo-box">
            <svg width="40" height="40" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2.5">
                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            </svg>
        </div>
        <h2 style="font-size: 28px; font-weight: 800; margin-bottom: 16px; line-height: 1.2;">Lupa Kata<br>Sandi?</h2>
        <div style="width: 40px; height: 4px; background: rgba(255,255,255,0.3); border-radius: 2px; margin-bottom: 20px;"></div>
        <p style="opacity: 0.9; font-weight: 500; line-height: 1.6; max-width: 280px;">Jangan khawatir, masukkan email Anda dan kami akan mengirimkan tautan pemulihan.</p>
    </div>

    <div class="login-side-form">
        <h1 class="login-title">Pemulihan Akun</h1>
        
        @if (session('status'))
            <div class="status-alert">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('status') }}
            </div>
        @endif

        <p class="info-text">Silakan masukkan alamat email yang terdaftar untuk mendapatkan instruksi pengaturan ulang kata sandi.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Alamat Email Pengguna</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                    </span>
                    <input type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email anda" class="form-input">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color:var(--red); font-size:11px; font-weight:700;" />
            </div>

            <button type="submit" class="btn-submit">
                <span>Kirim Link Pemulihan</span>
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Login
        </a>
    </div>
</div>
</x-guest-layout>