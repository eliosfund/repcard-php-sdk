<?php

declare(strict_types=1);

namespace RepCard;

use RepCard\Concerns\SendsRequests;

class RepCardService
{
    use Concerns\Companies;
    use Concerns\Customers;
    use Concerns\Leaderboards;
    use Concerns\Offices;
    use Concerns\Users;
    use SendsRequests;
}
