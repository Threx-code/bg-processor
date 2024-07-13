<?php

namespace App\Console\Commands\Files\Commit;

use App\Console\Commands\CLIInterface;
use JsonException;

final class LastCommit
{
    /**
     * @throws JsonException
     */
    public static function getDate()
    {
        $date = file_get_contents(
            filename: app_path(
                path: CLIInterface::COMMIT_JSON_FILE_PATH
            )
        );
        return json_decode($date, true, 512, JSON_THROW_ON_ERROR);
    }
}
