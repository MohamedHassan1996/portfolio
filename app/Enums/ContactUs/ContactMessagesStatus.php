<?php

namespace App\Enums\ContactUs;

enum ContactMessagesStatus: int{

    case OPENED = 0;
    case CLOSED = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function orderedStatuses(): array
    {
        return self::cases();
    }

}
