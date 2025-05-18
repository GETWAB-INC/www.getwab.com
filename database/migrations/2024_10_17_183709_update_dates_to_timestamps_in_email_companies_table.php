<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDatesToTimestampsInEmailCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_companies', function (Blueprint $table) {
            $table->timestamp('hello_email')->nullable()->change();
            $table->timestamp('hello_email_again')->nullable()->change();
            $table->timestamp('last_email_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_companies', function (Blueprint $table) {
            $table->date('hello_email')->nullable()->change();
            $table->date('hello_email_again')->nullable()->change();
            $table->date('last_email_at')->nullable()->change();
        });
    }
}
