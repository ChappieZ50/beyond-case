<?php

namespace App\Contracts;

interface UserContract
{
    /**
     * @return bool|int
     */
    public function save(): bool|int;
}
