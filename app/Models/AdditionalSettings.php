<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalSettings extends Model
{
    /**
     * @var string
     */
    protected $table = 'additional_settings';

    /**
     * @var array
     */
    protected $fillable = [
        'subscribe',
        'stop_list'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {

        return $this->belongsTo(User::class, 'user_id');
    }
}
