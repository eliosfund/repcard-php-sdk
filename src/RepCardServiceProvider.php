<?php

declare(strict_types=1);

namespace RepCard;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Http;
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

        $this->app->singleton(RepCardService::class, static fn (): RepCardService => new RepCardService(
            client: Http::acceptJson()->baseUrl(
                url: (string) (new Uri())->withScheme(
                    scheme: 'https'
                )->withHost(
                    host: config('repcard.fqdn')
                )->withPath(
                    path: config('repcard.endpoint')
                )
            )->withHeader(
                name: 'x-api-key',
                value: config('repcard.key')
            )->timeout(
                seconds: config('repcard.timeout')
            )->connectTimeout(
                seconds: config('repcard.connect_timeout')
            ),
            companyId: config('repcard.company_id')
        ));
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
