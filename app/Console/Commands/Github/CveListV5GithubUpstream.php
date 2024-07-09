<?php

declare(strict_types=1);

namespace App\Console\Commands\Github;

use App\Helpers\StringToDate;
use App\Services\RequestClient;
use App\Services\RequestClientPayload;
use Carbon\Carbon;
use Domains\GitHub\Entities\GitHubCommitEntity;
use Domains\GitHub\Models\GithubCommit;
use Domains\GitHub\Repositories\GitHubCommitRepository;
use Domains\GitHub\Services\GithubCommitService;
use Domains\Helpers\ValueObjects\DateObject;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use JsonException;
use Throwable;

class CveListV5GithubUpstream extends Command
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:upstream';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command pulls from the upstream repository for the cve list v5.';

    /**
     * Execute the console command.
     *
     * @throws JsonException
     * @throws Throwable
     */
    public function handle(): void
    {
        $sendRequest = new RequestClient(
            request: new RequestClientPayload(
                payload: [],
                method: 'GET',
                url: env('CVE_LIST_REPO_COMMIT_URL'),
                client: new Client(['verify' => true]),
                headers: [
                    'Content-Type' => 'application/json',
                    'Accept: application/json',
                    'Authorization' => '',
                ]
            )
        );
        $response = $sendRequest->send()->response();
        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        $commitDate = StringToDate::format(
            date: $response[0]['commit']['author']['date'],
            format: self::DATE_FORMAT
        );

        $commits = $this->service()->all();

        $checkCommitData = $commits->first();

        $dateFromDb = ! empty($commits->first()) ?
            $checkCommitData->commitDate->date->format(self::DATE_FORMAT) : null;

        if ($commitDate !== $dateFromDb) {
            $dir = dirname(__DIR__, 2);
            $script = $dir.'/scripts/pull-repo.sh';
            $output = shell_exec("sh {$script}");

            $this->info($output);
            $this->info($output);
        }

        if (! empty($checkCommitData->key) && $commitDate !== $dateFromDb) {
            $this->update($commits, $commitDate);
        } elseif (empty($checkCommitData->key)) {
            $this->insert($commitDate);
        }

        $this->info('Command completed successfully');
    }

    private function service(): GithubCommitService
    {
        return new GithubCommitService(
            repository: new GitHubCommitRepository(
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
            entity: new GitHubCommitEntity(
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
            new GitHubCommitEntity(
                commitDate: new DateObject(
                    date: Carbon::parse(
                        time: $date
                    )->toDateTimeImmutable()

                )
            )
        );
    }
}
