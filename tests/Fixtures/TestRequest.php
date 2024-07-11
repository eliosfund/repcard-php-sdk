<?php

declare(strict_types=1);

namespace RepCard\Tests\Fixtures;

use RepCard\Http\Requests\ApiRequest;

class TestRequest extends ApiRequest
{
    public function rules(): array
    {
        return [];
    }
}
