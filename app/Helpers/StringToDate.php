<?php declare(strict_types=1);

namespace App\Helpers;

use Carbon\Carbon;

class StringToDate
{
    public static function format(string $date, string $format): string
    {
        return Carbon::parse(time: $date)->format(format: $format);
    }
}
