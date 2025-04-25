<?php

namespace Modules\Author\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Author\Database\Factories\PublicationFactory;

class Publication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'description',
        'content',
        'cover_image',
        'published_at',
        'status',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'reading_time',
        'view_count'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'reading_time' => 'integer',
        'view_count' => 'integer'
    ];

    /**
     * Get the author that owns the publication.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the categories of the publication.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'publication_categories');
    }

    /**
     * Get the tags of the publication.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'publication_tags');
    }

    /**
     * Get the comments of the publication.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope for published publications.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope for featured publications.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PublicationFactory::new();
    }
} 