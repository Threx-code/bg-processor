<?php

declare(strict_types=1);

namespace App\Console\Commands\GitHubUpstream;

use App\Console\Commands\CLIInterface;
use App\Helpers\StringToDate;
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
        $filePath = app_path(path: CLIInterface::COMMIT_JSON_FILE_PATH);

        $sendRequest = new RequestClient(
            request: new RequestClientPayload(
                payload: [],
                method: RequestInterface::GET_REQUEST,
                url: env(key: CLIInterface::REPOSITORY_URL),
                client: new Client(config: RequestInterface::VERIFY_REQUEST),
                headers: RequestInterface::REQUEST_HEADERS
            )
        );

        $response = $sendRequest->send()->response();
        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        $commitDate = $this->dateFormat(
            date: $response[0][CLIInterface::FIELD_COMMIT][CLIInterface::FIELD_AUTHOR][CLIInterface::FIELD_DATE]
        );

        $compareDate = file_get_contents($filePath);
        $compareDate = json_decode($compareDate, true, 512, JSON_THROW_ON_ERROR);

        $compareDate = $this->dateFormat(
            date: $compareDate[CLIInterface::LAST_COMMIT_DATE]
        );

        if ($commitDate !== $compareDate) {
            $script = dirname(__DIR__, 2).'/scripts/pull-repo.sh';
            $output = shell_exec("sh {$script}");
            $this->info($output);

            file_put_contents($filePath, json_encode(
                [CLIInterface::LAST_COMMIT_DATE => $commitDate], JSON_PRETTY_PRINT)
            );
        }

        $this->info(CLIInterface::COMMAND_COMPLETED_MESSAGE);
    }

    public function dateFormat($date): string
    {
        return StringToDate::format(
            date: $date,
            format: CLIInterface::DATE_FORMAT
        );
    }
}
