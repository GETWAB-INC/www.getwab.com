<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnsubscribeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unsubscribe_logs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('email'); // Email of the user unsubscribing
            $table->string('ip_address')->nullable(); // IP address of the user
            $table->text('user_agent')->nullable(); // User-agent string (browser/device info)
            $table->string('browser_language')->nullable(); // Browser language
            $table->string('time_zone')->nullable(); // Time zone
            $table->string('screen_resolution')->nullable(); // Screen resolution
            $table->string('referrer')->nullable(); // Referrer URL (page they came from)
            $table->timestamp('unsubscribed_at'); // Date/time of unsubscription
            $table->timestamps(); // created_at and updated_at columns

            // Adding indexes for optimized querying
            $table->index('email'); // Index for faster lookups by email
            $table->index('ip_address'); // Index for IP searches
            $table->index('unsubscribed_at'); // Index for queries by unsubscription time
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unsubscribe_logs');
    }
}
