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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('publication_id')->constrained('publications')->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('content');
            $table->string('status')->default('active'); // active, spam, deleted
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            $table->index('user_id');
            $table->index('publication_id');
            $table->index('parent_id');
            $table->index('status');
            $table->index('is_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
}; 