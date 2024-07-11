<?php

declare(strict_types=1);

namespace RepCard\Tests\Http\Requests;

use RepCard\Tests\Fixtures\TestRequest;
use RepCard\Tests\TestCase;

class ApiRequestTest extends TestCase
{
    public function test_it_can_create_a_request(): void
    {
        $request = TestRequest::from($data = []);

        $this->assertInstanceOf(TestRequest::class, $request);

        $this->assertSame($data, $request->all());
        $this->assertSame($data, $request->toArray());
        $this->assertSame($data, $request->validate($request->rules()));
    }

    public function test_it_can_authorize(): void
    {
        $this->assertTrue((new TestRequest())->authorize());
    }
}
