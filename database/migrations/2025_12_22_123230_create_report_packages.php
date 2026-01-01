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
            $table->id()->comment('Primary key, auto‑incrementing ID of the report package record');
            $table->unsignedBigInteger('user_id')->index()->comment('ID of the user who owns this report package');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('package_type', 10)->index()->comment("Type of the report package ('el' for elementary, 'coll' for composite)");
            $table->integer('remaining_reports')->index()->comment('Number of available reports remaining in this package (decrements with each use)');
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
