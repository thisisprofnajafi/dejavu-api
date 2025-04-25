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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->string('subject');
            $table->text('content');
            $table->string('status')->default('open');
            $table->string('priority')->default('medium');
            $table->string('ticket_number')->unique();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('last_response_at')->nullable();
            $table->unsignedBigInteger('last_response_by')->nullable();
            $table->string('source')->default('web');
            $table->string('related_entity_type')->nullable();
            $table->unsignedBigInteger('related_entity_id')->nullable();
            $table->timestamps();
            
            $table->foreign('assigned_to')->references('id')->on('users')->nullOnDelete();
            $table->foreign('last_response_by')->references('id')->on('users')->nullOnDelete();
            
            $table->index('status');
            $table->index('priority');
            $table->index('ticket_number');
            $table->index('assigned_to');
            $table->index(['related_entity_type', 'related_entity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
}; 