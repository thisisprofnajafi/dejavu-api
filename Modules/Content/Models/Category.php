<?php

namespace Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'status',
        'order',
        'meta_title',
        'meta_description'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string',
        'order' => 'integer',
    ];

    /**
     * Get the posts for the category.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the children categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order')->orderBy('name');
    }
    
    /**
     * Get all descendant categories recursively.
     */
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
    
    /**
     * Scope a query to only include active categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    /**
     * Scope a query to only include inactive categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
    
    /**
     * Scope a query to only include root categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
} 