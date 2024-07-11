<?php

declare(strict_types=1);

namespace RepCard\Tests\Http\Requests;

use RepCard\Http\Requests\UserRequest;
use RepCard\Tests\TestCase;

class UserRequestTest extends TestCase
{
    public function test_it_can_get_the_rules(): void
    {
        $rules = (new UserRequest())->rules();

        $this->assertArrayHasKey('firstName', $rules);
        $this->assertArrayHasKey('lastName', $rules);
        $this->assertArrayHasKey('userEmail', $rules);
        $this->assertArrayHasKey('phoneNumber', $rules);
        $this->assertArrayHasKey('jobTitle', $rules);
        $this->assertArrayHasKey('roleName', $rules);
        $this->assertArrayHasKey('officeName', $rules);
        $this->assertArrayHasKey('teamName', $rules);
        $this->assertArrayHasKey('countryCode', $rules);
        $this->assertArrayHasKey('externalId', $rules);
    }

    public function test_it_can_prepare_for_validation(): void
    {
        $request = UserRequest::from([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'userEmail' => 'john.doe@example.com',
            'phoneNumber' => '(212) 867-5309',
            'jobTitle' => 'Sales Rep',
            'roleName' => 'Sales',
            'officeName' => 'Corporate',
            'teamName' => 'Blue Team',
            'countryCode' => '1',
            'externalId' => null,
        ]);

        $request->prepareForValidation();

        $this->assertSame('2128675309', $request->phoneNumber);
        $this->assertSame('+1', $request->countryCode);
    }
}
