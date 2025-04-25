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
        Schema::create('visitor_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors')->onDelete('cascade');
            $table->string('session_id', 100)->unique();
            $table->string('entry_page')->nullable();
            $table->string('exit_page')->nullable();
            $table->integer('duration')->default(0); // in seconds
            $table->integer('page_views_count')->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->boolean('is_bounce')->default(false);
            $table->json('device_info')->nullable();
            $table->timestamps();
            
            $table->index('visitor_id');
            $table->index('session_id');
            $table->index('started_at');
            $table->index('ended_at');
            $table->index('is_bounce');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_sessions');
    }
}; 