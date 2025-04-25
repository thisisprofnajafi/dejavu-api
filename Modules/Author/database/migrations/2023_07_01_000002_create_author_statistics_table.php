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
        Schema::create('author_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
            $table->integer('publication_count')->default(0);
            $table->integer('total_views')->default(0);
            $table->integer('total_comments')->default(0);
            $table->integer('total_likes')->default(0);
            $table->integer('total_shares')->default(0);
            $table->float('average_rating')->default(0);
            $table->integer('total_followers')->default(0);
            $table->integer('total_awards')->default(0);
            $table->timestamp('last_publication_date')->nullable();
            $table->timestamps();
            
            $table->index('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_statistics');
    }
}; 