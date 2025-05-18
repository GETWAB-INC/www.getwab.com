<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empstateweb_emails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company');
            $table->string('company_url');
            $table->string('subscribe')->nullable();
            $table->dateTime('hello_email_at')->nullable();
            $table->dateTime('hello_again_at')->nullable();
            $table->dateTime('last_email_at')->nullable();
            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('empstateweb_emails');
    }
};
