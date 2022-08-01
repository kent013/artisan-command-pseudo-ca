<?php declare(strict_types=1);

namespace ArtisanCommandPseudoCA;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * @inheritdoc
     */
    public function register(): void
    {
        $this->commands([
            Console\Commands\UseCaseMakeCommand::class,
            Console\Commands\RequestMakeCommand::class,
            Console\Commands\ResourceMakeCommand::class,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/pseudoca.php' => config_path('pseudoca.php')
        ], 'pseudoca');
    }

    /**
     * @inheritdoc
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
