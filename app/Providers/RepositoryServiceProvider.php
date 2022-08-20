<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\BaseContract', 'App\Repositories\BaseRepository');
        $this->app->bind('App\Contracts\UserContract', 'App\Repositories\UserRepository');
        $this->app->bind('App\Contracts\AnswerContract', 'App\Repositories\AnswerRepository');
        $this->app->bind('App\Contracts\VoteContract', 'App\Repositories\VoteRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
