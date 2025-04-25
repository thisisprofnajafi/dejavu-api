<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Support\Database\Factories\ContactFormFactory;
use App\Models\User;

class ContactForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'department_id',
        'user_id',
        'status',
        'responded_by',
        'responded_at',
        'ip_address',
        'user_agent'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'responded_at' => 'datetime',
    ];

    /**
     * Get the user who submitted the form, if registered.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department the form is directed to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the user who responded to the form.
     */
    public function respondedBy()
    {
        return $this->belongsTo(User::class, 'responded_by');
    }

    /**
     * Get the ticket created from this contact form.
     */
    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'related_entity_id')
            ->where('related_entity_type', 'contact_form');
    }

    /**
     * Scope for forms with pending status.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for forms that have been responded to.
     */
    public function scopeResponded($query)
    {
        return $query->whereNotNull('responded_at');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ContactFormFactory::new();
    }
} 