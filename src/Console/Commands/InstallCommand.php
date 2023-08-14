<?php

declare(strict_types=1);

namespace Laractl\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laractl:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Code Ctl';

    public function handle(): void
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists(app_path('Contracts'));
        $fs->copyDirectory(__DIR__.'/../../stubs/app/Contracts', app_path('Contracts'));

        $fs->ensureDirectoryExists(app_path('Exceptions'));
        $fs->copyDirectory(__DIR__.'/../../stubs/app/Exceptions', app_path('Exceptions'));

        $fs->ensureDirectoryExists(app_path('Repositories'));
        $fs->copyDirectory(__DIR__.'/../../stubs/app/Repositories', app_path('Repositories'));

        $fs->ensureDirectoryExists(app_path('Services'));
        $fs->copyDirectory(__DIR__.'/../../stubs/app/Services', app_path('Services'));

        $fs->ensureDirectoryExists(app_path('Support'));
        $fs->copyDirectory(__DIR__.'/../../stubs/app/Support', app_path('Support'));
    }
}