<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStatistic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'login_count',
        'last_login_at',
        'last_login_ip',
        'stores_count',
        'resumes_count',
        'views_count',
        'downloads_count',
        'ratings_average',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'login_count' => 'integer',
        'last_login_at' => 'datetime',
        'stores_count' => 'integer',
        'resumes_count' => 'integer',
        'views_count' => 'integer',
        'downloads_count' => 'integer',
        'ratings_average' => 'float',
    ];

    /**
     * Get the user associated with the statistics.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 