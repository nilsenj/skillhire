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
        'resume',
        'original_resume_name',
        'avatar',
        'fullname'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'fullname',
        'email',
        'default_image'
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
    public function getDefaultImageAttribute()
    {
        return asset('img/user_not_found.jpg');
    }

    /**
     * @return mixed
     */
    public function setFullnameAttribute($fullname)
    {
        if($fullname) {
            if($this->user()->first()->name != $fullname) {
                $user = $this->user()->first();
                $user->name = $fullname;
                $user->save();
            }
        }
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
