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
        Schema::table('employees', function (Blueprint $col) {
            // কলামগুলো রিমুভ করার কমান্ড
            $col->dropColumn(['name_bn', 'name_en', 'office_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $col) {
            // ভুলবশত রোলব্যাক করলে যাতে কলামগুলো আবার ফিরে আসে
            $col->string('name_bn')->nullable();
            $col->string('name_en')->nullable();
            $col->string('office_name')->nullable();
        });
    }
};
