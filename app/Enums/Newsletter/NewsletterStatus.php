<?php

namespace App\Enums\Newsletter;

enum NewsletterStatus: int{

    case NOT_SENT = 0;
    case SENT = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function orderedStatuses(): array
    {
        return self::cases();
    }

}
