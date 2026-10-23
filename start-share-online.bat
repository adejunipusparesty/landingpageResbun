@echo off
title RSIA Restu Bunda - Public Share Tunnel
echo ========================================================
echo   Membuka Akses RSIA Restu Bunda untuk Komputer/HP Lain
echo ========================================================
echo.
echo Sedang membuat link online... Tunggu sebentar...
echo.
"%~dp0cloudflared.exe" tunnel --url http://127.0.0.1:8000
pause
