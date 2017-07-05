<?php namespace App\Core\Messenger\Domain;

use App\Core\Messenger\Domain\Proposal\Proposal;
use App\Core\Messenger\Domain\Proposal\ProposalService;

class MessengerService
{
    /**
     * @var ProposalService
     */
    protected $ProposalService;

    public function __construct(ProposalService $ProposalService)
    {
        $this->ProposalService = $ProposalService;
    }

    /**
     * Returns all Proposals
     * $messenger->getAllProposals();
     *
     * @return Proposal
     */
    public function getAllProposals()
    {
        // @todo: Implement getAllProposals() method.
    }

    /**
     * Returns all Proposals that a user is participant in.
     * $messenger->getAllProposalsForUser(1)
     *
     * @param $userId
     * @return Proposal
     */
    public function getAllProposalsForUser($userId)
    {
        // @todo: Implement getAllProposalsForUser() method.
    }

    /**
     * Returns all new Proposals that a user is participant in.
     * $messenger->getNewProposalsForUser(1)
     *
     * @param $userId
     * @return Proposal
     */
    public function getNewProposalsForUser($userId)
    {
        // @todo: Implement getNewProposalsForUser() method.
    }

    /**
     * Returns Proposal that matches a given id
     * $messenger->getProposal(1);
     *
     * @param $id
     * @return Proposal
     */
    public function getProposal($id)
    {
        return $this->ProposalService->getProposal($id);
    }

    /**
     * Returns the full base model. This will be helpful for making
     * any sort of custom queries.
     *
     * @return Proposal
     */
    public function getProposalModel()
    {
        // @todo: Implement getProposalModel() method.
    }
}
