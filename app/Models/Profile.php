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
        'experience',
        'expectations',
        'achievement',
        'user_id',
        'experience_time',
        'main_trend',
        'second_trend',
        'english_skill',
        'location',
        'visible'
    ];
    /**
     * @var array
     */
    protected $with = ['workingVariants'];

    /**
     * @var array
     */
    protected $casts = [
        'experience_time' => 'number'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'trend_options',
        'all_working_variants',
        'all_english_skills'
    ];

    /**
     * @return int
     */
    public function getExperienceTimeAttribute()
    {
        if ($this->attributes['experience_time'] == '0.0') {
            return 0;
        }
        return $this->attributes['experience_time'];
    }

    /**
     * @return int
     */
    public function getSalaryAttribute()
    {
        if ($this->attributes['salary'] == '0.00') {
            return 0;
        }
        return $this->attributes['salary'];
    }

    /**
     * @return array
     */
    public function getAllWorkingVariantsAttribute()
    {
        return WorkingVariant::all()->toArray();
    }

    /**
     * @return array
     */
    public function getAllEnglishSkillsAttribute()
    {
        return EnglishSkill::all()->toArray();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workingVariants()
    {
        return $this->belongsToMany(WorkingVariant::class, 'user_working_variants', 'user_id', 'working_variants_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTrendOptionsAttribute()
    {
        return UserTrend::all()->toArray();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
