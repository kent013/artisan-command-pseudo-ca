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
        if(is_string($name) === false){
            $this->error('name of the class must be string.');
            exit;
        }
        $this->call('make:usecase:usecase', [
            'name' => $name . config('pseudo.usecase_suffix'),
            'force' => $this->option('force')
        ]);
        $this->call('make:usecase:resource', [
            'name' => $name . config('pseudo.resource_suffix'),
            'force' => $this->option('force')
        ]);
        $this->call('make:usecase:request', [
            'name' => $name . config('pseudo.request_suffix'),
            'force' => $this->option('force')
        ]);
    }
}
