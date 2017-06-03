<?php

namespace App\Models;

use App\Core\Access\Traits\AccessUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TagsCloud\Tagging\Taggable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use AccessUserTrait;
    use Taggable;

    /**
     * @var string
     */
    public $tagsPrefix = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @var array
     */
    protected $with = ['roles', 'profile', 'contacts'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vacancies()
    {
        return $this->belongsTo(Vacancy::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contacts()
    {
        return $this->hasOne(Contact::class, 'user_id');
    }

    /**
     * Hash the users password
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->roles()->first();
    }

    /**
     * @param string $value
     */
    public function setIsAdminAttribute($value)
    {
        $this->is_admin = $this->hasRole('role:Admin');
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function getIsAdminAttribute($value)
    {
        return $this->hasRole('role:Admin');
    }

    /**
     * check if the given customer is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    /**
     * @return string
     */
    public function getTaggedRelation(){

        return 'TagsCloud\Tagging\Model\UserTagged';
    }

}
