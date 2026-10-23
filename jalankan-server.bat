@echo off
title RSIA Restu Bunda - Local Server
echo ========================================================
echo   Menjalankan Server RSIA Restu Bunda (Laravel)
echo ========================================================
echo.
echo Server aktif di: http://127.0.0.1:8000
echo Tekan CTRL + C untuk menghentikan server.
echo.

if exist "C:\xampp\php\php.exe" (
    "C:\xampp\php\php.exe" artisan serve
) else (
    php artisan serve
)

pause
