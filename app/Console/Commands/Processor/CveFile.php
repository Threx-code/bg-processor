<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\CLIInterface;
use App\Console\Commands\Dates\DateString;
use App\Console\Commands\Files\Commit\LastCommit;
use App\Console\Commands\Processor\Queries\GitHubCommitQuery;
use Illuminate\Console\Command;
use JsonException;
use Throwable;

class CveFile extends Command
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:cve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to process cve files and save them to the database.';

    /**
     * Execute the console command.
     *
     * @throws JsonException
     * @throws Throwable
     */
    public function handle()
    {
        $commitDate = DateString::format(
            date: LastCommit::getDate()[CLIInterface::LAST_COMMIT_DATE]
        );

        $gitHubService = new GitHubCommitQuery();

        $commits = $gitHubService->service()->all();
        $commitData = $commits->first();

        $dateFromDb = ! empty($commitData) ?
            $commitData->commitDate->date->format(self::DATE_FORMAT) : null;

        if ($commitDate !== $dateFromDb) {
            $directory = dirname(__FILE__, 5).CLIInterface::CVE_REPOSITORY_PATH;
            (new FileProcessor())->directory($directory, $this);
            $commitInserted = (! empty($checkCommitData->key)) ? $gitHubService->update($commits, $commitDate) : $this->$gitHubService($commitDate);
        }

        $this->info(CLIInterface::CURRENT_CVE_PROCESS_COMPLETED);
    }




}
