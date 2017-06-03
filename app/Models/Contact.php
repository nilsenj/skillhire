<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @package App\Models
 */
class Contact extends Model
{
    /**
     * @var string
     */
    protected $table = 'contacts';

    /**
     * @var array
     */
    protected $fillable = [
        'skype',
        'mobile',
        'telegram',
        'github',
        'linkedin',
        'resume'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'fullname',
        'email'
    ];

    /**
     * @return mixed
     */
    public function getFullnameAttribute()
    {
        return $this->user()->first()->name;
    }

    /**
     * @return mixed
     */
    public function getEmailAttribute()
    {
        return $this->user()->first()->email;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {

        return $this->belongsTo(User::class, 'user_id');
    }
}
