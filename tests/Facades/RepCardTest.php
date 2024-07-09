<?php

declare(strict_types=1);

namespace RepCard\Tests\Facades;

use RepCard\Enums\StatusType;
use RepCard\Facades\RepCard;
use RepCard\Http\Requests\UserRequest;
use RepCard\Tests\TestCase;

class RepCardTest extends TestCase
{
    /**
     * @return array<string, array<int, StatusType>>
     */
    public static function statusTypeProvider(): array
    {
        return [
            StatusType::Customer->value => [StatusType::Customer],
            StatusType::Lead->value => [StatusType::Lead],
            StatusType::Other->value => [StatusType::Other],
            StatusType::Recruit->value => [StatusType::Recruit],
        ];
    }

    public function test_get_companies(): void
    {
        RepCard::fake('/companies');

        $this->assertOk(RepCard::getCompanies());
    }

    public function test_get_customers(): void
    {
        $perPage = 100;

        RepCard::fake('/customers', [
            'per_page' => $perPage,
        ]);

        $this->assertOk(RepCard::getCustomers());
    }

    public function test_get_customer(): void
    {
        $customerId = 1;

        RepCard::fake("/customers/$customerId");

        $this->assertOk(RepCard::getCustomer(
            customerId: $customerId
        ));
    }

    public function test_get_customer_attachments(): void
    {
        $customerId = 1;
        $perPage = 50;

        RepCard::fake("/customers/$customerId/attachments", [
            'per_page' => $perPage,
        ]);

        $this->assertOk(RepCard::getCustomerAttachments(
            customerId: $customerId,
            perPage: $perPage
        ));
    }

    public function test_get_customer_status_logs(): void
    {
        $customerId = 1;
        $from = '2020-01-01';
        $to = '2020-01-31';

        RepCard::fake("/customers/$customerId/status-logs", [
            'from_date' => $from,
            'to_date' => $to,
        ]);

        $this->assertOk(RepCard::getCustomerStatusLogs(
            customerId: $customerId,
            from: $from,
            to: $to
        ));
    }

    public function test_get_customer_statuses(): void
    {
        RepCard::fake('/contact-statuses');

        $this->assertOk(RepCard::getCustomerStatuses());
    }

    /**
     * @dataProvider statusTypeProvider
     */
    public function test_get_customer_statuses_by_type(StatusType $type): void
    {
        RepCard::fake('/contact-statuses', [
            'type' => $type->value,
        ]);

        $this->assertOk(RepCard::getCustomerStatuses(
            type: $type
        ));
    }

    public function test_get_leaderboards(): void
    {
        $from = '2020-01-01';
        $to = '2020-01-31';

        RepCard::fake('/leaderboards', [
            'from_date' => $from,
            'to_date' => $to,
        ]);

        $this->assertOk(RepCard::getLeaderboards(
            from: $from,
            to: $to
        ));
    }

    public function test_get_offices(): void
    {
        RepCard::fake('/offices');

        $this->assertOk(RepCard::getOffices());
    }

    public function test_get_offices_with_search(): void
    {
        $search = 'Phoenix';

        RepCard::fake('/offices', [
            'search' => $search,
        ]);

        $this->assertOk(RepCard::getOffices(
            search: $search
        ));
    }

    public function test_get_office_teams(): void
    {
        $officeId = 1;

        RepCard::fake("/offices/$officeId/teams");

        $this->assertOk(RepCard::getOfficeTeams(
            officeId: $officeId
        ));
    }

    public function test_get_users(): void
    {
        $companyId = config('repcard.company_id');
        $perPage = 30;

        RepCard::fake('/users/minimal', [
            'company_id' => $companyId,
            'per_page' => $perPage,
        ]);

        $this->assertOk(RepCard::getUsers());

        RepCard::fake('/users/minimal', [
            'company_id' => $companyId,
            'per_page' => $perPage,
        ]);

        $this->assertOk(RepCard::getUsers(
            companyId: $companyId
        ));
    }

    public function test_get_user(): void
    {
        $userId = 1;

        RepCard::fake("/users/$userId/details");

        $this->assertOk(RepCard::getUser(
            userId: $userId
        ));
    }

    public function test_get_event_user(): void
    {
        $userId = 1;

        RepCard::fake("/event-users/$userId");

        $this->assertOk(RepCard::getEventUser(
            userId: $userId
        ));
    }

    public function test_create_user(): void
    {
        RepCard::fake('/users');

        config()->set('repcard.roles', ['Sales']);

        $request = UserRequest::from([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'userEmail' => 'john.doe@example.com',
            'phoneNumber' => '2128675309',
            'jobTitle' => 'Sales Rep',
            'roleName' => 'Sales',
            'officeName' => 'Corporate',
            'teamName' => 'Blue Team',
            'countryCode' => '+1',
            'externalId' => null,
        ]);

        $this->assertOk(RepCard::createUser(
            request: $request
        ));
    }

    public function test_update_user(): void
    {
        $userId = 1;

        RepCard::fake("/users/$userId");

        config()->set('repcard.roles', ['Sales']);

        $request = UserRequest::from([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'userEmail' => 'john.doe@example.com',
            'phoneNumber' => '2128675309',
            'jobTitle' => 'Sales Rep',
            'roleName' => 'Sales',
            'officeName' => 'Corporate',
            'teamName' => 'Red Team',
            'countryCode' => '+1',
            'externalId' => null,
        ]);

        $this->assertOk(RepCard::updateUser(
            userId: $userId,
            request: $request
        ));
    }

    public function test_unlink_user(): void
    {
        $userId = 1;

        RepCard::fake("/users/$userId/unlink");

        $this->assertOk(RepCard::unlinkUser(
            userId: $userId
        ));
    }
}
