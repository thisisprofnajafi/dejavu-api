<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Support\Database\Factories\TicketResponseFactory;
use App\Models\User;

class TicketResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',
        'user_id',
        'content',
        'is_agent',
        'is_private'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_agent' => 'boolean',
        'is_private' => 'boolean',
    ];

    /**
     * Get the ticket that the response belongs to.
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get the user who created the response.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attachments for the response.
     */
    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }

    /**
     * Scope for agent responses.
     */
    public function scopeFromAgents($query)
    {
        return $query->where('is_agent', true);
    }

    /**
     * Scope for customer responses.
     */
    public function scopeFromCustomers($query)
    {
        return $query->where('is_agent', false);
    }

    /**
     * Scope for private responses.
     */
    public function scopePrivate($query)
    {
        return $query->where('is_private', true);
    }

    /**
     * Scope for public responses.
     */
    public function scopePublic($query)
    {
        return $query->where('is_private', false);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TicketResponseFactory::new();
    }
} 