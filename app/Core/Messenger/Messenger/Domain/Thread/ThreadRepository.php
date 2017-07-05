<?php namespace App\Core\Messenger\Domain\Proposal;

interface ProposalRepository
{
    /**
     * Persists a given Proposal
     *
     * @param Proposal $Proposal
     * @return Proposal
     */
    public function save(Proposal $Proposal);

    /**
     * Returns all Proposals for a given user
     *
     * @param $userId
     * @return Proposal
     */
    public function getForUser($userId);
}
