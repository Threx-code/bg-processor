<?php declare(strict_types=1);

namespace App\Console\Commands\Dates;

use App\Console\Commands\CLIInterface;
use App\Helpers\Dates\StringToDate;

final class DateString
{
    public static function format($date): string
    {
        return StringToDate::format(
            date: $date,
            format: CLIInterface::DATE_FORMAT
        );
    }
}
