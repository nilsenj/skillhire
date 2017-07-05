<?php namespace App\Core\Messenger\Domain\Proposal;

class ProposalService
{
    /**
     * @var ProposalRepository
     */
    protected $repo;

    public function __construct(ProposalRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Returns a Proposal with a given id
     *
     * @param $id
     * @return mixed
     */
    public function getProposal($id)
    {
        return $this->repo->getById($id);
    }

    /**
     * Returns a collection of Proposals for a given user
     *
     * @param $userId
     * @return Proposal
     */
    public function getProposalsForUser($userId)
    {
        return $this->repo->getForUser($userId);
    }
}
