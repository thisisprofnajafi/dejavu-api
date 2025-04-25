<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\Factories\AdminMenuFactory;

class AdminMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'parent_id',
        'route',
        'url',
        'icon',
        'permission',
        'order',
        'is_active',
        'is_visible',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'parent_id' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
        'is_visible' => 'boolean',
    ];

    /**
     * Get the parent menu item
     */
    public function parent()
    {
        return $this->belongsTo(AdminMenu::class, 'parent_id');
    }

    /**
     * Get the child menu items
     */
    public function children()
    {
        return $this->hasMany(AdminMenu::class, 'parent_id')->orderBy('order');
    }

    /**
     * Scope for parent/root menu items
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope for active menu items
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for visible menu items
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Check if the menu item is accessible by the current user
     *
     * @return bool
     */
    public function isAccessible()
    {
        if (!$this->permission) {
            return true;
        }

        return auth()->user()->can($this->permission);
    }

    /**
     * Get the URL for the menu item
     *
     * @return string
     */
    public function getUrl()
    {
        if ($this->url) {
            return $this->url;
        }

        if ($this->route) {
            return route($this->route);
        }

        return '#';
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdminMenuFactory::new();
    }
} 