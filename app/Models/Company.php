<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 * @package App\Models
 */
class Company extends Model
{
    /**
     * @var string
     */
    protected $table = "companies";

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'description',
        'publisher_id',
        'site',
        'location'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class, 'company_id');
    }
}
