<?php

declare(strict_types=1);

namespace RepCard\Enums;

enum StatusType: string
{
    case Customer = 'customer';
    case Lead = 'lead';
    case Other = 'other';
    case Recruit = 'recruit';
}
