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
        Schema::create('reports', function (Blueprint $table) {
            $table->id()->comment('Primary key, auto‑incrementing ID of the report record');
            $table->unsignedBigInteger('user_id')->index()->comment('ID of the user who created/owns this report');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('report_id')->nullable()->unique()->index()->comment('External/unique identifier of the report (may be NULL if not assigned yet)');
            $table->string('report_code')->index()->comment('Internal code/reference for the report type or category');
            $table->string('title')->index()->comment('Human‑readable title/name of the report');
            $table->string('status')->default('draft')->index()->comment("Current status of the report");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
