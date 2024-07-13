<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\CLIInterface;
use App\Helpers\StringToDate;
use Carbon\Carbon;
use Domains\GitHubCommit\Entities\Entity;
use Domains\GitHubCommit\Models\GithubCommit;
use Domains\GitHubCommit\Repositories\Repository;
use Domains\GitHubCommit\Services\Service;
use Domains\Helpers\ValueObjects\DateObject;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
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
        $filePath = app_path(path: CLIInterface::COMMIT_JSON_FILE_PATH);

        $response = $sendRequest->send()->response();
        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        $commitDate = StringToDate::format(
            date: $response[0]['commit']['author']['date'],
            format: self::DATE_FORMAT
        );

        $commits = $this->service()->all();

        print_r($commits);

        $checkCommitData = $commits->first();

        $dateFromDb = ! empty($commits->first()) ?
            $checkCommitData->commitDate->date->format(self::DATE_FORMAT) : null;

        //if ($commitDate !== $dateFromDb) {

        // }

        //        if (! empty($checkCommitData->key) && $commitDate !== $dateFromDb) {
        //            $this->update($commits, $commitDate);
        //        } elseif (empty($checkCommitData->key)) {
        //            $this->insert($commitDate);
        //        }

        $this->info('Command completed successfully');
    }

    private function service(): Service
    {
        return new Service(
            repository: new Repository(
                query: GithubCommit::query(),
                database: resolve(DatabaseManager::class)
            )
        );
    }

    /**
     * @throws Throwable
     */
    private function update(Collection $commits, $date): void
    {
        $this->service()->update(
            key: $commits->first()->key,
            entity: new Entity(
                commitDate: new DateObject(
                    date: Carbon::parse(
                        time: $date
                    )->toDateTimeImmutable()
                )
            )
        );
    }

    /**
     * @throws Throwable
     */
    private function insert($date): void
    {
        $this->service()->create(
            new Entity(
                commitDate: new DateObject(
                    date: Carbon::parse(
                        time: $date
                    )->toDateTimeImmutable()

                )
            )
        );
    }
}
