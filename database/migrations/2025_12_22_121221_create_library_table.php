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
        Schema::create('library', function (Blueprint $table) {
            $table->id();
            $table->string('report_code')->unique();
            $table->string('report_type');
            $table->string('report_category');
            $table->string('report_title');
            $table->text('report_description')->nullable();
            $table->text('report_methodology')->nullable();
            $table->text('report_usage')->nullable();
            $table->string('report_vars')->nullable();
            $table->decimal('report_price', 8, 2)->nullable();
            $table->timestamps();

            $table->index('report_code');
            $table->index('report_type');
            $table->index('report_category');
            $table->index('report_title');
            $table->index('report_vars');
            $table->index('report_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library');
    }
};
