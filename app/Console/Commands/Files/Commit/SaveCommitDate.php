<?php declare(strict_types=1);

namespace App\Console\Commands\Files\Commit;

use App\Console\Commands\CLIInterface;

final class SaveCommitDate
{
    public static function save($date): void
    {
        file_put_contents(
            filename: app_path(
            path: CLIInterface::COMMIT_JSON_FILE_PATH
        ),
            data: json_encode(
                [CLIInterface::LAST_COMMIT_DATE => $date],
                JSON_PRETTY_PRINT
            )
        );
    }
}
