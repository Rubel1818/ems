<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Check safely (optional but recommended)
            if (Schema::hasColumn('employees', 'designation_bn')) {
                $table->dropColumn('designation_bn');
            }

            if (Schema::hasColumn('employees', 'designation_en')) {
                $table->dropColumn('designation_en');
            }

            if (Schema::hasColumn('employees', 'present_district')) {
                $table->dropColumn('present_district');
            }

            if (Schema::hasColumn('employees', 'permanent_district')) {
                $table->dropColumn('permanent_district');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('designation_bn')->nullable();
            $table->string('designation_en')->nullable();
            $table->string('present_district')->nullable();
            $table->string('permanent_district')->nullable();
        });
    }
};
