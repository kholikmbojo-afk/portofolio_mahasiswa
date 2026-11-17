@extends('layouts.app')

@section('title', 'Masuk Portal — Portofolio Mahasiswa')

@section('content')
<section class="content-section" style="padding: 60px 0 90px;">
    <div class="container" style="max-width: 520px;">
        <div class="content-card-white" style="padding: 42px 38px; box-shadow: 0 20px 50px rgba(25, 25, 23, 0.15); border-radius: var(--radius-md); background: #ffffff;">
            
            <!-- Header Card -->
            <div style="text-align: center; margin-bottom: 26px;">
                <span class="section-pill-tag">PORTAL AUTENTIKASI KAMPUS</span>
                <h1 style="font-family: var(--font-headline); font-size: 2.3rem; color: var(--text-dark); margin-top: 8px; letter-spacing: 0.02em; line-height: 1.1;">
                    MASUK KE DASHBOARD
                </h1>
                <p style="font-size: 0.92rem; color: var(--text-muted); margin-top: 8px; line-height: 1.5;">
                    Portal khusus Kreator Mahasiswa untuk mengunggah karya dan Tim Administrator untuk kurasi.
                </p>
            </div>

            <!-- Error / Lockout Notification -->
            @if($errors->any())
                @php
                    $firstError = $errors->first();
                    $isLockout = session()->has('lockout_seconds') || str_contains($firstError, 'tunggu') || str_contains($firstError, 'dikunci');
                @endphp

                @if($isLockout)
                    <!-- Lockout Banner dengan Countdown -->
                    <div id="lockoutBanner" style="background: #fff7ed; border-left: 4px solid #f97316; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 0.88rem; color: #7c2d12;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                            <i class="fa-solid fa-lock" style="font-size: 1.1rem; color: #ea580c;"></i>
                            <strong>Akun Sementara Dikunci</strong>
                        </div>
                        <p style="margin: 0 0 10px; line-height: 1.5;">{{ $firstError }}</p>
                        <div style="display: flex; align-items: center; gap: 8px; background: #ffedd5; padding: 8px 12px; border-radius: 8px; font-weight: 700;">
                            <i class="fa-solid fa-clock" style="color: #ea580c;"></i>
                            <span>Bisa login lagi dalam: </span>
                            <span id="countdownDisplay" style="font-family: monospace; font-size: 1rem; color: #c2410c; min-width: 56px;">
                                {{ gmdate('i:s', session('lockout_seconds', 240)) }}
                            </span>
                        </div>
                    </div>
                @else
                    <!-- Pesan Error Biasa -->
                    <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem; color: #991b1b; display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fa-solid fa-circle-xmark" style="font-size: 1.1rem; margin-top: 1px; flex-shrink: 0;"></i>
                        <div>{{ $firstError }}</div>
                    </div>
                @endif
            @endif

            <form action="{{ url('/login') }}" method="POST" id="loginPageForm">
                @csrf
                
                <!-- Email atau NIM -->
                <div class="input-group-row">
                    <label class="input-label-tag">Email Resmi atau NIM Mahasiswa</label>
                    <input type="text" name="login" id="loginPageInput" 
                        class="input-text-clean {{ $errors->has('login') || $errors->has('email') ? 'is-invalid' : '' }}" 
                        value="{{ old('login', old('email')) }}" 
                        placeholder="nama@mahasiswa.ac.id atau 2201010045" 
                        required autofocus>
                    @if($errors->has('login') || $errors->has('email'))
                        <div style="color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-circle-xmark"></i> {{ $errors->first('login') ?: $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="input-group-row">
                    <label class="input-label-tag">Kata Sandi Akun</label>
                    <div class="password-toggle-wrapper">
                        <input type="password" name="password" id="loginPagePassword" 
                            class="input-text-clean {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                            placeholder="Minimal 6 angka/huruf" 
                            minlength="6"
                            required>
                        <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('loginPagePassword', this)" title="Lihat kata sandi">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Register Link -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 22px; font-size: 0.88rem;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: var(--text-dark); font-weight: 600;">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color: var(--accent-gold); width: 16px; height: 16px;"> 
                        Ingat saya di perangkat ini
                    </label>
                    <a href="{{ route('register') }}" style="color: #047857; font-weight: 700; text-decoration: none;">
                        Belum punya akun?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit-action" id="loginSubmitBtn">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> MASUK KE DASHBOARD
                </button>
            </form>

            <div style="text-align: center; margin-top: 26px; padding-top: 20px; border-top: 1px solid var(--border-soft); font-size: 0.9rem; color: var(--text-muted);">
                Mahasiswa baru belum memiliki akun? 
                <a href="{{ route('register') }}" style="color: #047857; font-weight: 800; text-decoration: none; margin-left: 4px;">
                    Daftar Akun Mahasiswa &rarr;
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_js')
<script>
    function fillLoginPage(login, pass) {
        const loginInp = document.getElementById('loginPageInput');
        const passInp  = document.getElementById('loginPagePassword');
        if (loginInp && passInp) {
            loginInp.value = login;
            passInp.value  = pass;
            loginInp.focus();
        }
    }

    // ── Countdown Timer untuk Lockout ──
    (function () {
        const display    = document.getElementById('countdownDisplay');
        const submitBtn  = document.getElementById('loginSubmitBtn');
        const form       = document.getElementById('loginPageForm');

        if (!display) return; // tidak ada lockout, skip

        // Ambil sisa detik dari server (di-render sebagai angka)
        let seconds = {{ session('lockout_seconds', 0) }};

        if (seconds <= 0) return;

        // Nonaktifkan form selama lockout
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.5';
            submitBtn.style.cursor  = 'not-allowed';
        }
        if (form) {
            const inputs = form.querySelectorAll('input');
            inputs.forEach(inp => { inp.disabled = true; inp.style.opacity = '0.6'; });
        }

        function pad(n) { return String(n).padStart(2, '0'); }

        function tick() {
            if (seconds <= 0) {
                display.textContent = '00:00';
                // Aktifkan kembali form
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor  = 'pointer';
                }
                if (form) {
                    const inputs = form.querySelectorAll('input');
                    inputs.forEach(inp => { inp.disabled = false; inp.style.opacity = '1'; });
                }
                // Update banner jadi bisa login lagi
                const banner = document.getElementById('lockoutBanner');
                if (banner) {
                    banner.style.borderColor = '#10b981';
                    banner.style.background  = '#f0fdf4';
                    banner.style.color       = '#064e3b';
                    banner.innerHTML = `
                        <div style="display:flex;align-items:center;gap:10px;">
                            <i class="fa-solid fa-circle-check" style="color:#10b981;font-size:1.1rem;"></i>
                            <strong>Akses dipulihkan!</strong>
                        </div>
                        <p style="margin:6px 0 0;">Anda sudah bisa mencoba login kembali sekarang.</p>
                    `;
                }
                return;
            }
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            display.textContent = pad(m) + ':' + pad(s);
            seconds--;
            setTimeout(tick, 1000);
        }

        tick();
    })();
</script>
@endsection
