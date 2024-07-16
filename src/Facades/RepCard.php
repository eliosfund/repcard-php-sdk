<?php

declare(strict_types=1);

namespace RepCard\Facades;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
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
 * @method static string buildUrl(string $path, array|null $query = null)
 * @method static \GuzzleHttp\Psr7\Uri baseUri()
 * @method static \Illuminate\Http\Client\PendingRequest client()
 * @method static \Illuminate\Http\Client\Response get(string $path, array|string|null $query = null)
 * @method static \Illuminate\Http\Client\Response post(string $path, array $data = [])
 * @method static \Illuminate\Http\Client\Response put(string $path, array $data = [])
 *
 * @see \RepCard\RepCardService
 */
class RepCard extends Facade
{
    public static function fake(
        string $path = '*',
        ?array $query = null,
        array|null|string $body = null,
        int $status = Response::HTTP_OK
    ): Factory {
        /** @var RepCardService $instance */
        $instance = static::getFacadeRoot();

        $url = $instance->buildUrl($path, $query);

        return Http::fake([
            $url => Http::response($body, $status),
        ]);
    }

    protected static function getFacadeAccessor(): string
    {
        return RepCardService::class;
    }
}
