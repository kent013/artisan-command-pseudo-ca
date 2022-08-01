<?php

namespace ArtisanCommandPseudoCA;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->commands([
            Console\Commands\UseCaseMakeCommand::class,
            Console\Commands\RequestMakeCommand::class,
            Console\Commands\ResourceMakeCommand::class,
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string>
     */
    public function provides(): array
    {
        return [
            Console\Commands\UseCaseMakeCommand::class,
            Console\Commands\RequestMakeCommand::class,
            Console\Commands\ResourceMakeCommand::class,
        ];
    }
}
