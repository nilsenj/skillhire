<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vacancy
 * @package App\Models
 */
class Vacancy extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'company',
        'company_description',
        'location'
    ];
    /**
     * @var array
     */
    protected $with = ['author', 'companies'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'company_id');
    }
}
