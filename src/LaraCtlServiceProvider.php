<?php

namespace Focite;

use Focite\Console\Commands\GenDict;
use Focite\Console\Commands\GenEntity;
use Focite\Console\Commands\GenInterface;
use Focite\Console\Commands\GenModel;
use Focite\Console\Commands\GenRepository;
use Focite\Console\Commands\GenService;
use Focite\Console\Commands\InstallCommand;
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
                GenDict::class,
                GenEntity::class,
                GenInterface::class,
                GenModel::class,
                GenRepository::class,
                GenService::class,
            ]);
        }
    }
}