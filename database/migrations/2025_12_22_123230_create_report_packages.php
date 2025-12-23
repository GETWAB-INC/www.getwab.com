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
        Schema::create('report_packages', function (Blueprint $table) {
            $table->id();
            
            // Связь с пользователем
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            // Тип пакета: 'el' (elementary) или 'coll' (composite)
            $table->string('package_type', 10);
            
            // Остаток доступных отчётов
            $table->integer('remaining_reports');
            
            // Временные метки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_packages');
    }
};
