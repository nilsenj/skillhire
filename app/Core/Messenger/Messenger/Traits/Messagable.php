<?php namespace App\Core\Messenger\Traits;

use App\Core\Messenger\Models\Proposal;
use App\Core\Messenger\Models\Participant;

trait Messagable
{
    /**
     * Message relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Core\Messenger\Models\Message');
    }

    /**
     * Proposal relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function Proposals()
    {
        return $this->belongsToMany(\App\Core\Messenger\Models\Proposal::class, 'participants');
    }

    /**
     * Returns the new messages count for user
     *
     * @return int
     */
    public function newMessagesCount()
    {
        return count($this->ProposalsWithNewMessages());
    }

    /**
     * Returns all Proposals with new messages
     *
     * @return array
     */
    public function ProposalsWithNewMessages()
    {
        $ProposalsWithNewMessages = [];
        $participants = Participant::where('user_id', $this->id)->lists('last_read', 'proposal_id');

        /**
         * @todo: see if we can fix this more in the future.
         * Illuminate\Foundation is not available through composer, only in laravel/framework which
         * I don't want to include as a dependency for this package...it's overkill. So let's
         * exclude this check in the testing environment.
         */
        if ($_ENV['APP_ENV'] == 'testing' || !str_contains(\Illuminate\Foundation\Application::VERSION, '5.0')) {
            $participants = $participants->all();
        }

        if ($participants) {
            $Proposals = Proposal::whereIn('id', array_keys($participants))->get();

            foreach ($Proposals as $Proposal) {
                if ($Proposal->updated_at > $participants[$Proposal->id]) {
                    $ProposalsWithNewMessages[] = $Proposal->id;
                }
            }
        }

        return $ProposalsWithNewMessages;
    }
}
