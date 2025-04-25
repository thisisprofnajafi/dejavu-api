<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Database\Factories\UserStatisticFactory;

class UserStatistic extends Model
{
    use HasFactory;

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
        'last_login_at' => 'datetime',
        'login_count' => 'integer',
        'stores_count' => 'integer',
        'resumes_count' => 'integer',
        'views_count' => 'integer',
        'downloads_count' => 'integer',
        'ratings_average' => 'float',
    ];

    /**
     * Get the user that owns the statistics.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Increment login count and update last login time
     * 
     * @param string|null $ip
     * @return self
     */
    public function recordLogin(?string $ip = null)
    {
        $this->login_count += 1;
        $this->last_login_at = now();
        
        if ($ip) {
            $this->last_login_ip = $ip;
        }
        
        $this->save();
        
        return $this;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserStatisticFactory::new();
    }
} 