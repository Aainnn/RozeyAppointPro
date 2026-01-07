# PowerShell script to help switch from XAMPP to Laragon
# Run this script after stopping XAMPP and starting Laragon

Write-Host "=== Switching to Laragon ===" -ForegroundColor Cyan
Write-Host ""

# Check if Laragon MySQL is running
Write-Host "Checking Laragon MySQL..." -ForegroundColor Yellow
$mysqlProcess = Get-Process | Where-Object {$_.Path -like "*laragon*" -and $_.ProcessName -eq "mysqld"}
if ($mysqlProcess) {
    Write-Host "✓ Laragon MySQL is running" -ForegroundColor Green
} else {
    Write-Host "✗ Laragon MySQL is NOT running" -ForegroundColor Red
    Write-Host "Please start Laragon and ensure MySQL is running!" -ForegroundColor Yellow
    exit
}

# Check if port 3306 is available (should be Laragon's MySQL)
Write-Host "Checking MySQL port 3306..." -ForegroundColor Yellow
$port3306 = Get-NetTCPConnection -LocalPort 3306 -ErrorAction SilentlyContinue
if ($port3306) {
    $mysqlProcess = Get-Process -Id $port3306.OwningProcess -ErrorAction SilentlyContinue
    if ($mysqlProcess -and $mysqlProcess.Path -like "*laragon*") {
        Write-Host "✓ Port 3306 is being used by Laragon MySQL" -ForegroundColor Green
    } else {
        Write-Host "✗ Port 3306 is NOT being used by Laragon" -ForegroundColor Red
        Write-Host "Please stop XAMPP MySQL first!" -ForegroundColor Yellow
        exit
    }
}

# Test MySQL connection
Write-Host ""
Write-Host "Testing MySQL connection..." -ForegroundColor Yellow
try {
    $connection = New-Object System.Data.SqlClient.SqlConnection
    $connection.ConnectionString = "Server=127.0.0.1;Database=mysql;User Id=root;Password=;"
    $connection.Open()
    $connection.Close()
    Write-Host "✓ MySQL connection successful (root, no password)" -ForegroundColor Green
} catch {
    Write-Host "✗ MySQL connection failed: $_" -ForegroundColor Red
    Write-Host "Please check Laragon MySQL configuration" -ForegroundColor Yellow
    exit
}

# Check if database exists
Write-Host ""
Write-Host "Checking if database 'rozeyappointpro' exists..." -ForegroundColor Yellow
$env:Path += ";C:\laragon\bin\mysql\mysql*\bin"
$mysqlPath = Get-ChildItem "C:\laragon\bin\mysql" -Recurse -Filter "mysql.exe" -ErrorAction SilentlyContinue | Select-Object -First 1

if ($mysqlPath) {
    $result = & $mysqlPath.FullName -u root -e "SHOW DATABASES LIKE 'rozeyappointpro';" 2>&1
    if ($result -match "rozeyappointpro") {
        Write-Host "✓ Database 'rozeyappointpro' exists" -ForegroundColor Green
    } else {
        Write-Host "✗ Database 'rozeyappointpro' does NOT exist" -ForegroundColor Yellow
        Write-Host "Creating database..." -ForegroundColor Yellow
        & $mysqlPath.FullName -u root -e "CREATE DATABASE rozeyappointpro;" 2>&1
        if ($LASTEXITCODE -eq 0) {
            Write-Host "✓ Database created successfully" -ForegroundColor Green
        } else {
            Write-Host "✗ Failed to create database" -ForegroundColor Red
        }
    }
} else {
    Write-Host "⚠ Could not find mysql.exe in Laragon" -ForegroundColor Yellow
    Write-Host "Please create database manually: CREATE DATABASE rozeyappointpro;" -ForegroundColor Yellow
}

# Check .env file
Write-Host ""
Write-Host "Checking .env file configuration..." -ForegroundColor Yellow
$envPath = "C:\laragon\www\rozeyappointpro\rozeyappointpro\.env"
if (Test-Path $envPath) {
    $envContent = Get-Content $envPath -Raw
    if ($envContent -match "DB_CONNECTION=mysql" -and 
        $envContent -match "DB_DATABASE=rozeyappointpro" -and 
        $envContent -match "DB_USERNAME=root") {
        Write-Host "✓ .env file looks correct" -ForegroundColor Green
    } else {
        Write-Host "⚠ .env file may need updating" -ForegroundColor Yellow
        Write-Host "Please verify these settings:" -ForegroundColor Yellow
        Write-Host "  DB_CONNECTION=mysql" -ForegroundColor Cyan
        Write-Host "  DB_HOST=127.0.0.1" -ForegroundColor Cyan
        Write-Host "  DB_PORT=3306" -ForegroundColor Cyan
        Write-Host "  DB_DATABASE=rozeyappointpro" -ForegroundColor Cyan
        Write-Host "  DB_USERNAME=root" -ForegroundColor Cyan
        Write-Host "  DB_PASSWORD=" -ForegroundColor Cyan
    }
} else {
    Write-Host "✗ .env file not found" -ForegroundColor Red
}

Write-Host ""
Write-Host "=== Next Steps ===" -ForegroundColor Cyan
Write-Host "1. Run: cd C:\laragon\www\rozeyappointpro\rozeyappointpro" -ForegroundColor White
Write-Host "2. Run: php artisan migrate" -ForegroundColor White
Write-Host "3. Run: php artisan db:seed" -ForegroundColor White
Write-Host "4. Run: php artisan serve" -ForegroundColor White
Write-Host "5. Visit: http://127.0.0.1:8000" -ForegroundColor White

