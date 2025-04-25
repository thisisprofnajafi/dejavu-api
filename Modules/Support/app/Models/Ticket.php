<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Support\Database\Factories\TicketFactory;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'subject',
        'content',
        'status',
        'priority',
        'ticket_number',
        'assigned_to',
        'closed_at',
        'last_response_at',
        'last_response_by',
        'source',
        'related_entity_type',
        'related_entity_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'closed_at' => 'datetime',
        'last_response_at' => 'datetime',
    ];

    /**
     * Get the user who created the ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department the ticket belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the agent the ticket is assigned to.
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the user who last responded to the ticket.
     */
    public function lastResponseBy()
    {
        return $this->belongsTo(User::class, 'last_response_by');
    }

    /**
     * Get the responses for the ticket.
     */
    public function responses()
    {
        return $this->hasMany(TicketResponse::class)->orderBy('created_at', 'asc');
    }

    /**
     * Get the attachments for the ticket.
     */
    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }

    /**
     * Scope for open tickets.
     */
    public function scopeOpen($query)
    {
        return $query->where('status', '!=', 'closed');
    }

    /**
     * Scope for high priority tickets.
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    /**
     * Scope for tickets assigned to a specific user.
     */
    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    /**
     * Scope for tickets from a specific department.
     */
    public function scopeFromDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TicketFactory::new();
    }
} 