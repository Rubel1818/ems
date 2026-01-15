<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ১. আগে কলামের নাম পরিবর্তন করুন
            $table->renameColumn('name', 'name_eng');
        });

        Schema::table('users', function (Blueprint $table) {
            // ২. এখন নতুন কলামগুলো যুক্ত করুন name_eng এর পরে
            $table->string('name_ban')->nullable()->after('name_eng');
            $table->string('mobile')->nullable()->unique()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name_eng', 'name');
            $table->dropColumn(['name_ban', 'mobile']);
        });
    }
};
