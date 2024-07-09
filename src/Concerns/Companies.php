<?php

declare(strict_types=1);

namespace RepCard\Concerns;

use Illuminate\Http\Client\Response;
use RepCard\RepCardService;

/**
 * @phpstan-require-extends RepCardService
 *
 * @mixin RepCardService
 */
trait Companies
{
    public function getCompanies(): Response
    {
        return $this->get('companies');
    }
}
