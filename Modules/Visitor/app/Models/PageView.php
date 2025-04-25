<?php

namespace Modules\Visitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Visitor\Database\Factories\PageViewFactory;

class PageView extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'visitor_id',
        'visitor_session_id',
        'url',
        'page_title',
        'referrer',
        'time_spent',
        'query_params',
        'view_timestamp',
        'page_type',
        'route_name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'time_spent' => 'integer',
        'query_params' => 'json',
        'view_timestamp' => 'datetime',
    ];

    /**
     * Get the visitor that owns the page view.
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    /**
     * Get the session associated with the page view.
     */
    public function session()
    {
        return $this->belongsTo(VisitorSession::class, 'visitor_session_id');
    }

    /**
     * Scope for page views by page type.
     */
    public function scopeOfType($query, $pageType)
    {
        return $query->where('page_type', $pageType);
    }

    /**
     * Scope for page views by URL pattern.
     */
    public function scopeUrlContains($query, $pattern)
    {
        return $query->where('url', 'like', '%' . $pattern . '%');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PageViewFactory::new();
    }
} 