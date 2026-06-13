#!/bin/bash

# Admin Panel Setup Script for Cakeya
# This script sets up all necessary components for the admin panel

echo "======================================"
echo "Cakeya Admin Panel Setup"
echo "======================================"
echo ""

# Check if Laravel is installed
if [ ! -f "artisan" ]; then
    echo "❌ Error: Laravel artisan not found. Please run this script from the Laravel root directory."
    exit 1
fi

echo "✓ Laravel installation found."
echo ""

# Step 1: Check environment file
echo "Step 1: Verifying .env configuration..."
if grep -q "DB_CONNECTION=mysql" .env; then
    echo "✓ Database connection set to MySQL"
else
    echo "⚠️ Warning: Database connection not set to MySQL. Updating .env..."
    sed -i 's/DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
fi

if grep -q "DB_DATABASE=cake" .env; then
    echo "✓ Database name set to 'cake'"
else
    echo "⚠️ Warning: Database name not set to 'cake'. Updating .env..."
    sed -i 's/DB_DATABASE=.*/DB_DATABASE=cake/' .env
fi

echo ""

# Step 2: Run migrations
echo "Step 2: Running database migrations..."
echo "This will:"
echo "  - Add is_admin column to users table"
echo "  - Create admin_users table"
echo "  - Ensure cake table structure"
echo "  - Create default admin user"
echo ""

php artisan migrate

if [ $? -eq 0 ]; then
    echo "✓ Migrations completed successfully"
else
    echo "⚠️ Some migrations may have failed. Check the output above."
fi

echo ""

# Step 3: Display admin credentials
echo "Step 3: Admin Panel Setup Complete!"
echo ""
echo "======================================"
echo "DEFAULT ADMIN CREDENTIALS"
echo "======================================"
echo "Email:    admin@cakeya.local"
echo "Password: admin123"
echo ""
echo "⚠️ IMPORTANT: Change these credentials immediately after first login!"
echo ""
echo "======================================"
echo "NEXT STEPS"
echo "======================================"
echo "1. Start Laravel development server:"
echo "   php artisan serve"
echo ""
echo "2. Open your browser and navigate to:"
echo "   http://localhost:8000/admin/login"
echo ""
echo "3. Log in with the credentials above"
echo ""
echo "4. Change your password in admin settings"
echo ""
echo "For more information, see: ADMIN_PANEL_SETUP.md"
echo "======================================"
echo ""
