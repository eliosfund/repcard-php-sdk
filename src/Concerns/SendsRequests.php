<?php

declare(strict_types=1);

namespace RepCard\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use RepCard\RepCardService;

/**
 * @phpstan-require-extends RepCardService
 *
 * @mixin RepCardService
 */
trait SendsRequests
{
    public function __construct(
        protected PendingRequest $client,
        protected int $companyId,
    ) {}

    /**
     * Issue a `GET` request to the given path.
     */
    public function get(string $path, ?array $query = null): Response
    {
        return $this->client->get($path, $query ?? []);
    }

    /**
     * Issue a `POST` request to the given path.
     */
    public function post(string $path, array $data = []): Response
    {
        return $this->client->post($path, $data);
    }

    /**
     * Issue a `PUT` request to the given path.
     */
    public function put(string $path, array $data = []): Response
    {
        return $this->client->put($path, $data);
    }
}
