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
        Schema::create('billing_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamp('billed_at');
            $table->string('description', 255);
            $table->string('card_last_four', 4); // последние 4 цифры
            $table->string('card_brand', 20);   // Visa, MasterCard, etc.
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('USD');
            $table->string('status', 20);       // Paid, Declined, Pending, Refunded
            $table->string('gateway_transaction_id', 100)->nullable(); // ID от платёжной системы
            
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'billed_at']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_records');
    }
};
