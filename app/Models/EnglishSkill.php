<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishSkill extends Model
{
    /**
     * @var string
     */
    protected $table = "english_skills";

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
