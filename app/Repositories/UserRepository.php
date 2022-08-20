<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Models\User;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct(User $entity)
    {
        parent::__construct($entity);
    }

    /**
     * @return bool|int
     */
    public function save(): bool|int
    {
        $this->entity->save();
        return $this->entity->id;
    }
}
