<?php

declare(strict_types=1);

namespace RepCard\Concerns;

use DateTimeInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use RepCard\RepCardService;

/**
 * @phpstan-require-extends RepCardService
 *
 * @mixin RepCardService
 */
trait Leaderboards
{
    public function getLeaderboards(
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

        return $this->get('leaderboards', $query);
    }
}
