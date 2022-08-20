<?php

namespace App\Repositories;

use App\Contracts\AnswerContract;
use App\Models\Answer;

class AnswerRepository extends BaseRepository implements AnswerContract
{
    public function __construct(Answer $entity)
    {
        parent::__construct($entity);
    }
}
