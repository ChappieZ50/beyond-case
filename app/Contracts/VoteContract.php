<?php

namespace App\Contracts;

interface VoteContract
{
    /**
     * @param int $answerID
     * @param bool $vote
     * @return bool
     */
    public function vote(int $answerID, bool $vote): bool;
}
