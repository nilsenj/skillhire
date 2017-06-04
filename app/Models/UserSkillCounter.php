<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TagsCloud\Tagging\Model\UserTagged;

class UserSkillCounter extends Model
{
    protected $table = 'user_skill_counters';

    protected $fillable = [
        'counter',
        'tagged_id'
    ];

    /**
     * @return mixed
     */
    public function tagged() {
        return $this->belongsTo(UserTagged::class, 'tagged_id');
    }
}
