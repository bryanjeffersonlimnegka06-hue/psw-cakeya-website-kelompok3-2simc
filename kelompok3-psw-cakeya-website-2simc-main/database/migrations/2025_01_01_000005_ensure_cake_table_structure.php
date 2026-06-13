<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if cake table exists and add missing columns
        if (Schema::hasTable('cake')) {
            Schema::table('cake', function (Blueprint $table) {
                // Only add timestamps if they don't exist
                if (!Schema::hasColumn('cake', 'created_at')) {
                    $table->timestamps();
                }
                
                // Only add penjualan if it doesn't exist
                if (!Schema::hasColumn('cake', 'penjualan')) {
                    $table->integer('penjualan')->default(0);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is a safe migration, nothing to rollback
    }
};
