<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('specialization'); // Например, "Кибербезопасность"
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->decimal('hourly_rate', 8, 2); // Стоимость в час
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('professionals');
    }
};