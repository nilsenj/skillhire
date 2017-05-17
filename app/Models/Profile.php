<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'profiles';

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

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
