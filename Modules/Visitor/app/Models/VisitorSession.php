<?php

namespace Modules\Visitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Visitor\Database\Factories\VisitorSessionFactory;

class VisitorSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'visitor_id',
        'session_id',
        'entry_page',
        'exit_page',
        'duration',
        'page_views_count',
        'started_at',
        'ended_at',
        'is_bounce',
        'device_info'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'duration' => 'integer',
        'page_views_count' => 'integer',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'is_bounce' => 'boolean',
        'device_info' => 'json',
    ];

    /**
     * Get the visitor that owns the session.
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    /**
     * Get the page views for this session.
     */
    public function pageViews()
    {
        return $this->hasMany(PageView::class);
    }

    /**
     * Get the events for this session.
     */
    public function events()
    {
        return $this->hasMany(VisitorEvent::class);
    }

    /**
     * Scope for bounce sessions.
     */
    public function scopeBounce($query)
    {
        return $query->where('is_bounce', true);
    }

    /**
     * Scope for sessions longer than the specified duration (in seconds).
     */
    public function scopeLongerThan($query, $seconds)
    {
        return $query->where('duration', '>', $seconds);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return VisitorSessionFactory::new();
    }
} 