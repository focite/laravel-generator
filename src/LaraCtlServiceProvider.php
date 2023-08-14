<?php

namespace Laractl;

use Laractl\Console\Commands\GenEntity;
use Laractl\Console\Commands\GenModel;
use Laractl\Console\Commands\GenRepository;
use Laractl\Console\Commands\GenService;
use Laractl\Console\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class LaraCtlServiceProvider extends ServiceProvider
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
                InstallCommand::class,
                GenEntity::class,
                GenModel::class,
                GenRepository::class,
                GenService::class,
            ]);
        }
    }
}