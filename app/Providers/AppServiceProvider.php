<?php

namespace App\Providers;

use App\Repositories\Contracts\NoteContract as NoteRepository;
use App\Repositories\NoteEloquentRepository;
use App\Services\Contracts\NoteContract as NoteServiceContract;
use App\Services\NoteService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NoteRepository::class, NoteEloquentRepository::class);
        $this->app->bind(NoteServiceContract::class, NoteService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
