<?php declare(strict_types=1);

namespace App\Helpers\Jsons;

class ProcessJson
{
    public static function format($data): string
    {
        return json_encode($data);
    }

}
