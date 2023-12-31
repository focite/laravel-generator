<?php

declare(strict_types=1);

namespace Focite\Generator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:install';

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

        $fs->ensureDirectoryExists(app_path('Exceptions'));
        $fs->copyDirectory($root.'/stubs/app/Exceptions', app_path('Exceptions'));

        $fs->ensureDirectoryExists(storage_path('app/ts/services'));
        $fs->ensureDirectoryExists(storage_path('app/ts/types'));
    }
}