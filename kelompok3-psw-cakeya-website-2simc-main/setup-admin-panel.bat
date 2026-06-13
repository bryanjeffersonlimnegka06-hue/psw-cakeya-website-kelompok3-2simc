@echo off
REM Admin Panel Setup Script for Cakeya (Windows)
REM This script sets up all necessary components for the admin panel

echo.
echo ======================================
echo Cakeya Admin Panel Setup
echo ======================================
echo.

REM Check if Laravel is installed
if not exist "artisan" (
    echo Error: Laravel artisan not found. Please run this script from the Laravel root directory.
    pause
    exit /b 1
)

echo Laravel installation found.
echo.

REM Step 1: Check environment file
echo Step 1: Verifying .env configuration...
echo (Manual check - ensure DB_CONNECTION=mysql and DB_DATABASE=cake)
echo.

REM Step 2: Run migrations
echo Step 2: Running database migrations...
echo This will:
echo   - Add is_admin column to users table
echo   - Create admin_users table
echo   - Ensure cake table structure
echo   - Create default admin user
echo.

php artisan migrate

echo.

REM Step 3: Display admin credentials
echo Step 3: Admin Panel Setup Complete!
echo.
echo ======================================
echo DEFAULT ADMIN CREDENTIALS
echo ======================================
echo Email:    admin@cakeya.local
echo Password: admin123
echo.
echo IMPORTANT: Change these credentials immediately after first login!
echo.
echo ======================================
echo NEXT STEPS
echo ======================================
echo 1. Start Laravel development server:
echo    php artisan serve
echo.
echo 2. Open your browser and navigate to:
echo    http://localhost:8000/admin/login
echo.
echo 3. Log in with the credentials above
echo.
echo 4. Change your password in admin settings
echo.
echo For more information, see: ADMIN_PANEL_SETUP.md
echo ======================================
echo.

pause
