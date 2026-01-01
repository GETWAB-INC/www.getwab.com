<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Primary key, auto‑incrementing ID of the user record');

            $table->string('name')->index()->comment('First name of the user');
            $table->string('surname')->nullable()->index()->comment('Last name/surname of the user (optional)');
            $table->string('job')->nullable()->index()->comment('Job title or position of the user (optional)');
            $table->string('organization')->nullable()->index()->comment('Company or organization the user belongs to (optional)');
            $table->string('email')->unique()->index()->comment('Unique email address of the user — used for login and communication');
            $table->timestamp('email_verified_at')->index()->nullable()->comment('Timestamp when the user’s email was verified (NULL if not verified)');
            $table->string('phone')->nullable()->index()->comment('Phone number of the user (optional, for contact or 2FA)');
            $table->timestamp('phone_verified_at')->index()->nullable()->comment('Timestamp when the user’s phone was verified (NULL if not verified)');
            $table->string('password')->index()->comment('Hashed password for user authentication');
            $table->rememberToken()->index()->comment('Token for "remember me" functionality in login sessions');
            $table->string('avatar')->index()->nullable()->comment('URL or path to the user’s profile picture (optional)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
