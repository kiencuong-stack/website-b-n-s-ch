# PowerShell script to start Laravel development server

Write-Host ""
Write-Host "====================================" -ForegroundColor Cyan
Write-Host "   Quan Ly Ban Sach - Laravel Server" -ForegroundColor Cyan
Write-Host "====================================" -ForegroundColor Cyan
Write-Host ""

$phpPath = "D:\xampp\php\php.exe"

# Check if PHP exists
if (-not (Test-Path $phpPath)) {
    Write-Host "Loi: Khong tim thay PHP tai $phpPath" -ForegroundColor Red
    Write-Host "Vui long cap nhat duong dan PHP trong script nay." -ForegroundColor Red
    Read-Host "Nhan Enter de thoat"
    exit 1
}

# Get script directory
$scriptDir = Split-Path -Parent -Path $MyInvocation.MyCommand.Definition
Set-Location $scriptDir

Write-Host "Dang khoi dong server..." -ForegroundColor Green
Write-Host ""

# Run Laravel serve
& $phpPath artisan serve

Read-Host "Nhan Enter de thoat"
