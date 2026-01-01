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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ID of the user who owns the subscription');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->index();
            $table->unsignedBigInteger('billing_record_id')->nullable()->index()->comment('ID of the associated billing record (may be NULL if no payment has been processed yet)');
            $table->foreign('billing_record_id')->references('id')->on('billing_records')->onDelete('set null');
            $table->string('subscription_type', 50)->index()->comment("Type of subscription ('fpds_query', 'fpds_reports', 'fpds_charts')");
            $table->string('status', 20)->index()->comment("Current status of the subscription ('active', 'trial', 'cancelled', 'expired', 'suspended')");
            $table->string('plan', 20)->index()->comment("Billing plan ('trial', 'monthly', 'annual')");
            $table->timestamp('start_at')->nullable()->index()->comment('Date when the subscription becomes active');
            $table->timestamp('next_billing_at')->nullable()->index()->comment('Next scheduled date for billing/payment');
            $table->timestamp('expires_at')->nullable()->index()->comment('Expiration date of the subscription');
            $table->timestamp('trial_start_at')->nullable()->index()->comment('Start date of the free trial period');
            $table->timestamp('trial_end_at')->nullable()->index()->comment('End date of the free trial period');
            $table->timestamp('cancelled_at')->nullable()->index()->comment('Date when the subscription was cancelled by user');
            $table->decimal('amount', 10, 2)->default('0')->index()->comment('Amount to be charged for the subscription');
            $table->string('currency', 3)->default('USD')->index()->comment('Currency code for the subscription amount');
            $table->string('payment_gateway_id')->nullable()->index()->comment('External transaction ID from the payment gateway');
            $table->text('notes')->nullable()->default(null)->comment('Internal notes or comments (e.g., reason for cancellation, special terms)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
