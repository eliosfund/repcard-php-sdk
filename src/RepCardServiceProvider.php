<?php

declare(strict_types=1);

namespace RepCard;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepCardServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot(): void
    {
        $this->publishes([
            $this->configPath() => config_path('repcard.php'),
        ], 'repcard-config');
    }

    public function register(): void
    {
        if (is_file($configPath = $this->configPath())) {
            $this->mergeConfigFrom($configPath, 'repcard');
        }

        $this->app->singleton(
            abstract: RepCardService::class,
            concrete: static fn (): RepCardService => new RepCardService()
        );
    }

    /**
     * @return array<int, class-string>
     */
    public function provides(): array
    {
        return [RepCardService::class];
    }

    protected function configPath(): string
    {
        return __DIR__.'/../config/repcard.php';
    }
}
