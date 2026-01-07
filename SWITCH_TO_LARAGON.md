# Switching from XAMPP to Laragon - Step by Step Guide

## 📋 Prerequisites
- Laragon installed at `C:\laragon`
- XAMPP currently running (we'll stop it)
- Your project is already in Laragon's directory: `C:\laragon\www\rozeyappointpro`

## 🔄 Step-by-Step Migration

### Step 1: Stop XAMPP Services
1. Open **XAMPP Control Panel**
2. Click **Stop** for:
   - Apache
   - MySQL
3. Close XAMPP Control Panel

### Step 2: Start Laragon Services
1. Open **Laragon** application
2. Click **Start All** (or start Apache/Nginx and MySQL individually)
3. Wait until both services show green/active status

### Step 3: Verify Laragon MySQL Configuration
Laragon's default MySQL settings:
- **Host**: `127.0.0.1` or `localhost`
- **Port**: `3306`
- **Username**: `root`
- **Password**: Usually **empty** (blank)

### Step 4: Create Database in Laragon
**Option A: Using Laragon's Database Manager**
1. In Laragon, click on **Database** button (or open HeidiSQL/Adminer)
2. Create new database: `rozeyappointpro`

**Option B: Using Command Line**
```sql
mysql -u root -e "CREATE DATABASE rozeyappointpro;"
```

**Option C: Using phpMyAdmin (if Laragon has it)**
1. Go to `http://localhost/phpmyadmin`
2. Click "New" → Enter database name: `rozeyappointpro`
3. Click "Create"

### Step 5: Update .env File
Your `.env` file should have:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rozeyappointpro
DB_USERNAME=root
DB_PASSWORD=
```

### Step 6: Run Migrations
```bash
cd C:\laragon\www\rozeyappointpro\rozeyappointpro
php artisan migrate
php artisan db:seed
```

### Step 7: Test the Application
```bash
php artisan serve
```
Then visit: `http://127.0.0.1:8000`

## ✅ Verification Checklist
- [ ] XAMPP services stopped
- [ ] Laragon services started
- [ ] Database `rozeyappointpro` created
- [ ] `.env` file configured correctly
- [ ] Migrations run successfully
- [ ] Application accessible at `http://127.0.0.1:8000`

## 🔧 Troubleshooting

### If MySQL connection fails:
1. Check Laragon MySQL is running (green in Laragon)
2. Verify MySQL password (try empty or "root")
3. Check if port 3306 is available: `netstat -ano | findstr :3306`

### If port conflict occurs:
- XAMPP might still be using port 3306
- Stop XAMPP completely
- Restart Laragon services

### If database doesn't exist:
- Create it manually using one of the methods above
- Or run: `mysql -u root -e "CREATE DATABASE rozeyappointpro;"`

## 📝 Notes
- Laragon uses the same default MySQL settings as XAMPP (root, no password)
- Your project is already in Laragon's directory structure
- You can use Laragon's virtual host feature for automatic domain setup
- Laragon includes useful tools like HeidiSQL for database management

