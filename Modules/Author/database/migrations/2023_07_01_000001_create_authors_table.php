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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('bio')->nullable();
            $table->string('website')->nullable();
            $table->json('social_media')->nullable();
            $table->string('pseudonym')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verification_date')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            
            $table->index('status');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
}; 