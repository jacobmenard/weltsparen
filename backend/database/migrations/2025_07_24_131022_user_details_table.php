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
        Schema::create('users_details', function (Blueprint $table) {
            $table->id('user_detail_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('street')->default('');
            $table->string('house_no')->default('');
            $table->string('zip')->default('');
            $table->string('city')->default('');
            $table->string('marital_status')->default('');
            $table->string('profession')->default('');
            $table->string('place_of_birth')->default('');
            $table->string('country_of_birth')->default('');
            $table->string('nationality')->default('');
            $table->string('nationality_2')->default('');
            $table->string('country_tax_residence')->default('');
            $table->string('country_us_tax')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_details');
    }
};
