<x-guest-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --blue:     #2563eb;
    --blue-dk:  #1d4ed8;
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
    --red:      #ef4444;
    --red-lt:   #fef2f2;
    --red-bd:   #fecaca;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--gray-50);
    min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    padding: 24px;
    -webkit-font-smoothing: antialiased;
}

/* ── CARD ── */
.login-card {
    width: 100%; max-width: 420px;
    background: var(--white);
    border: 1.5px solid var(--gray-200);
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,.06), 0 1px 4px rgba(0,0,0,.04);
    overflow: hidden;
}

/* Header */
.login-head {
    padding: 32px 32px 24px;
    text-align: center;
    border-bottom: 1px solid var(--gray-100);
}
.login-logo {
    width: 52px; height: 52px; border-radius: 14px;
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    box-shadow: 0 4px 14px rgba(37,99,235,.3);
}
.login-title {
    font-size: 20px; font-weight: 800;
    color: var(--gray-900); letter-spacing: -0.4px;
    margin-bottom: 4px;
}
.login-sub {
    font-size: 12px; color: var(--gray-400); font-weight: 500;
}

/* Body */
.login-body { padding: 28px 32px; display: flex; flex-direction: column; gap: 18px; }

/* Alert */
.login-alert {
    padding: 10px 14px;
    background: var(--blue-lt); border: 1px solid var(--blue-mid);
    border-radius: 9px;
    font-size: 12.5px; font-weight: 600; color: var(--blue);
    display: flex; align-items: center; gap: 8px;
}

/* Form group */
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-label {
    font-size: 12px; font-weight: 700; color: var(--gray-700);
}
.form-input-wrap { position: relative; }
.form-input-ico {
    position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
    color: var(--gray-400); pointer-events: none;
    display: flex; align-items: center;
}
.form-control {
    width: 100%;
    padding: 10px 12px 10px 38px;
    font-size: 13px; font-weight: 500;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--gray-800);
    background: var(--white);
    border: 1.5px solid var(--gray-200);
    border-radius: 9px;
    outline: none;
    transition: border-color .15s, box-shadow .15s;
}
.form-control:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.1);
}
.form-control::placeholder { color: var(--gray-400); }
.form-control.is-error {
    border-color: var(--red);
    background: var(--red-lt);
}
.form-control.is-error:focus {
    box-shadow: 0 0 0 3px rgba(239,68,68,.1);
}

/* Toggle password */
.btn-toggle-pw {
    position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer; padding: 4px;
    color: var(--gray-400); border-radius: 5px;
    display: flex; align-items: center;
    transition: color .13s;
}
.btn-toggle-pw:hover { color: var(--gray-600); }

/* Error message */
.form-error {
    font-size: 11px; color: var(--red); font-weight: 600;
    display: flex; align-items: center; gap: 4px;
}

/* Remember + forgot */
.form-footer-row {
    display: flex; align-items: center; justify-content: space-between;
}
.remember-label {
    display: flex; align-items: center; gap: 7px;
    font-size: 12.5px; font-weight: 600; color: var(--gray-600);
    cursor: pointer;
}
.remember-check {
    width: 15px; height: 15px; border-radius: 4px;
    border: 1.5px solid var(--gray-300);
    accent-color: var(--blue);
    cursor: pointer;
}
.forgot-link {
    font-size: 12px; font-weight: 600; color: var(--blue);
    text-decoration: none; transition: color .13s;
}
.forgot-link:hover { color: var(--blue-dk); text-decoration: underline; }

/* Submit btn */
.btn-login {
    width: 100%;
    padding: 11px;
    background: var(--blue); color: var(--white);
    border: none; border-radius: 10px;
    font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .15s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-login:hover {
    background: var(--blue-dk);
    box-shadow: 0 4px 14px rgba(37,99,235,.3);
    transform: translateY(-1px);
}
.btn-login:active { transform: translateY(0); }

/* Footer */
.login-foot {
    padding: 14px 32px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
    text-align: center;
    font-size: 11px; color: var(--gray-400); font-weight: 500;
}
</style>

<div class="login-card">

    {{-- Header --}}
    <div class="login-head">
        <div class="login-logo">
            <svg width="26" height="26" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            </svg>
        </div>
        <div class="login-title">SPK Putus Sekolah</div>
        <div class="login-sub">SDN 11 Kampung Batu — Masuk untuk melanjutkan</div>
    </div>

    {{-- Body --}}
    <div class="login-body">

        {{-- Session status --}}
        @if(session('status'))
            <div class="login-alert">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" style="display:flex; flex-direction:column; gap:18px;">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-input-wrap">
                    <span class="form-input-ico">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <input id="email" type="email" name="email"
                        class="form-control {{ $errors->has('email') ? 'is-error' : '' }}"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required autofocus autocomplete="username">
                </div>
                @error('email')
                    <span class="form-error">
                        <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/></svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="form-input-wrap">
                    <span class="form-input-ico">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input id="password" type="password" name="password"
                        class="form-control {{ $errors->has('password') ? 'is-error' : '' }}"
                        placeholder="••••••••"
                        required autocomplete="current-password">
                    <button type="button" class="btn-toggle-pw" onclick="togglePw()" title="Tampilkan password">
                        <svg id="ico-eye" width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg id="ico-eye-off" width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
                @error('password')
                    <span class="form-error">
                        <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/></svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="form-footer-row">
                <label class="remember-label">
                    <input type="checkbox" id="remember_me" name="remember" class="remember-check">
                    Ingat saya
                </label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Masuk
            </button>

        </form>
    </div>

    {{-- Footer --}}
    <div class="login-foot">
        © {{ date('Y') }} SPK Risiko Putus Sekolah &mdash; SDN 11 Kampung Batu
    </div>

</div>

<script>
function togglePw() {
    const input = document.getElementById('password');
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