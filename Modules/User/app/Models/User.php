<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Models\User as AuthUser;

class User extends AuthUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'profile_image',
        'referral_code',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'boolean',
    ];

    /**
     * Get user profile information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Get user statistics
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statistics()
    {
        return $this->hasOne(UserStatistic::class);
    }

    /**
     * Get stores created by user
     *
     * @return HasMany
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Get resumes created by user
     *
     * @return HasMany
     */
    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }

    /**
     * Scope active users
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is author
     *
     * @return bool
     */
    public function isAuthor()
    {
        return $this->hasRole('author');
    }

    /**
     * Check if user is visitor
     *
     * @return bool
     */
    public function isVisitor()
    {
        return $this->hasRole('visitor');
    }

    /**
     * Check if user is customer
     *
     * @return bool
     */
    public function isCustomer()
    {
        return $this->hasRole('customer');
    }
} 