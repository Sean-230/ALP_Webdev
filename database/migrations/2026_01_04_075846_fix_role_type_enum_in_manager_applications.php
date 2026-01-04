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
        // For MySQL, modify the enum to use vendorManager instead of vendor_manager
        DB::statement("ALTER TABLE manager_applications MODIFY COLUMN role_type ENUM('eventManager', 'vendorManager') DEFAULT 'eventManager'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to old enum values
        DB::statement("ALTER TABLE manager_applications MODIFY COLUMN role_type ENUM('eventManager', 'vendor_manager') DEFAULT 'eventManager'");
    }
};
