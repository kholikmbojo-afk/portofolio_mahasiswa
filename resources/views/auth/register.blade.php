@extends('layouts.app')

@section('title', 'Pendaftaran Akun Mahasiswa — Portofolio Mahasiswa')

@section('content')
<section class="content-section" style="padding: 50px 0 80px;">
    <div class="container" style="max-width: 620px;">
        <div class="content-card-white" style="padding: 42px 38px; box-shadow: 0 20px 50px rgba(25, 25, 23, 0.15); border-radius: var(--radius-md); background: #ffffff;">
            
            <!-- Header Card -->
            <div style="text-align: center; margin-bottom: 28px;">
                <span class="section-pill-tag">REGISTRASI KREATOR MAHASISWA</span>
                <h1 style="font-family: var(--font-headline); font-size: 2.3rem; color: var(--text-dark); margin-top: 8px; letter-spacing: 0.02em; line-height: 1.1;">
                    DAFTAR AKUN MAHASISWA
                </h1>
                <p style="font-size: 0.94rem; color: var(--text-muted); margin-top: 8px; line-height: 1.5;">
                    Bergabung bersama ratusan kreator kampus. Publikasikan karya tugas akhir, proyek riset, dan portofolio profesionalmu kepada dunia industri.
                </p>
            </div>

            <!-- Global Error Summary (if any) -->
            @if($errors->any())
                <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 14px 18px; border-radius: 8px; margin-bottom: 24px; font-size: 0.88rem; color: #991b1b; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);">
                    <div style="font-weight: 800; display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Terjadi kesalahan pada formulir:
                    </div>
                    <ul style="margin-left: 20px; line-height: 1.5;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST" id="mainRegisterForm">
                @csrf
                
                <!-- Nama Lengkap -->
                <div class="input-group-row">
                    <label class="input-label-tag">Nama Lengkap Mahasiswa *</label>
                    <input type="text" name="name" 
                        class="input-text-clean {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                        value="{{ old('name') }}" 
                        placeholder="Contoh: Muhammad Reza Pratama" 
                        required autofocus>
                    @error('name')
                        <div style="color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-circle-xmark"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- NIM & Prodi Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <!-- NIM -->
                    <div class="input-group-row">
                        <label class="input-label-tag">Nomor Induk Mahasiswa (NIM) *</label>
                        <input type="text" name="nim" 
                            class="input-text-clean {{ $errors->has('nim') ? 'is-invalid' : '' }}" 
                            value="{{ old('nim') }}" 
                            placeholder="Contoh: 2201010045" 
                            style="text-transform: uppercase;"
                            required>
                        <span style="font-size: 0.72rem; color: var(--text-muted); display: block; margin-top: 4px;">
                            <i class="fa-solid fa-circle-info"></i> Huruf/angka min. 5 karakter
                        </span>
                        @error('nim')
                            <div style="color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-circle-xmark"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Prodi -->
                    <div class="input-group-row">
                        <label class="input-label-tag">Jurusan / Program Studi *</label>
                        <input type="text" name="prodi" id="registerProdiInput" 
                            class="input-text-clean {{ $errors->has('prodi') ? 'is-invalid' : '' }}" 
                            value="{{ old('prodi') }}" 
                            placeholder="Contoh: Teknik Informatika, DKV, dll." 
                            required>
                        @error('prodi')
                            <div style="color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-circle-xmark"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Email Mahasiswa -->
                <div class="input-group-row">
                    <label class="input-label-tag">Email Mahasiswa Aktif *</label>
                    <input type="email" name="email" 
                        class="input-text-clean {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                        value="{{ old('email') }}" 
                        placeholder="nama@mahasiswa.kampus.ac.id atau nama@gmail.com" 
                        required>
                    <span style="font-size: 0.72rem; color: var(--text-muted); display: block; margin-top: 4px;">
                        <i class="fa-solid fa-envelope"></i> Digunakan untuk notifikasi kurasi karya dan verifikasi akun
                    </span>
                    @error('email')
                        <div style="color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-circle-xmark"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password & Confirmation Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <!-- Buat Password -->
                    <div class="input-group-row">
                        <label class="input-label-tag">Buat Kata Sandi *</label>
                        <div class="password-toggle-wrapper">
                            <input type="password" name="password" id="regPagePassword" 
                                class="input-text-clean {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                placeholder="Minimal 6 angka/huruf" 
                                minlength="6"
                                required>
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('regPagePassword', this)" title="Lihat kata sandi">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div style="color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-circle-xmark"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Ulangi Password -->
                    <div class="input-group-row">
                        <label class="input-label-tag">Ulangi Kata Sandi *</label>
                        <div class="password-toggle-wrapper">
                            <input type="password" name="password_confirmation" id="regPagePasswordConf" 
                                class="input-text-clean" 
                                placeholder="Ulangi kata sandi" 
                                minlength="6"
                                required>
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('regPagePasswordConf', this)" title="Lihat kata sandi">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Agreement Notice -->
                <div style="background: #f8fafc; border: 1px dashed var(--border-soft); border-radius: 8px; padding: 12px 14px; margin: 18px 0; font-size: 0.82rem; color: var(--text-dark); display: flex; align-items: flex-start; gap: 10px;">
                    <i class="fa-solid fa-shield-halved" style="color: #10b981; font-size: 1.1rem; margin-top: 2px;"></i>
                    <div style="line-height: 1.45;">
                        Dengan mendaftar, saya menyatakan bahwa karya yang saya unggah adalah <strong>orisinal</strong> hasil karya sendiri/kelompok tanpa plagiarisme, serta menyetujui peninjauan kurasi oleh pihak kampus.
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit-action" style="margin-top: 6px;">
                    <i class="fa-solid fa-user-plus"></i> DAFTARKAN AKUN SAYA SEKARANG
                </button>
            </form>

            <div style="text-align: center; margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--border-soft); font-size: 0.9rem; color: var(--text-muted);">
                Sudah memiliki akun mahasiswa atau administrator? 
                <a href="{{ route('login') }}" style="color: #047857; font-weight: 800; text-decoration: none; margin-left: 4px;">
                    Masuk di sini &rarr;
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_js')

@endsection
