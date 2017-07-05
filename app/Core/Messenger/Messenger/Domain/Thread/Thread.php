<?php namespace App\Core\Messenger\Domain\Proposal;

use App\Core\Messenger\Eloquent\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Proposals';

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['subject'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Messages relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Core\Messenger\Domain\Message\Message');
    }

    /**
     * Participants relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('App\Core\Messenger\Domain\Participant\Participant');
    }
}
