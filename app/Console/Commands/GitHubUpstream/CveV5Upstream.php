<?php

declare(strict_types=1);

namespace App\Console\Commands\GitHubUpstream;

use App\Console\Commands\CLIInterface;
use App\Console\Commands\Dates\DateString;
use App\Console\Commands\Files\Commit\LastCommit;
use App\Console\Commands\Files\Commit\SaveCommitDate;
use App\Services\RequestClient;
use App\Services\RequestClientPayload;
use App\Services\RequestInterface;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use JsonException;

class CveV5Upstream extends Command
{
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
     * @throws JsonException
     */
    public function handle(): void
    {
        $response = (
            new RequestClient(
                request: new RequestClientPayload(
                    payload: [],
                    method: RequestInterface::GET_REQUEST,
                    url: env(key: CLIInterface::REPOSITORY_URL),
                    client: new Client(config: RequestInterface::VERIFY_REQUEST),
                    headers: RequestInterface::REQUEST_HEADERS
                )
            )
        )->send()->response();
        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        $commitDate = DateString::format(
            date: $response[0][CLIInterface::FIELD_COMMIT][CLIInterface::FIELD_AUTHOR][CLIInterface::FIELD_DATE]
        );

        $compareDate = DateString::format(
            date: LastCommit::getDate()[CLIInterface::LAST_COMMIT_DATE]
        );

        if ($commitDate !== $compareDate) {
            $script = dirname(__DIR__, 2).'/scripts/pull-repo.sh';
            $output = shell_exec("sh {$script}");
            $this->info($output);
            SaveCommitDate::save($commitDate);
        }

        $this->info(CLIInterface::COMMAND_COMPLETED_MESSAGE);
    }

}
