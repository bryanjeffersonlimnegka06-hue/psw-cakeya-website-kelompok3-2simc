<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a default admin user if users table exists
        if (Schema::hasTable('users')) {
            // Check if admin user already exists
            $adminExists = DB::table('users')
                ->where('email', 'admin@cakeya.local')
                ->exists();

            if (!$adminExists) {
                DB::table('users')->insert([
                    'name' => 'Admin',
                    'email' => 'admin@cakeya.local',
                    'password' => Hash::make('admin123'),
                    'is_admin' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete the admin user
        if (Schema::hasTable('users')) {
            DB::table('users')
                ->where('email', 'admin@cakeya.local')
                ->delete();
        }
    }
};
