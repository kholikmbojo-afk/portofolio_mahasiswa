@echo off
title Push Project ke GitHub - portofolio_mahasiswa
color 0A
echo =======================================================
echo   PUSH PROJECT SIC KE GITHUB: portofolio_mahasiswa
echo =======================================================
echo.
cd /d "c:\laragon\www\KaryaMahasiswa"

echo [1/4] Mengatur remote repository ke repo baru...
git remote remove origin 2>nul
git remote add origin https://github.com/kholikmbojo-afk/portofolio_mahasiswa.git

echo [2/4] Memeriksa branch main...
git branch -M main

echo [3/4] Memastikan seluruh file terbaru siap...
git add -A
git commit -m "Initial commit - SIC (Student Innovation & Creativity) Kerja Praktik Pustikom" 2>nul

echo.
echo [4/4] Mengunggah (Push) ke GitHub (https://github.com/kholikmbojo-afk/portofolio_mahasiswa)...
echo.
git push -u origin main --force

echo.
if %errorlevel% equ 0 (
    echo =======================================================
    echo   BERHASIL 100%! 
    echo   Project sukses di-push ke repositori baru!
    echo   Cek di: https://github.com/kholikmbojo-afk/portofolio_mahasiswa
    echo =======================================================
) else (
    echo =======================================================
    echo   Gagal push. Pastikan koneksi internet stabil.
    echo =======================================================
)
echo.
pause
