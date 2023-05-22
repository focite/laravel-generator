<?php

namespace Focite\Builder;

use Focite\Builder\Console\Commands\GenEntity;
use Focite\Builder\Console\Commands\GenModel;
use Focite\Builder\Console\Commands\GenRepository;
use Focite\Builder\Console\Commands\GenService;
use Illuminate\Support\ServiceProvider;

class BuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenEntity::class,
                GenModel::class,
                GenRepository::class,
                GenService::class,
            ]);
        }
    }
}