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
        Schema::table('users', function (Blueprint $table) {
            // surname после name
            $table->string('surname')->nullable()->after('name');

            // job после surname
            $table->string('job')->nullable()->after('surname');

            // organization после job
            $table->string('organization')->nullable()->after('job');

            // phone после email_verified_at
            $table->string('phone')->nullable()->after('email_verified_at');

            // phone_verified_at после phone
            $table->timestamp('phone_verified_at')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('job');
            $table->dropColumn('organization');
            $table->dropColumn('phone');
            $table->dropColumn('phone_verified_at');
        });
    }
};
