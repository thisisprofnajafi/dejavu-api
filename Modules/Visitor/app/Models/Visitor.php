<?php

namespace Modules\Visitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Visitor\Database\Factories\VisitorFactory;

class Visitor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ip_address',
        'user_agent',
        'referrer',
        'country',
        'city',
        'browser',
        'os',
        'device_type',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'landing_page',
        'language',
        'is_unique',
        'last_activity_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_unique' => 'boolean',
        'last_activity_at' => 'datetime',
    ];

    /**
     * Get the visitor sessions for this visitor.
     */
    public function sessions()
    {
        return $this->hasMany(VisitorSession::class);
    }

    /**
     * Get the page views for this visitor.
     */
    public function pageViews()
    {
        return $this->hasMany(PageView::class);
    }

    /**
     * Get the events for this visitor.
     */
    public function events()
    {
        return $this->hasMany(VisitorEvent::class);
    }

    /**
     * Scope for unique visitors.
     */
    public function scopeUnique($query)
    {
        return $query->where('is_unique', true);
    }

    /**
     * Scope for visitors from a specific country.
     */
    public function scopeFromCountry($query, $country)
    {
        return $query->where('country', $country);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return VisitorFactory::new();
    }
} 