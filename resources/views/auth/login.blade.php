<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue:     #2563eb;
        --blue-dk:  #1d4ed8;
        --blue-lt:  #eff6ff;
        --blue-mid: #dbeafe;
        --white:    #ffffff;
        --gray-50:  #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --red:      #ef4444;
        --red-lt:   #fef2f2;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body { height: 100%; margin: 0; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--gray-100);
        background-image: radial-gradient(circle at 2px 2px, var(--gray-200) 1px, transparent 0);
        background-size: 40px 40px;
        display: grid;
        place-items: center;
        min-height: 100vh;
        padding: 24px;
        -webkit-font-smoothing: antialiased;
    }

    /* ── LOGIN CARD (dua kolom) ── */
    .login-card {
        width: 100%;
        max-width: 820px;
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: 24px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.08), 0 8px 16px -8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        display: flex;          /* ← horizontal */
        min-height: 480px;
        animation: fadeIn 0.45s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ══════════════════════════════
       PANEL KIRI — Branding
    ══════════════════════════════ */
    .login-panel-left {
        flex: 0 0 320px;
        background: linear-gradient(145deg, #1d4ed8 0%, #2563eb 55%, #3b82f6 100%);
        padding: 40px 36px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    /* Dekorasi lingkaran di background panel kiri */
    .login-panel-left::before {
        content: '';
        position: absolute;
        top: -70px;
        right: -70px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        pointer-events: none;
    }

    .login-panel-left::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        pointer-events: none;
    }

    .brand-logo {
        width: 52px;
        height: 52px;
        background: rgba(255, 255, 255, 0.18);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 22px;
    }

    .brand-title {
        font-size: 21px;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.03em;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .brand-sub {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.68);
        font-weight: 500;
        line-height: 1.5;
    }

    .brand-divider {
        width: 40px;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
        margin: 22px 0;
    }

    .brand-features {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .feat-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .feat-icon {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .feat-text {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 600;
    }

    .brand-footer {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.4);
        font-weight: 500;
        position: relative;
        z-index: 1;
    }

    /* ══════════════════════════════
       PANEL KANAN — Form Login
    ══════════════════════════════ */
    .login-panel-right {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 44px 40px;
    }

    .right-head {
        margin-bottom: 28px;
    }

    .right-title {
        font-size: 20px;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.025em;
        margin-bottom: 4px;
    }

    .right-sub {
        font-size: 13px;
        color: var(--gray-500);
        font-weight: 500;
    }

    /* ── FORM ELEMENTS ── */
    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: var(--gray-700);
        margin-bottom: 7px;
        text-transform: uppercase;
        letter-spacing: 0.07em;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 13px;
        color: var(--gray-400);
        display: flex;
        pointer-events: none;
    }

    .form-input {
        width: 100%;
        height: 46px;
        background: var(--white);
        border: 1.5px solid var(--gray-200);
        border-radius: 12px;
        padding: 0 14px 0 41px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-900);
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }

    .form-input:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 4px var(--blue-lt);
    }

    .form-input::placeholder {
        color: var(--gray-400);
        font-weight: 500;
    }

    .form-input.is-invalid {
        border-color: var(--red);
        background-color: var(--red-lt);
    }

    /* Password Toggle */
    .btn-toggle {
        position: absolute;
        right: 8px;
        padding: 8px;
        background: none;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
        display: flex;
        border-radius: 8px;
    }
    .btn-toggle:hover { color: var(--gray-700); background: var(--gray-100); }

    /* Error Message */
    .error-msg {
        font-size: 11px;
        color: var(--red);
        font-weight: 700;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Status / Alert */
    .alert-info {
        background: var(--blue-lt);
        border: 1px solid var(--blue-mid);
        color: var(--blue);
        padding: 12px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Footer Row */
    .footer-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-600);
        cursor: pointer;
    }

    .checkbox-custom {
        width: 17px;
        height: 17px;
        accent-color: var(--blue);
        cursor: pointer;
    }

    .forgot-link {
        font-size: 13px;
        font-weight: 700;
        color: var(--blue);
        text-decoration: none;
    }
    .forgot-link:hover { text-decoration: underline; }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        height: 48px;
        background: var(--blue);
        color: white;
        border: none;
        border-radius: 13px;
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    .btn-submit:hover {
        background: var(--blue-dk);
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
    }

    .btn-submit:active { transform: translateY(0); }

    /* ── RESPONSIVE: Kembali ke satu kolom di layar kecil ── */
    @media (max-width: 640px) {
        .login-card {
            flex-direction: column;
            max-width: 400px;
        }

        .login-panel-left {
            flex: none;
            padding: 32px 28px;
            min-height: auto;
        }

        .brand-features { display: none; } /* sembunyikan fitur di mobile */

        .login-panel-right {
            padding: 32px 28px;
        }
    }
</style>

<div class="login-card">

    {{-- ═══════════════════════════════
         PANEL KIRI — Branding
    ═══════════════════════════════ --}}
    <div class="login-panel-left">
        <div>
            <div class="brand-logo">
                <svg width="26" height="26" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2.5">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>

            <div class="brand-title">SPK Putus Sekolah</div>
            <div class="brand-sub">SDN 11 Kampung Batu Dalam</div>

            <div class="brand-divider"></div>

            <div class="brand-features">
                <div class="feat-item">
                    <div class="feat-icon">
                        <svg width="16" height="16" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="feat-text">Analisis Data Siswa</span>
                </div>
                <div class="feat-item">
                    <div class="feat-icon">
                        <svg width="16" height="16" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="feat-text">Laporan Keputusan</span>
                </div>
                <div class="feat-item">
                    <div class="feat-icon">
                        <svg width="16" height="16" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <span class="feat-text">Akses Aman & Terenkripsi</span>
                </div>
            </div>
        </div>

        <div class="brand-footer">
            &copy; {{ date('Y') }} Sistem Pendukung Keputusan &mdash; SDN 11
        </div>
    </div>

    {{-- ═══════════════════════════════
         PANEL KANAN — Form Login
    ═══════════════════════════════ --}}
    <div class="login-panel-right">

        <div class="right-head">
            <h1 class="right-title">Selamat Datang</h1>
            <p class="right-sub">Masuk menggunakan akun yang terdaftar</p>
        </div>

        {{-- Alert Status (misalnya setelah reset password) --}}
        @if(session('status'))
            <div class="alert-info">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email Pengguna</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                        </svg>
                    </span>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan email anda"
                        class="form-input @error('email') is-invalid @enderror"
                    >
                </div>
                @error('email')
                    <div class="error-msg">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4m0 4h.01"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="form-input @error('password') is-invalid @enderror"
                    >
                    <button type="button" class="btn-toggle" onclick="togglePw()">
                        <svg id="ico-eye" width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="ico-eye-off" width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="display:none">
                            <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div class="error-msg">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4m0 4h.01"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="footer-row">
                <label class="remember-me">
                    <input type="checkbox" name="remember" class="checkbox-custom" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat Saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">Lupa sandi?</a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">
                Masuk ke Sistem
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>

        </form>
    </div>

</div>

<script>
function togglePw() {
    const input  = document.getElementById('password');
    const eyeOn  = document.getElementById('ico-eye');
    const eyeOff = document.getElementById('ico-eye-off');
    if (input.type === 'password') {
        input.type = 'text';
        eyeOn.style.display  = 'none';
        eyeOff.style.display = 'block';
    } else {
        input.type = 'password';
        eyeOn.style.display  = 'block';
        eyeOff.style.display = 'none';
    }
}
</script>
</x-guest-layout>