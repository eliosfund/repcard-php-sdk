<?php

declare(strict_types=1);

namespace RepCard\Facades;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RepCard\RepCardService;

/**
 * @method static \Illuminate\Http\Client\Response getCompanies()
 * @method static \Illuminate\Http\Client\Response getCustomers(int $perPage = 100)
 * @method static \Illuminate\Http\Client\Response getCustomer(int $customerId)
 * @method static \Illuminate\Http\Client\Response getCustomerAttachments(int $customerId, int $perPage = 50)
 * @method static \Illuminate\Http\Client\Response getCustomerStatusLogs(string|int $customerId, \DateTimeInterface|string|null $from = null, \DateTimeInterface|string|null $to = null)
 * @method static \Illuminate\Http\Client\Response getCustomerStatuses(\RepCard\Enums\StatusType|null $type = null)
 * @method static \Illuminate\Http\Client\Response getLeaderboards(\DateTimeInterface|string|null $from = null, \DateTimeInterface|string|null $to = null)
 * @method static \Illuminate\Http\Client\Response getOffices(string|null $search = null)
 * @method static \Illuminate\Http\Client\Response getOfficeTeams(int $officeId)
 * @method static \Illuminate\Http\Client\Response getUsers(int|null $companyId = null, int $perPage = 30)
 * @method static \Illuminate\Http\Client\Response getUser(int $userId)
 * @method static \Illuminate\Http\Client\Response getEventUser(int $userId)
 * @method static \Illuminate\Http\Client\Response createUser(\RepCard\Http\Requests\UserRequest $request)
 * @method static \Illuminate\Http\Client\Response updateUser(int $userId, \RepCard\Http\Requests\UserRequest $request)
 * @method static \Illuminate\Http\Client\Response unlinkUser(int $userId)
 * @method static \Illuminate\Http\Client\Response get(string $path, array|null $query = null)
 * @method static \Illuminate\Http\Client\Response post(string $path, array $data = [])
 * @method static \Illuminate\Http\Client\Response put(string $path, array $data = [])
 *
 * @see \RepCard\RepCardService
 */
class RepCard extends Facade
{
    public static function fake(string $path, ?array $query = null): Factory
    {
        $instance = new Factory();

        Http::swap($instance);

        $url = (new Uri())->withScheme(
            scheme: 'https'
        )->withHost(
            host: config('repcard.fqdn')
        )->withPath(
            path: config('repcard.endpoint').Str::start($path, '/')
        );

        if ($query !== null) {
            $url = $url->withQuery(
                query: http_build_query($query)
            );
        }

        $url = (string) $url;

        return $instance->fake([
            $url => Http::response(),
        ]);
    }

    protected static function getFacadeAccessor(): string
    {
        return RepCardService::class;
    }
}
