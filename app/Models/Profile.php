<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * @package App\Models
 */
class Profile extends Model
{

    /**
     * @var string
     */
    protected $table = 'profiles';

    /**
     * @var array
     */
    protected $fillable = [
        'position',
        'salary',
        'description',
        'experience',
        'expectations',
        'achievement',
        'user_id',
        'experience_time',
        'main_trend',
        'second_trend',
        'english_skill',
        'job_variants',
        'location'
    ];

    protected $casts = [
        'experience_time' => 'number'
    ];

    protected $appends = [
        'trend_options'
    ];

    public function getExperienceTimeAttribute()
    {
        if($this->attributes['experience_time'] == '0.0') {
            return 0;
        }
        return $this->attributes['experience_time'];
    }

    public function getSalaryAttribute()
    {
        if($this->attributes['salary'] == '0.00') {
            return 0;
        }
        return $this->attributes['salary'];
    }
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTrendOptionsAttribute() {
        return UserTrend::all()->toArray();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
