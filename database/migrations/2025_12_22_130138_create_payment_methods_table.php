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
            $table->id()->comment('Primary key, auto‑incrementing ID of the payment method record');
            $table->unsignedBigInteger('user_id')->index()->comment('ID of the user who owns this payment method');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('token', 255)->unique()->index()->comment('Token from the payment gateway used to reference this payment method');
            $table->string('last_four', 4)->index()->comment('Last 4 digits of the credit/debit card — only safe part stored');
            $table->string('brand', 20)->index()->comment('Brand of the payment card (e.g., Visa, MasterCard, American Express)');
            $table->integer('exp_month')->index()->comment('Expiration month of the card (1–12)');
            $table->integer('exp_year')->index()->comment('Expiration year of the card (e.g., 2025, 2026)');
            $table->boolean('is_default')->default(false)->index()->comment('Flag indicating whether this is the user’s default payment method');
            $table->boolean('is_active')->default(true)->index()->comment('Flag indicating whether the payment method is currently active and can be used for charges');
            $table->timestamps();
            $table->softDeletes();
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
