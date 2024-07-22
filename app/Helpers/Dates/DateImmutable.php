<?php declare(strict_types=1);

namespace App\Helpers\Dates;

use Carbon\Carbon;
use DateTimeImmutable;

class DateImmutable
{
    public static function format(string $date): DateTimeImmutable
    {
        return Carbon::parse(time: $date)->toDateTimeImmutable();
    }
}
