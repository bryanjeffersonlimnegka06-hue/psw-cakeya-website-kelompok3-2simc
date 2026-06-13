<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        try {
            $totalCakes = DB::table('cake')->count();
            $totalUsers = DB::table('users')->count();
            $recentCakes = DB::table('cake')->latest()->take(5)->get();
            $topSellers = DB::table('cake')->orderBy('penjualan', 'desc')->take(5)->get();

            return view('admin-dashboard-page.admin.dashboard', compact(
                'totalCakes',
                'totalUsers',
                'recentCakes',
                'topSellers'
            ));
        } catch (\Exception $e) {
            return view('admin-dashboard-page.admin.dashboard', [
                'totalCakes' => 0,
                'totalUsers' => 0,
                'recentCakes' => [],
                'topSellers' => [],
                'error' => 'Database connection error. Please check your configuration.'
            ]);
        }
    }
}
