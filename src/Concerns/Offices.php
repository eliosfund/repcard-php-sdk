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
trait Offices
{
    public function getOffices(?string $search = null): Response
    {
        return $this->get('offices', $search === null ? null : [
            'search' => $search,
        ]);
    }

    public function getOfficeTeams(int $officeId): Response
    {
        return $this->get("offices/$officeId/teams");
    }
}
