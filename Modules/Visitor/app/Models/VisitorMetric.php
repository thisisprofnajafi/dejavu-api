<?php

namespace Modules\Visitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Visitor\Database\Factories\VisitorMetricFactory;

class VisitorMetric extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'metric_date',
        'metric_type',
        'metric_name',
        'value',
        'dimension',
        'dimension_value',
        'additional_data'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metric_date' => 'date',
        'value' => 'float',
        'additional_data' => 'json',
    ];

    /**
     * Scope for metrics of a specific type.
     */
    public function scopeOfType($query, $metricType)
    {
        return $query->where('metric_type', $metricType);
    }

    /**
     * Scope for metrics with a specific name.
     */
    public function scopeNamed($query, $metricName)
    {
        return $query->where('metric_name', $metricName);
    }

    /**
     * Scope for metrics in a date range.
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('metric_date', [$startDate, $endDate]);
    }

    /**
     * Scope for metrics with a specific dimension.
     */
    public function scopeWithDimension($query, $dimension, $value = null)
    {
        $query = $query->where('dimension', $dimension);
        
        if ($value !== null) {
            $query->where('dimension_value', $value);
        }
        
        return $query;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return VisitorMetricFactory::new();
    }
} 