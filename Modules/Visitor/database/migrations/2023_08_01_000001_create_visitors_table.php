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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('country', 2)->nullable();
            $table->string('city')->nullable();
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('device_type')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('landing_page')->nullable();
            $table->string('language', 10)->nullable();
            $table->boolean('is_unique')->default(true);
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
            
            $table->index('ip_address');
            $table->index('country');
            $table->index('device_type');
            $table->index('utm_source');
            $table->index('utm_medium');
            $table->index('utm_campaign');
            $table->index('is_unique');
            $table->index('last_activity_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
}; 