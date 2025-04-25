<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\Factories\AdminSettingFactory;

class AdminSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'is_public',
        'data_type',
        'description'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Custom accessor to cast the value based on data_type
     *
     * @param string $value
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        switch ($this->data_type) {
            case 'boolean':
                return (boolean) $value;
            case 'integer':
                return (integer) $value;
            case 'float':
                return (float) $value;
            case 'array':
            case 'object':
                return json_decode($value, true);
            default:
                return $value;
        }
    }

    /**
     * Custom mutator to prepare the value based on data_type
     *
     * @param mixed $value
     * @return void
     */
    public function setValueAttribute($value)
    {
        if (in_array($this->data_type, ['array', 'object']) && !is_string($value)) {
            $this->attributes['value'] = json_encode($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }

    /**
     * Scope for public settings
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope for specific setting group
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdminSettingFactory::new();
    }
} 