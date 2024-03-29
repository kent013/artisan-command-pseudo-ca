<?php

declare(strict_types=1);

namespace ArtisanCommandPseudoCA\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class PseudoCAMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:pseudoca {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new UseCase/Request/Resource class';

    /**
     * @return bool|void|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = $this->argument('name');
        if(!is_string($name)){
            $this->error('name of the class must be string.');
            exit;
        }
        $this->call('make:pseudoca:usecase', [
            'name' => $name . config('pseudoca.usecase_suffix'),
            '--force' => $this->option('force')
        ]);
        $this->call('make:pseudoca:resource', [
            'name' => $name . config('pseudoca.resource_suffix'),
            '--force' => $this->option('force')
        ]);
        $this->call('make:pseudoca:request', [
            'name' => $name . config('pseudoca.request_suffix'),
            '--force' => $this->option('force')
        ]);
    }
}
