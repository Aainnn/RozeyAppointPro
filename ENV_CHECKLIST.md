# .env File Configuration Checklist for RozeyAppointPro

## ✅ Required Configuration

Your `.env` file should have these settings for Laragon:

### Application Settings
```env
APP_NAME="RozeyAppointPro"
APP_ENV=local
APP_KEY=base64:... (should be generated)
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

### Database Configuration (Laragon MySQL)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rozeyappointpro
DB_USERNAME=root
DB_PASSWORD=
```
**Note:** Laragon's default MySQL password is usually **empty** (blank)

### Cache & Session
```env
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Queue (if using)
```env
QUEUE_CONNECTION=sync
```

### Mail Configuration (optional for now)
```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 🔍 How to Check Your .env File

1. Open `.env` file in your project root: `C:\laragon\www\rozeyappointpro\.env`

2. Verify these key settings:
   - ✅ `DB_CONNECTION=mysql`
   - ✅ `DB_HOST=127.0.0.1`
   - ✅ `DB_DATABASE=rozeyappointpro`
   - ✅ `DB_USERNAME=root`
   - ✅ `DB_PASSWORD=` (empty/blank for Laragon)
   - ✅ `APP_KEY=` should have a value (run `php artisan key:generate` if empty)

## 🛠️ Common Issues & Fixes

### Issue 1: Database Connection Error
**Solution:** Make sure:
- Laragon MySQL is running
- Database `rozeyappointpro` exists
- `DB_PASSWORD` is empty (not `null` or `''`)

### Issue 2: APP_KEY Missing
**Solution:** Run:
```bash
php artisan key:generate
```

### Issue 3: Assets Not Loading
**Solution:** Make sure to run:
```bash
npm install
npm run dev
# or for production
npm run build
```

### Issue 4: Storage Link Missing (for images)
**Solution:** Run:
```bash
php artisan storage:link
```

## ✅ Quick Verification Commands

Run these commands to verify everything is set up:

```bash
# Check if .env exists and has APP_KEY
php artisan key:generate --show

# Test database connection
php artisan migrate:status

# Clear config cache
php artisan config:clear

# Check if storage link exists
php artisan storage:link
```

## 📝 If You Need to Recreate .env

1. Copy from example:
```bash
copy .env.example .env
```

2. Generate application key:
```bash
php artisan key:generate
```

3. Update database settings manually in `.env` file

4. Run migrations:
```bash
php artisan migrate
```
