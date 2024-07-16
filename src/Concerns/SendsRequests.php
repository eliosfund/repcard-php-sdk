<?php

declare(strict_types=1);

namespace RepCard\Concerns;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RepCard\RepCardService;

/**
 * @phpstan-require-extends RepCardService
 *
 * @mixin RepCardService
 */
trait SendsRequests
{
    protected int $companyId;

    public function __construct()
    {
        $this->companyId = config('repcard.company_id');
    }

    public function buildUrl(string $path, ?array $query = null): string
    {
        $url = $this->baseUri();

        $url = $url->withPath(
            path: $url->getPath().Str::start($path, '/')
        );

        if ($query !== null) {
            $url = $url->withQuery(
                query: http_build_query($query)
            );
        }

        return (string) $url;
    }

    public function baseUri(): Uri
    {
        return (new Uri())->withScheme(
            scheme: 'https'
        )->withHost(
            host: config('repcard.fqdn')
        )->withPath(
            path: config('repcard.endpoint')
        );
    }

    public function client(): PendingRequest
    {
        return Http::acceptJson()->baseUrl(
            url: (string) $this->baseUri()
        )->withHeader(
            name: 'x-api-key',
            value: config('repcard.key')
        )->timeout(
            seconds: config('repcard.timeout')
        )->connectTimeout(
            seconds: config('repcard.connect_timeout')
        );
    }

    /**
     * Issue a `GET` request to the given path.
     */
    public function get(string $path, ?array $query = null): Response
    {
        return $this->client()->get($path, $query);
    }

    /**
     * Issue a `POST` request to the given path.
     */
    public function post(string $path, array $data = []): Response
    {
        return $this->client()->post($path, $data);
    }

    /**
     * Issue a `PUT` request to the given path.
     */
    public function put(string $path, array $data = []): Response
    {
        return $this->client()->put($path, $data);
    }
}
