@echo off
title Reset Git History & Push Bersih ke GitHub
color 0B
echo =======================================================
echo   BERSIHKAN RIWAYAT LARAVEL & JADIKAN BOS SATU-SATUNYA KONTRIBUTOR
echo =======================================================
echo.
cd /d "c:\laragon\www\KaryaMahasiswa"

echo [1/5] Menghapus riwayat commit lama bawaan Laravel...
rmdir /s /q .git

echo [2/5] Membuat repository Git baru yang fresh...
git init
git branch -M main

echo [3/5] Menghubungkan ke repository GitHub bos...
git remote add origin https://github.com/kholikmbojo-afk/portofolyo_mahasiswa.git

echo [4/5] Mengumpulkan seluruh file project kita...
git add -A
git commit -m "Initial commit - SIC (Student Innovation and Creativity)"

echo.
echo [5/5] Mengunggah (Push) ke GitHub dengan riwayat bersih...
git push -u origin main --force

echo.
if %errorlevel% equ 0 (
    echo =======================================================
    echo   BERHASIL! 
    echo   Riwayat 708 kontributor Laravel sudah hilang.
    echo   Sekarang bos adalah SATU-SATUNYA kontributor proyek ini!
    echo   Cek di: https://github.com/kholikmbojo-afk/portofolyo_mahasiswa
    echo =======================================================
) else (
    echo =======================================================
    echo   Gagal push. Pastikan koneksi internet stabil dan akun GitHub sudah login.
    echo =======================================================
)
echo.
pause

