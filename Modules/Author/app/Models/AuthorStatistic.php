<?php

namespace Modules\Author\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Author\Database\Factories\AuthorStatisticFactory;

class AuthorStatistic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'publication_count',
        'total_views',
        'total_comments',
        'total_likes',
        'total_shares',
        'average_rating',
        'total_followers',
        'total_awards',
        'last_publication_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_count' => 'integer',
        'total_views' => 'integer',
        'total_comments' => 'integer',
        'total_likes' => 'integer',
        'total_shares' => 'integer',
        'average_rating' => 'float',
        'total_followers' => 'integer',
        'total_awards' => 'integer',
        'last_publication_date' => 'datetime'
    ];

    /**
     * Get the author that owns the statistics.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AuthorStatisticFactory::new();
    }
} 