<?php

namespace App\Enums\Career;

enum CareerStatus: int{

    case IN_ACTIVE = 0;
    case ACTIVE = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function orderedStatuses(): array
    {
        return self::cases();
    }

}
