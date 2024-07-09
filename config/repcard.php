<?php

declare(strict_types=1);

return [

    'key' => env('REPCARD_API_KEY'),

    'company_id' => (int) env('REPCARD_COMPANY_ID'),

    'roles' => [],

    'fqdn' => env('REPCARD_FQDN', 'app.repcard.com'),

    'endpoint' => env('REPCARD_ENDPOINT', '/api'),

    'timeout' => env('REPCARD_TIMEOUT', 10),

    'connect_timeout' => env('REPCARD_CONNECT_TIMEOUT', 2),

    'debug' => env('REPCARD_DEBUG', false),

];
