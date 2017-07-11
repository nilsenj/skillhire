<?php

namespace App\Models;

use App\Core\Messenger\Models\Proposal;
use Illuminate\Database\Eloquent\Model;

class AuthorRating extends Model
{
    protected $table = "author_rating";

    protected $fillable = ['rating', 'author_id', 'proposal_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'author_id');
    }

    public function setProposalIdAttribute($value)
    {
        if($value) {
            $this->attributes['proposal_id'] = $value;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proposal() {
        return $this->hasOne(Proposal::class, 'proposal_id');
    }
}
