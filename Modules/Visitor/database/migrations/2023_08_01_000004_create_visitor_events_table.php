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
        Schema::create('visitor_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors')->onDelete('cascade');
            $table->foreignId('visitor_session_id')->nullable()->constrained('visitor_sessions')->onDelete('cascade');
            $table->string('event_type');
            $table->string('event_name');
            $table->json('event_data')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('occurred_at')->nullable();
            $table->string('element_id')->nullable();
            $table->string('element_class')->nullable();
            $table->string('element_text')->nullable();
            $table->timestamps();
            
            $table->index('visitor_id');
            $table->index('visitor_session_id');
            $table->index('event_type');
            $table->index('event_name');
            $table->index('occurred_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_events');
    }
}; 