@echo off
REM Script to start Laravel development server on Windows

echo.
echo ====================================
echo   Quan Ly Ban Sach - Laravel Server
echo ====================================
echo.

REM Set PHP path
set PHP_PATH=D:\xampp\php\php.exe

REM Check if PHP exists
if not exist "%PHP_PATH%" (
    echo Loi: Khong tim thay PHP tai %PHP_PATH%
    echo Vui long cap nhat duong dan PHP trong script nay.
    pause
    exit /b 1
)

echo Dang khoi dong server...
echo.

REM Change to project directory
cd /d "%~dp0"

REM Run Laravel serve
"%PHP_PATH%" artisan serve

pause
