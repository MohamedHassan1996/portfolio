<?php

namespace App\Enums\Newsletter;

enum NewsletterSubsciberStatus: int{

    case NOT_SUBSCRIBED = 0;
    case SUBSCRIBED = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function orderedStatuses(): array
    {
        return self::cases();
    }

}
