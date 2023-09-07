<?php

namespace Focite\Generator;

use Focite\Generator\Console\Commands\GenDict;
use Focite\Generator\Console\Commands\GenEntity;
use Focite\Generator\Console\Commands\GenInterface;
use Focite\Generator\Console\Commands\GenModel;
use Focite\Generator\Console\Commands\GenRepository;
use Focite\Generator\Console\Commands\GenService;
use Focite\Generator\Console\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
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