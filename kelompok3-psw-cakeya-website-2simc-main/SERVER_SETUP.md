# 🚀 Cakeya Website - Server Setup & Development Guide

A complete guide to set up and run the Cakeya Laravel website locally.

## 📋 Table of Contents

1. [Prerequisites](#prerequisites)
2. [Installation](#installation)
3. [Running the Server](#running-the-server)
4. [Database Setup](#database-setup)
5. [Development Tools](#development-tools)
6. [Project Structure](#project-structure)
7. [Common Commands](#common-commands)
8. [Troubleshooting](#troubleshooting)

---

## 📦 Prerequisites

Before you begin, ensure you have the following installed on your system:

### Required Software
- **PHP** 8.1 or higher
  - Verify: `php -v`
  - [Download PHP](https://www.php.net/downloads)
- **Composer** (PHP dependency manager)
  - Verify: `composer -v`
  - [Download Composer](https://getcomposer.org)
- **Node.js** & **npm** (JavaScript runtime & package manager)
  - Verify: `node -v` and `npm -v`
  - [Download Node.js](https://nodejs.org)
- **MySQL/MariaDB** (Database)
  - Verify: `mysql --version`
  - [Download MySQL](https://www.mysql.com/downloads/)

### PHP Extensions Required
The following PHP extensions should be enabled:
- `php-mbstring`
- `php-json`
- `php-pdo`
- `php-pdo_mysql`
- `php-curl`
- `php-fileinfo`
- `php-gd` (for image handling)

Check enabled extensions: `php -m`

---

## 🔧 Installation

### Step 1: Clone/Extract the Project
```bash
# Navigate to your project directory
cd kelompok3-psw-cakeya-website-2simc-main
```

### Step 2: Install PHP Dependencies
```bash
composer install
```
This installs all Laravel packages and dependencies from `composer.json`.

### Step 3: Install JavaScript Dependencies
```bash
npm install
```
This installs frontend dependencies including Vite for asset bundling.

### Step 4: Create Environment File
```bash
# Copy the example environment file
cp .env.example .env

# Or on Windows:
copy .env.example .env
```

### Step 5: Generate Application Key
```bash
php artisan key:generate
```
This generates a unique `APP_KEY` for your application in the `.env` file.

### Step 6: Configure Database
Edit the `.env` file and update database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cakeya
DB_USERNAME=root
DB_PASSWORD=
```

**Create the database:**
```bash
# Using MySQL command line
mysql -u root -p

# Then in MySQL:
CREATE DATABASE cakeya;
EXIT;
```

### Step 7: Run Database Migrations
```bash
php artisan migrate
```
This creates all necessary database tables and sets up the admin user.

---

## 🌐 Running the Server

### Option 1: Using Laravel's Built-in Server (Recommended for Development)

**Terminal 1 - Start Laravel Server:**
```bash
php artisan serve
```
Output:
```
Starting Laravel development server: http://127.0.0.1:8000
```
Access at: `http://localhost:8000`

**Terminal 2 - Start Vite Development Server (for hot reload):**
```bash
npm run dev
```
This starts the frontend build tools with hot module replacement.

---

### Option 2: Using Apache/Nginx (Production-like Setup)

Configure your web server to point to the `public` directory and set the document root appropriately.

---

## 🗄️ Database Setup

### Run All Migrations
```bash
php artisan migrate
```

### Specific Migrations
```bash
# See all migration status
php artisan migrate:status

# Rollback last migration
php artisan migrate:rollback

# Reset all migrations
php artisan migrate:reset

# Refresh all migrations (resets and reruns)
php artisan migrate:refresh

# Refresh with seed data
php artisan migrate:refresh --seed
```

### Included Migrations
1. `0001_01_01_000000_create_users_table` - User authentication
2. `0001_01_01_000001_create_cache_table` - Application cache
3. `0001_01_01_000002_create_jobs_table` - Job queue
4. `2025_01_01_000003_add_is_admin_to_users_table` - Admin role
5. `2025_01_01_000004_create_admin_users_table` - Admin users table
6. `2025_01_01_000005_ensure_cake_table_structure` - Cake products table
7. `2025_01_01_000006_create_default_admin_user` - Default admin account

---

## 🎨 Development Tools

### Vite - Frontend Build Tool
Vite provides fast development and optimized production builds.

**Development Mode (with hot reload):**
```bash
npm run dev
```

**Production Build:**
```bash
npm run build
```

**Configuration:** `vite.config.js`

---

## 📁 Project Structure

```
kelompok3-psw-cakeya-website-2simc-main/
├── app/                           # Application code
│   ├── Http/
│   │   ├── Controllers/           # Controllers
│   │   └── Middleware/            # Middleware
│   ├── Models/                    # Database models
│   └── Providers/                 # Service providers
├── bootstrap/                     # Application bootstrap files
├── config/                        # Configuration files
├── database/
│   ├── migrations/                # Database migrations
│   ├── factories/                 # Model factories
│   └── seeders/                   # Database seeders
├── public/                        # Public files (images, assets)
│   ├── product-image/             # Product images
│   ├── home-image/                # Homepage images
│   └── about-image/               # About page images
├── resources/
│   ├── css/                       # CSS files
│   ├── js/                        # JavaScript files
│   └── views/                     # Blade templates
│       ├── Admin-Panel/           # Admin panel views
│       └── psw-project-company-profile-2simc/
├── routes/                        # Route definitions
│   ├── web.php                    # Web routes
│   └── console.php                # Console commands
├── storage/                       # Application storage
│   ├── app/                       # File uploads
│   ├── framework/                 # Cache, sessions
│   └── logs/                      # Application logs
├── tests/                         # Test files
├── vendor/                        # Composer packages
├── .env                           # Environment variables
├── .env.example                   # Example environment file
├── composer.json                  # PHP dependencies
├── package.json                   # JavaScript dependencies
└── vite.config.js                 # Vite configuration
```

---

## 🎯 Common Commands

### Artisan Commands

```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Optimize application
php artisan optimize

# View all available commands
php artisan list

# Generate a model with migration
php artisan make:model ModelName -m

# Create a new controller
php artisan make:controller ControllerName

# Create a new migration
php artisan make:migration migration_name

# Create a new middleware
php artisan make:middleware MiddlewareName
```

### Composer Commands

```bash
# Update packages
composer update

# Add a new package
composer require vendor/package

# Remove a package
composer remove vendor/package

# Dump autoloader
composer dump-autoload
```

### NPM Commands

```bash
# Install dependencies
npm install

# Run development server with hot reload
npm run dev

# Build for production
npm run build

# Run with specific configuration
npm run build -- --mode production
```

---

## 👨‍💼 Admin Panel Access

After running migrations, access the admin panel:

**URL:** `http://localhost:8000/admin/login`

**Default Credentials:**
- Email: `admin@cakeya.local`
- Password: `admin123`

⚠️ **Change these credentials immediately after first login!**

For complete admin panel documentation, see:
- [ADMIN_PANEL_SETUP.md](ADMIN_PANEL_SETUP.md)
- [README_ADMIN.md](README_ADMIN.md)

---

## 🐛 Troubleshooting

### Port 8000 Already in Use
```bash
# Find process using port 8000
netstat -ano | findstr :8000  # Windows
lsof -i :8000                 # Mac/Linux

# Use different port
php artisan serve --port=8001
```

### Database Connection Error
```
Error: SQLSTATE[HY000] [2002] No such file or directory
```
**Solution:**
- Verify MySQL is running
- Check `.env` database credentials
- Ensure database exists: `CREATE DATABASE cakeya;`

### Key Generation Error
```
Error: The APP_KEY must be set
```
**Solution:**
```bash
php artisan key:generate
```

### Permission Denied on Storage/Logs
```bash
# On Linux/Mac
chmod -R 775 storage bootstrap/cache

# On Windows, grant write permissions to the folders
```

### Vendor Issues
```bash
# Clear composer cache and reinstall
composer clear-cache
composer install
```

### Node Modules Issues
```bash
# Clear npm cache and reinstall
npm cache clean --force
npm install
```

### Page Not Found (404)
- Ensure `.env` contains correct `APP_URL`
- Check `routes/web.php` for defined routes
- Clear route cache: `php artisan route:clear`

### Blade Template Errors
- Check view file paths in `resources/views/`
- Ensure template syntax is correct
- Clear view cache: `php artisan view:clear`

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Vite Documentation](https://vitejs.dev)
- [MySQL Documentation](https://dev.mysql.com/doc)
- [PHP Documentation](https://www.php.net/docs.php)

---

## 🎓 Development Tips

1. **Always run migrations before first use:** `php artisan migrate`
2. **Keep two terminals open:** One for Laravel server, one for Vite
3. **Check logs for errors:** `storage/logs/laravel.log`
4. **Use Laravel Tinker for quick testing:** `php artisan tinker`
5. **Enable debug mode in development:** Set `APP_DEBUG=true` in `.env`

---

## 🤝 Contributing

For admin panel setup and customization, refer to the dedicated admin panel documentation files.

---

**Last Updated:** 2025-01-13  
**Laravel Version:** 11.x  
**PHP Version:** 8.1+  
**Node Version:** 18.x+
