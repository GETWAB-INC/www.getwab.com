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
            
            // Связь с пользователем
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            
            // Тип подписки (например, 'fpds_query', 'fpds_reports')
            $table->string('subscription_type', 50);
            
            
            // Статус: 'active', 'trial', 'cancelled', 'expired', 'suspended'
            $table->string('status', 20)->default('trial');
            
            
            // План: 'monthly', 'yearly', 'trial', 'custom'
            $table->string('plan', 20);
            
            // Дата начала подписки
            $table->timestamp('starts_at')->nullable();
            
            // Следующая дата биллинга
            $table->timestamp('next_billing_at')->nullable();
            
            // Дата окончания триала или подписки
            $table->timestamp('expires_at')->nullable();
            
            // Сумма платежа
            $table->decimal('amount', 10, 2); // например, 49.00
            $table->string('currency', 3)->default('USD');
            
            
            // Дополнительный контекст (например, ID платежа в платёжной системе)
            $table->string('payment_gateway_id')->nullable();
            $table->text('notes')->nullable(); // для внутренних пометок
            
            // Временные метки
            $table->timestamps();
            $table->softDeletes(); // на случай мягкого удаления
            
            // Индексы для ускорения запросов
            $table->index(['user_id', 'status']);
            $table->index('subscription_type');
            $table->index('expires_at');
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
