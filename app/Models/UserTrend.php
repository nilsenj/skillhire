<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTrend extends Model
{
    /**
     * @var string
     */
    protected $table = "user_trends";

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
