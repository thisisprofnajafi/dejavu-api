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
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors')->onDelete('cascade');
            $table->foreignId('visitor_session_id')->nullable()->constrained('visitor_sessions')->onDelete('cascade');
            $table->string('url');
            $table->string('page_title')->nullable();
            $table->string('referrer')->nullable();
            $table->integer('time_spent')->default(0); // in seconds
            $table->json('query_params')->nullable();
            $table->timestamp('view_timestamp')->nullable();
            $table->string('page_type')->nullable();
            $table->string('route_name')->nullable();
            $table->timestamps();
            
            $table->index('visitor_id');
            $table->index('visitor_session_id');
            $table->index('url');
            $table->index('page_type');
            $table->index('view_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
}; 