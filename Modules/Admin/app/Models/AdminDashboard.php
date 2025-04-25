<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\Factories\AdminDashboardFactory;
use Modules\User\Models\User;

class AdminDashboard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'is_default',
        'layout',
        'widgets',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_default' => 'boolean',
        'layout' => 'array',
        'widgets' => 'array',
    ];

    /**
     * Get the user who owns this dashboard.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for default dashboards
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Scope for dashboards by user ID
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Add a widget to the dashboard
     *
     * @param array $widget
     * @return self
     */
    public function addWidget(array $widget)
    {
        $widgets = $this->widgets ?? [];
        $widgets[] = $widget;
        
        $this->widgets = $widgets;
        $this->save();
        
        return $this;
    }

    /**
     * Remove a widget from the dashboard
     *
     * @param string $widgetId
     * @return self
     */
    public function removeWidget(string $widgetId)
    {
        $widgets = $this->widgets ?? [];
        
        $this->widgets = array_filter($widgets, function ($widget) use ($widgetId) {
            return $widget['id'] !== $widgetId;
        });
        
        $this->save();
        
        return $this;
    }

    /**
     * Update dashboard layout
     *
     * @param array $layout
     * @return self
     */
    public function updateLayout(array $layout)
    {
        $this->layout = $layout;
        $this->save();
        
        return $this;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdminDashboardFactory::new();
    }
} 