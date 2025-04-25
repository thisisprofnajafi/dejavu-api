<?php

namespace Modules\Author\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Author\Database\Factories\AuthorFactory;
use App\Models\User;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'bio',
        'website',
        'social_media',
        'pseudonym',
        'is_verified',
        'verification_date',
        'avatar',
        'cover_image',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'social_media' => 'json',
        'is_verified' => 'boolean',
        'verification_date' => 'datetime',
    ];

    /**
     * Get the user associated with the author.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the publications associated with the author.
     */
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    /**
     * Get the author statistics.
     */
    public function statistics()
    {
        return $this->hasOne(AuthorStatistic::class);
    }

    /**
     * Scope for verified authors.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope for active authors.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AuthorFactory::new();
    }
} 