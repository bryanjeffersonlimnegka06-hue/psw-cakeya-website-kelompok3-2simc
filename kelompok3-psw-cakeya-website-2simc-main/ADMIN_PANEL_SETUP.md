# Admin Panel Setup Guide

## Overview
The admin panel has been set up as a fully integrated Laravel system within the main Cakeya website repository. It provides comprehensive management for products, users, and dashboard analytics.

## Setup Instructions

### 1. Database Configuration
The admin panel uses the same database as the main application. Make sure your `.env` file is correctly configured:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cake
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Run Migrations
Execute the migrations to set up required database tables and columns:

```bash
php artisan migrate
```

This will:
- Add `is_admin` column to the `users` table
- Create `admin_users` table (optional alternative)
- Ensure the `cake` table has proper structure
- Create a default admin user

### 3. Default Admin Credentials
After running migrations, use these credentials to log in:

- **Email:** admin@cakeya.local
- **Password:** admin123

**⚠️ Important:** Change these credentials immediately after first login for security.

### 4. Access the Admin Panel
Navigate to: `http://localhost:8000/admin/login`

## File Structure

### Controllers
Located in `app/Http/Controllers/Admin/`:
- `AdminAuthController.php` - Handles login/logout
- `AdminDashboardController.php` - Dashboard statistics
- `AdminProductController.php` - Product CRUD operations

### Middleware
Located in `app/Http/Middleware/`:
- `IsAdmin.php` - Protects admin routes, checks for admin role

### Models
Located in `app/Models/`:
- `User.php` - Extended with `is_admin` field
- `Admin/AdminUser.php` - Alternative admin user model

### Views
Located in `resources/views/admin-dashboard-page/admin/`:
- `layouts/admin.blade.php` - Main admin layout template
- `login.blade.php` - Login page
- `dashboard.blade.php` - Dashboard with statistics
- `products.blade.php` - Product list
- `create-product.blade.php` - Add new product form
- `edit-product.blade.php` - Edit product form

### Routes
Configured in `routes/web.php`:
- Public routes: `/admin/login` (GET/POST)
- Protected routes: Require authentication and admin role
  - `/admin` - Dashboard
  - `/admin/products` - Product management (CRUD)
  - `/admin/logout` - Logout

## Features

### Dashboard
- Total products count
- Total users count
- Top-selling products
- Recently added products
- System information display

### Product Management
- **View Products:** Paginated list of all products with images
- **Add Product:** Create new products with:
  - Product name
  - Price (in Rupiah)
  - Description
  - Product image
- **Edit Product:** Update existing product information
- **Delete Product:** Remove products (with image cleanup)

### Authentication
- Secure login system
- Session-based authentication
- Admin role verification
- Logout functionality

## Security Features

✅ **Implemented:**
- Authentication middleware (`auth`)
- Admin authorization middleware (`is_admin`)
- CSRF protection on all forms
- Password hashing using Laravel's built-in `Hash` facade
- Input validation on all forms
- File upload validation (image type and size)
- SQL prepared statements via Eloquent/Query Builder

## Common Tasks

### Create New Admin User
```bash
php artisan tinker
```

Then run:
```php
App\Models\User::create([
    'name' => 'New Admin',
    'email' => 'newadmin@example.com',
    'password' => Hash::make('password'),
    'is_admin' => true,
]);
```

### Reset Admin Password
```bash
php artisan tinker
```

Then run:
```php
$user = App\Models\User::where('email', 'admin@cakeya.local')->first();
$user->password = Hash::make('newpassword');
$user->save();
```

### Troubleshooting

#### "View not found" Error
- Ensure all view files are created in `resources/views/admin-dashboard-page/admin/`
- Check view naming matches route references

#### Database Connection Error
- Verify `.env` file has correct database credentials
- Ensure MySQL/MariaDB is running
- Check database exists and is accessible

#### Migration Errors
- Run `php artisan migrate --force` if needed
- Check migration files in `database/migrations/` are properly formatted
- Ensure database user has CREATE/ALTER permissions

#### Login Fails
- Check admin user exists in database
- Verify password is correct
- Check `is_admin` field is set to `1` (true)

## Best Practices

1. **Always use migrations** for database changes
2. **Validate all inputs** before processing
3. **Use soft deletes** for important data (to be implemented)
4. **Regular backups** of the database
5. **Change default credentials** after first login
6. **Keep Laravel updated** for security patches
7. **Use environment variables** for sensitive data

## Future Enhancements

Consider implementing:
- User management interface
- Order/booking management
- Analytics and reporting
- Admin activity logging
- Role-based access control (RBAC)
- Two-factor authentication
- Admin notifications
- Bulk product import/export

## Support

For issues or questions, refer to:
- Laravel Documentation: https://laravel.com/docs
- Database Migrations: https://laravel.com/docs/migrations
- Authentication: https://laravel.com/docs/authentication

---
**Last Updated:** 2025-01-01
**Version:** 1.0
