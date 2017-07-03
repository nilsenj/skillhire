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
        'location',
        'company_id',
        'main_trend',
        'working_variant'
    ];

    /**
     * @var array
     */
    protected $appends = ['formatted_published'];
    /**
     * @var array
     */
    protected $with = ['author', 'company'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @return mixed
     */
    public function getFormattedPublishedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
