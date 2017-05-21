<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingVariant extends Model
{
    /**
     * @var string
     */
    protected $table = "working_variants";

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(Profile::class, 'user_working_variants', 'working_variants_id', 'user_id');
    }
}
