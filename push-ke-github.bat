@echo off
title Push Project ke GitHub - portofolyo_mahasiswa
color 0A
echo =======================================================
echo   PUSH PROJECT SIC KE GITHUB: portofolyo_mahasiswa
echo =======================================================
echo.
cd /d "c:\laragon\www\KaryaMahasiswa"

echo [1/5] Memeriksa status Git...
git branch -M main

echo [2/5] Menyiapkan remote repository GitHub...
git remote remove origin 2>nul
git remote add origin https://github.com/kholikmbojo-afk/portofolyo_mahasiswa.git

echo [3/5] Mengumpulkan seluruh file proyek...
git add -A

echo [4/5] Membuat commit proyek...
git commit -m "Upload source code project SIC - Student Innovation and Creativity" 2>nul

echo.
echo [5/5] Mendorong (Push) ke GitHub (https://github.com/kholikmbojo-afk/portofolyo_mahasiswa)...
echo Sedang mengunggah file... Jika muncul popup browser GitHub, silakan klik 'Sign in with browser'.
echo.
git push -u origin main --force

echo.
if %errorlevel% equ 0 (
    echo =======================================================
    echo   BERHASIL! Project sukses di-push ke GitHub!
    echo   Cek di: https://github.com/kholikmbojo-afk/portofolyo_mahasiswa
    echo =======================================================
) else (
    echo =======================================================
    echo   PERHATIAN: Push belum berhasil.
    echo   Kemungkinan penyebab:
    echo   1. Perlu login ke akun GitHub 'kholikmbojo-afk'
    echo   2. Repositori di GitHub belum dibuat atau private
    echo =======================================================
)
echo.
pause
