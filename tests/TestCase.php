<?php

declare(strict_types=1);

namespace RepCard\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use RepCard\RepCardServiceProvider;

/**
 * @property Application $app
 */
class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    protected function assertOk(Response $response): void
    {
        $this->assertSame(HttpResponse::HTTP_OK, $response->status());
    }

    protected function getPackageProviders($app): array
    {
        return [
            RepCardServiceProvider::class,
        ];
    }
}
