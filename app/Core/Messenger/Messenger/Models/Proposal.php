<?php namespace App\Core\Messenger\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Proposal extends Eloquent
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proposals';

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['subject', 'banned', 'author_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var array
     */
    protected $with= ['author'];

    /**
     * @var array
     */
    protected $appends = [
        'latest_message',
        'inbox_date'
    ];

    /**
     * @return mixed
     */
    public function getInboxDateAttribute()
    {
        return $this->latest_message->created_at->diffForHumans();
    }

    /**
     * "Users" table name to use for manual queries
     *
     * @var string|null
     */
    private $usersTable = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Messages relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Core\Messenger\Models\Message');
    }

    /**
     * Participants relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('App\Core\Messenger\Models\Participant');
    }

    /**
     * Returns the user object that created the Proposal
     *
     * @return mixed
     */
    public function creator()
    {
        return $this->messages()->oldest()->first()->user;
    }

    /**
     * Returns all of the latest Proposals by updated_at date
     *
     * @return mixed
     */
    public static function getAllLatest()
    {
        return self::latest('updated_at');
    }

    /**
     * Returns an array of user ids that are associated with the Proposal
     *
     * @param null $userId
     * @return array
     */
    public function participantsUserIds($userId = null)
    {
        $users = $this->participants()->withTrashed()->pluck('user_id');

        if ($userId) {
            $users[] = $userId;
        }

        return $users;
    }

    /**
     * Returns Proposals that the user is associated with
     *
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeForUser($query, $userId)
    {
        return $query->join('participants', 'proposals.id', '=', 'participants.proposal_id')
            ->where('participants.user_id', $userId)
            ->where('participants.deleted_at', null)
            ->select('proposals.*');
    }

    /**
     * @return mixed
     */
    public function getLatestMessageAttribute()
    {
        return $this->messages()->latest()->first();
    }

    /**
     * Returns Proposals with new messages that the user is associated with
     *
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeForUserWithNewMessages($query, $userId)
    {
        return $query->join('participants', 'proposals.id', '=', 'participants.proposal_id')
            ->where('participants.user_id', $userId)
            ->whereNull('participants.deleted_at')
            ->where(function ($query) {
                $query->where('proposals.updated_at', '>',
                    $this->getConnection()->raw($this->getConnection()->getTablePrefix() . 'participants.last_read'))
                    ->orWhereNull('participants.last_read');
            })
            ->select('proposals.*');
    }

    /**
     * Returns Proposals between given user ids
     *
     * @param $query
     * @param $participants
     * @return mixed
     */
    public function scopeBetween($query, array $participants)
    {
        $query->whereHas('participants', function ($query) use ($participants) {
            $query->whereIn('user_id', $participants)
                    ->groupBy('proposal_id')
                    ->havingRaw('COUNT(proposal_id)='.count($participants));
        });
    }

    /**
     * Adds users to this Proposal
     *
     * @param array $participants
     * @return array|null
     */
    public function addParticipants(array $participants): ?array
    {
        $participantsArr = [];
        if (count($participants)) {
            foreach ($participants as $user_id) {
                $participantsArr[] = Participant::firstOrCreate([
                    'user_id' => $user_id,
                    'proposal_id' => $this->id,
                ]);
            }
            return $participantsArr;
        }
    }

    /**
     * Mark a Proposal as read for a user
     *
     * @param integer $userId
     */
    public function markAsRead($userId)
    {
        try {
            $participant = $this->getParticipantFromUser($userId);
            $participant->last_read = new Carbon;
            $participant->save();
        } catch (ModelNotFoundException $e) {
            // do nothing
        }
    }

    /**
     * See if the current Proposal is unread by the user
     *
     * @param integer $userId
     * @return bool
     */
    public function isUnread($userId)
    {
        try {
            $participant = $this->getParticipantFromUser($userId);
            if ($this->updated_at > $participant->last_read) {
                return true;
            }
        } catch (ModelNotFoundException $e) {
            // do nothing
        }

        return false;
    }

    /**
     * Finds the participant record from a user id
     *
     * @param $userId
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getParticipantFromUser($userId)
    {
        return $this->participants()->where('user_id', $userId)->firstOrFail();
    }

    /**
     * Restores all participants within a Proposal that has a new message
     */
    public function activateAllParticipants()
    {
        $participants = $this->participants()->withTrashed()->get();
        foreach ($participants as $participant) {
            $participant->restore();
        }
    }

    /**
     * Generates a string of participant information
     *
     * @param null $userId
     * @param array $columns
     * @return string
     */
    public function participantsString($userId=null, $columns=['name'])
    {
        $selectString = $this->createSelectString($columns);

        $participantNames = $this->getConnection()->table($this->getUsersTable())
            ->join('participants', $this->getUsersTable() . '.id', '=', 'participants.user_id')
            ->where('participants.proposal_id', $this->id)
            ->select($this->getConnection()->raw($selectString));

        if ($userId !== null) {
            $participantNames->where($this->getUsersTable() . '.id', '!=', $userId);
        }

        $userNames = $participantNames->lists($this->getUsersTable() . '.name');

        return implode(', ', $userNames);
    }

    /**
     * Checks to see if a user is a current participant of the Proposal
     *
     * @param $userId
     * @return bool
     */
    public function hasParticipant($userId)
    {
        $participants = $this->participants()->where('user_id', '=', $userId);
        if ($participants->count() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Generates a select string used in participantsString()
     *
     * @param $columns
     * @return string
     */
    protected function createSelectString($columns)
    {
        $dbDriver = $this->getConnection()->getDriverName();

        switch ($dbDriver) {
            case 'pgsql':
            case 'sqlite':
                $columnString = implode(" || ' ' || " . $this->getConnection()->getTablePrefix() . $this->getUsersTable() . ".", $columns);
                $selectString = "(" . $this->getConnection()->getTablePrefix() . $this->getUsersTable() . "." . $columnString . ") as name";
                break;
            case 'sqlsrv':
                $columnString = implode(" + ' ' + " . $this->getConnection()->getTablePrefix() . $this->getUsersTable() . ".", $columns);
                $selectString = "(" . $this->getConnection()->getTablePrefix() . $this->getUsersTable() . "." . $columnString . ") as name";
                break;
            default:
                $columnString = implode(", ' ', " . $this->getConnection()->getTablePrefix() . $this->getUsersTable() . ".", $columns);
                $selectString = "concat(" . $this->getConnection()->getTablePrefix() . $this->getUsersTable() . "." . $columnString . ") as name";
        }

        return $selectString;
    }

    /**
     * Sets the "users" table name
     *
     * @param $tableName
     */
    public function setUsersTable($tableName)
    {
        $this->usersTable = $tableName;
    }

    /**
     * Returns the "users" table name to use in manual queries
     *
     * @return string
     */
    private function getUsersTable()
    {
        if ($this->usersTable !== null) {
            return $this->usersTable;
        }

        $userModel = Config::get('messenger.user_model');
        return $this->usersTable = (new $userModel)->getTable();
    }
}