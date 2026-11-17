@echo off
title Hapus Sisa Branch Lama di GitHub
color 0E
echo ========================================================
echo   MENGHAPUS SISA-SISA BRANCH LARAVEL LAMA DI GITHUB
echo ========================================================
echo.
cd /d "c:\laragon\www\KaryaMahasiswa"

echo [1/2] Menghapus branch '13.x' bawaan Laravel di GitHub jika ada...
git push origin --delete 13.x 2>nul

echo [2/2] Menghapus branch 'master' lama jika ada...
git push origin --delete master 2>nul

echo.
echo Selesai!
pause

