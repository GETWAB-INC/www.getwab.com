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
        Schema::create('report_parameters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id')->index()->comment('Foreign key referencing the primary key (id) of the reports table in the database');
            $table->foreign('report_id')
                ->references('id')->on('reports')
                ->onDelete('cascade');
            $table->string('parameter_key')->index()->comment('Name/key of the parameter (e.g., "year", "state", "department")');
            $table->string('parameter_value')->index()->comment('Value of the parameter; can be a string or number');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_parameters');
    }
};
