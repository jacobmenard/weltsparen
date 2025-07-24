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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('username')->after('id')->required();
            $table->string('status')->default('ACTIVE')->after('username');
            $table->string('firstname')->default('')->after('email');
            $table->string('lastname')->default('')->after('firstname');
            $table->string('type')->default('USER')->after('lastname');
            $table->string('display_name')->default('')->after('type');
            $table->string('salutation')->default('')->after('display_name');
            $table->string('title')->default('')->after('salutation');
            $table->date('birthday')->nullable()->after('title');
            $table->string('mobile')->default('')->after('title');
            $table->datetime('last_login_at')->after('remember_token')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // NOTE: This is a one-way migration and cannot be reversed.
    }
};
