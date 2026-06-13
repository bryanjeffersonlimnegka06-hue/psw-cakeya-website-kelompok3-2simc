<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // <-- Add this at the very top of the file!
use Illuminate\Http\Request;
use App\Http\Controllers\DummyPaymentController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;

Route::get('/', function () {
    // Fetch the top 3 best-selling cakes
    $bestSellers = DB::table('cake')
                    ->orderBy('penjualan', 'desc')
                    ->take(3)
                    ->get(); 

    // Pass the data to your view
    return view('psw-project-company-profile-2simc.home-page.home', compact('bestSellers')); 
})->name('home');

Route::get('/about', function () {
    // Notice how you don't type ".blade.php" here, just the name of the file
    return view('psw-project-company-profile-2simc.about-us-page.about'); 
})->name('about');

Route::get('/contact', function () {
    return view('psw-project-company-profile-2simc.contact-page.contact'); 
})->name('contact');

Route::get('/book', function () {
    // Notice how you don't type ".blade.php" here, just the name of the file
    return view('psw-project-company-profile-2simc.booking-page.book'); 
})->name('book');

// ... your other routes ...

Route::get('/product', function () {
    $cakes = DB::table('cake')
                ->select('cake_id', 'cake_name', 'cost', 'description', 'pic', 'penjualan')
                ->orderBy('cake_id', 'desc')
                ->get();

    return view('psw-project-company-profile-2simc.product-page.product', compact('cakes')); 
})->name('product');

// Display the Add Product Form
Route::get('/productform', function () {
    return view('psw-project-company-profile-2simc.add-product-page.productform'); 
})->name('productform');

Route::post('/insert-product', function (Illuminate\Http\Request $request) {
    
    if ($request->hasFile('pic')) {
        
        $image = $request->file('pic');
        
        // 1. Grab ONLY the exact original file name
        $imageName = $image->getClientOriginalName();
        
        // 2. Move the file into your folder
        $image->move(public_path('product-image'), $imageName);

        // 3. Save that exact name into the database
        DB::table('cake')->insert([
            'cake_name'   => $request->input('name'),   
            'cost'        => $request->input('price'),  
            'description' => $request->input('description'),
            'pic'         => $imageName, 
            'penjualan'   => 0, 
        ]);
        
        return redirect()->route('product'); 
    }

    return "No image was uploaded!";
});

Route::post('/checkout/dummy-payment', [DummyPaymentController::class, 'processCheckout'])->name('checkout.dummy');

Route::get('/checkout', function () {
    return view('psw-project-company-profile-2simc.checkout-page.index');
});

// Admin Authentication Routes (Public)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Admin Protected Routes (Middleware)
Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout.direct');
    
    // Check if user is admin
    Route::middleware('is_admin')->group(function () {
        Route::get('/admin', function () {
            return redirect()->route('admin.panel');
        })->name('admin.dashboard');
        
        // Admin Panel Page
        Route::get('/admin/panel', function () {
            return response(file_get_contents(resource_path('views/Admin-Panel/product-list/admin-panel.html')), 200, [
                'Content-Type' => 'text/html; charset=utf-8'
            ]);
        })->name('admin.panel');

        Route::get('/admin/users', function () {
            return response(file_get_contents(resource_path('views/Admin-Panel/user-list/user-list.html')), 200, [
                'Content-Type' => 'text/html; charset=utf-8'
            ]);
        })->name('admin.users');
        
        // Admin API Routes for AJAX operations
        Route::get('/admin/api/cake-list', function () {
            ob_start();
            include resource_path('views/Admin-Panel/product-list/cake-data.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });
        
        Route::post('/admin/api/add-cake', function () {
            ob_start();
            include resource_path('views/Admin-Panel/product-list/add-cake.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });
        
        Route::post('/admin/api/edit-cake', function () {
            ob_start();
            include resource_path('views/Admin-Panel/product-list/edit-cake.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });
        
        Route::post('/admin/api/delete-cake', function () {
            ob_start();
            include resource_path('views/Admin-Panel/product-list/delete-cake.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });

        Route::get('/admin/api/user-list', function () {
            ob_start();
            include resource_path('views/Admin-Panel/user-list/user-data.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });

        Route::post('/admin/api/add-user', function () {
            ob_start();
            include resource_path('views/Admin-Panel/user-list/add-user.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });

        Route::post('/admin/api/edit-user', function () {
            ob_start();
            include resource_path('views/Admin-Panel/user-list/edit-user.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });

        Route::post('/admin/api/delete-user', function () {
            ob_start();
            include resource_path('views/Admin-Panel/user-list/delete-user.php');
            $output = ob_get_clean();
            return response($output, 200, ['Content-Type' => 'application/json']);
        });
        
        // Admin Products Routes
        Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
        Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    });
});
