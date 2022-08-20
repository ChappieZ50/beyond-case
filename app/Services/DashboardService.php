<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Collection;

class DashboardService
{
    /**
     * @return Collection
     */
    public function analytics(): Collection
    {
        return Collection::make([
            'total_users' => User::count('id'),
            'total_answers' => Answer::count('id'),
            'total_votes' => Vote::count('id') ?? 0,
        ]);
    }
}
