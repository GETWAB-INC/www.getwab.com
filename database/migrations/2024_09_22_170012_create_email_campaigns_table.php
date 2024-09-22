<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailCampaignsTable extends Migration
{
    public function up()
    {
        Schema::create('email_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email');
            $table->string('company_name')->nullable();
            $table->string('contract_id')->nullable();
            $table->string('contract_topic')->nullable();
            $table->text('contract_description')->nullable();
            $table->text('additional_details')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->tinyInteger('subscribe')->default(0);
            $table->date('hello_email')->nullable();
            $table->date('hello_email_again')->nullable();
            $table->date('last_email_at')->nullable();
            $table->timestamps();

            $table->index('recipient_email', 'email_index');
            $table->index('company_name', 'company_index');
            $table->index('contract_id', 'contract_id_index');
            $table->index(['contract_start_date', 'contract_end_date', 'hello_email', 'hello_email_again', 'last_email_at'], 'contract_dates_index');

        });
    }

    public function down()
    {
        Schema::dropIfExists('email_campaigns');
    }
}
