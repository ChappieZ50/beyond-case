<?php

namespace App\Repositories;

use App\Contracts\VoteContract;
use App\Models\Vote;

class VoteRepository extends BaseRepository implements VoteContract
{
    public function __construct(Vote $entity)
    {
        parent::__construct($entity);
    }

    /**
     * @param int $answerID
     * @param bool $vote
     * @return bool
     */
    public function vote(int $answerID, bool $vote): bool
    {
        return $this->entity->fill([
            'vote' => $vote ? 1 : -1,
            'user_id' => auth()->id(),
            'answer_id' => $answerID
        ])->save();
    }
}
