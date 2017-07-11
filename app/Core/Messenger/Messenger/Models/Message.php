<?php namespace App\Core\Messenger\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Message extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['Proposal'];

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['proposal_id', 'user_id', 'body', 'banned'];


    /**
     * @var array
     */
    protected $with = [];
    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [
        'body' => 'required',
    ];

    /**
     * Proposal relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    /**
     * User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Config::get('messenger.user_model'));
    }

    /**
     * Participants relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('App\Core\Messenger\Models\Participant', 'proposal_id', 'proposal_id');
    }

    /**
     * Recipients of this message
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipients()
    {
        return $this->participants()->where('user_id', '!=', $this->user_id);
    }
}
