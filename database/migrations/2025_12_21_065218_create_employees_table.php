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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('photo')->nullable();

            $table->string('name_bn');
            $table->string('name_en');

            $table->string('designation_bn');
            $table->string('designation_en');

            $table->text('present_address_bn')->nullable();
            $table->text('present_address_en')->nullable();
            $table->text('present_district')->nullable();

            $table->text('permanent_address_bn')->nullable();
            $table->text('permanent_address_en')->nullable();
            $table->text('permanent_district')->nullable();

            $table->string('office_name')->nullable();
            $table->string('office_duration')->nullable();

            $table->date('birth_date')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('confirmation_date')->nullable();

            $table->string('service_book')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
