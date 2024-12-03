<?php

namespace App\Enums\Faq;

enum FaqStatus: int{

    case NOT_PUBLISHED = 0;
    case PUBLISHED = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function orderedStatuses(): array
    {
        return self::cases();
    }

}
