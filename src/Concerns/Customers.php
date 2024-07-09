<?php

declare(strict_types=1);

namespace RepCard\Concerns;

use Carbon\Exceptions\InvalidFormatException;
use DateTimeInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use RepCard\Enums\StatusType;
use RepCard\RepCardService;

/**
 * @phpstan-require-extends RepCardService
 *
 * @mixin RepCardService
 */
trait Customers
{
    public function getCustomers(int $perPage = 100): Response
    {
        return $this->get('customers', [
            'per_page' => $perPage,
        ]);
    }

    public function getCustomer(int $customerId): Response
    {
        return $this->get("customers/$customerId");
    }

    public function getCustomerAttachments(int $customerId, int $perPage = 50): Response
    {
        return $this->get("customers/$customerId/attachments", [
            'per_page' => $perPage,
        ]);
    }

    /**
     * @throws InvalidFormatException
     */
    public function getCustomerStatusLogs(
        int|string $customerId,
        DateTimeInterface|string|null $from = null,
        DateTimeInterface|string|null $to = null
    ): Response {
        $query = null;

        if ($from !== null) {
            $query['from_date'] = Carbon::parse($from)->toDateString();
        }

        if ($to !== null) {
            $query['to_date'] = Carbon::parse($to)->toDateString();
        }

        return $this->get("customers/$customerId/status-logs", $query);
    }

    public function getCustomerStatuses(?StatusType $type = null): Response
    {
        return $this->get('contact-statuses', $type === null ? null : [
            'type' => $type->value,
        ]);
    }
}
