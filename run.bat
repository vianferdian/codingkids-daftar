@echo off
set "PATH=C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64;C:\laragon\bin\composer;C:\laragon\bin\nodejs\node-v22;C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin;%PATH%"
echo Starting CodingKids Laravel Server...
php artisan serve --host=127.0.0.1 --port=8000
pause
