<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'body',
        'company',
        'company_description',
        'location'
    ];
    protected $with = ['author'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
