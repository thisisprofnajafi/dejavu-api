<?php

namespace Modules\Visitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Visitor\Database\Factories\VisitorEventFactory;

class VisitorEvent extends Model
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
        'event_type',
        'event_name',
        'event_data',
        'url',
        'occurred_at',
        'element_id',
        'element_class',
        'element_text'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_data' => 'json',
        'occurred_at' => 'datetime',
    ];

    /**
     * Get the visitor that triggered the event.
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    /**
     * Get the session associated with the event.
     */
    public function session()
    {
        return $this->belongsTo(VisitorSession::class, 'visitor_session_id');
    }

    /**
     * Scope for events of a specific type.
     */
    public function scopeOfType($query, $eventType)
    {
        return $query->where('event_type', $eventType);
    }

    /**
     * Scope for events with a specific name.
     */
    public function scopeNamed($query, $eventName)
    {
        return $query->where('event_name', $eventName);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return VisitorEventFactory::new();
    }
} 