<?php

namespace App\Enums\ContactUs;

enum SenderType: int{

    case CUSTOMER = 0;
    case ADMIN = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function orderedStatuses(): array
    {
        return self::cases();
    }

}
