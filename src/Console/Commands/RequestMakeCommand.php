<?php

declare(strict_types=1);

namespace ArtisanCommandPseudoCA\Console\Commands;

use Illuminate\Console\GeneratorCommand as Command;

class RequestMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:usecase:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new request class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/request.stub';
    }

    /**
     * Get the default namespace for a class
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }
}
