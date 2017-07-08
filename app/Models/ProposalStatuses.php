<?php

namespace App\Models;

use App\Core\Messenger\Models\Proposal;
use Illuminate\Database\Eloquent\Model;

class ProposalStatuses extends Model
{
    /**
     * @var string
     */
    protected $table = 'proposal_statuses';

    /**
     * @var array
     */
    protected $fillable = [
        'status', 'proposal_id'
    ];

    const STATUSES = ['opened', 'closed'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }
}
