<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Support\Database\Factories\TicketAttachmentFactory;
use App\Models\User;

class TicketAttachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',
        'ticket_response_id',
        'user_id',
        'file_name',
        'file_path',
        'file_size',
        'file_type',
        'is_image'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'file_size' => 'integer',
        'is_image' => 'boolean',
    ];

    /**
     * Get the ticket that owns the attachment.
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get the response that owns the attachment.
     */
    public function response()
    {
        return $this->belongsTo(TicketResponse::class, 'ticket_response_id');
    }

    /**
     * Get the user who uploaded the attachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for images.
     */
    public function scopeImages($query)
    {
        return $query->where('is_image', true);
    }

    /**
     * Scope for non-images.
     */
    public function scopeDocuments($query)
    {
        return $query->where('is_image', false);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TicketAttachmentFactory::new();
    }
} 