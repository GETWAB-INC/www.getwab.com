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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Токен от платёжной системы (Stripe, PayPal и т.п.)
            $table->string('token', 255)->unique();
            
            // Данные карты (только безопасные)
            $table->string('last_four', 4);
            $table->string('brand', 20);         // Visa, MasterCard
            $table->integer('exp_month');     // 1-12
            $table->integer('exp_year');        // 2025, 2026
            
            // Флаги
            $table->boolean('is_default')->default(false); // основная карта
            $table->boolean('is_active')->default(true);  // активна ли карта
            
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'is_default', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
