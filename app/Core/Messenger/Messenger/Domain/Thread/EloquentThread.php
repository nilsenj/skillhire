<?php namespace App\Core\Messenger\Domain\Proposal;

use App\Core\Messenger\Repositories\EloquentRepository;
use App\Core\Messenger\Repositories\Repository;

class EloquentProposal extends EloquentRepository implements Repository, ProposalRepository
{
    /**
     * Persists a given Proposal
     *
     * @param Proposal $Proposal
     * @return Proposal
     */
    public function save(Proposal $Proposal)
    {
        // @todo: Implement save() method.
    }

    /**
     * Returns all Proposals for a given user
     *
     * @param $userId
     * @return Proposal
     */
    public function getForUser($userId)
    {
        // @todo: Implement getForUser() method.
    }
}
