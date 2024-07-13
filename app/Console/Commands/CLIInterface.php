<?php

declare(strict_types=1);

namespace App\Console\Commands;

interface CLIInterface
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    const COMMIT_JSON_FILE_PATH = 'Console/Commands/Files/Commit/date.json';

    const LAST_COMMIT_DATE = 'last_commit_date';
    const REPOSITORY_URL = 'CVE_LIST_REPO_COMMIT_URL';

    const FIELD_COMMIT = 'commit';
    const FIELD_AUTHOR = 'author';
    const FIELD_DATE = 'date';
    const COMMAND_COMPLETED_MESSAGE = 'Command completed successfully.';

}
