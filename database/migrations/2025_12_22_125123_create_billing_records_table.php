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
            $table->id()->comment('Primary key, auto‑incrementing ID of the billing record');
            $table->unsignedBigInteger('user_id')->comment('ID of the user who made the payment');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('billed_at')->index()->comment('Date and time when the payment was recorded');
            $table->string('description', 255)->index()->comment('Human‑readable description of the charge (e.g., "FPDS Query Trial (Monthly)")');
            $table->string('card_last_four', 4)->index()->comment('Last 4 digits of the credit/debit card used for payment');
            $table->string('card_brand', 20)->index()->comment('Brand of the payment card (e.g., Visa, MasterCard, American Express)');
            $table->decimal('amount', 12, 2)->index()->comment('Amount charged to the customer (e.g., 9.99)');
            $table->string('currency', 3)->default('USD')->index()->comment('Currency code for the transaction amount (e.g., USD, EUR)');
            $table->string('status', 20)->index()->comment("Current status of the payment (e.g., 'Paid', 'Declined', 'Pending', 'Refunded')");
            $table->string('gateway_transaction_id', 100)->nullable()->index()->comment('Unique identifier of the transaction in the payment gateway');
            $table->timestamps();
            $table->softDeletes();
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
