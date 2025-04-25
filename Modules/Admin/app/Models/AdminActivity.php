<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\Factories\AdminActivityFactory;
use Modules\User\Models\User;

class AdminActivity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json',
    ];

    /**
     * Get the user who performed the activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to filter by action.
     */
    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope a query to filter by entity type.
     */
    public function scopeEntityType($query, $entityType)
    {
        return $query->where('entity_type', $entityType);
    }

    /**
     * Scope a query to filter by user.
     */
    public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Log a create activity.
     */
    public static function logCreate($user, $entityType, $entityId, $newValues = [])
    {
        return self::create([
            'user_id' => $user->id,
            'action' => 'create',
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => "Created {$entityType} #{$entityId}",
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Log an update activity.
     */
    public static function logUpdate($user, $entityType, $entityId, $oldValues = [], $newValues = [])
    {
        return self::create([
            'user_id' => $user->id,
            'action' => 'update',
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => "Updated {$entityType} #{$entityId}",
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Log a delete activity.
     */
    public static function logDelete($user, $entityType, $entityId, $oldValues = [])
    {
        return self::create([
            'user_id' => $user->id,
            'action' => 'delete',
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => "Deleted {$entityType} #{$entityId}",
            'old_values' => $oldValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Log a login activity.
     */
    public static function logLogin($user)
    {
        return self::create([
            'user_id' => $user->id,
            'action' => 'login',
            'entity_type' => 'user',
            'entity_id' => $user->id,
            'description' => "User logged in",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdminActivityFactory::new();
    }
} 