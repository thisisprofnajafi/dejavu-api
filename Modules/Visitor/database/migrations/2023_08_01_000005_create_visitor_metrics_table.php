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
        Schema::create('visitor_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('metric_date');
            $table->string('metric_type');
            $table->string('metric_name');
            $table->float('value', 12, 2)->default(0);
            $table->string('dimension')->nullable();
            $table->string('dimension_value')->nullable();
            $table->json('additional_data')->nullable();
            $table->timestamps();
            
            $table->unique(['metric_date', 'metric_type', 'metric_name', 'dimension', 'dimension_value'], 'visitor_metrics_unique');
            $table->index('metric_date');
            $table->index('metric_type');
            $table->index('metric_name');
            $table->index(['dimension', 'dimension_value']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_metrics');
    }
}; 