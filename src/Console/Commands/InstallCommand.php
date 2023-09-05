<?php

declare(strict_types=1);

namespace Focite\Console\Commands;

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
        $root = dirname(__DIR__, 3);

        $fs->ensureDirectoryExists(app_path('Contracts'));
        $fs->copyDirectory($root.'/stubs/app/Contracts', app_path('Contracts'));

        $fs->ensureDirectoryExists(app_path('Exceptions'));
        $fs->copyDirectory($root.'/stubs/app/Exceptions', app_path('Exceptions'));

        $fs->ensureDirectoryExists(app_path('Http/Controllers'));
        $fs->copyDirectory($root.'/stubs/app/Http/Controllers', app_path('Http/Controllers'));

        $fs->ensureDirectoryExists(app_path('Repositories'));
        $fs->copyDirectory($root.'/stubs/app/Repositories', app_path('Repositories'));

        $fs->ensureDirectoryExists(app_path('Services'));
        $fs->copyDirectory($root.'/stubs/app/Services', app_path('Services'));

        $fs->ensureDirectoryExists(app_path('Support'));
        $fs->copyDirectory($root.'/stubs/app/Support', app_path('Support'));
    }
}