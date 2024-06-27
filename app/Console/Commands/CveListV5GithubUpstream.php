<?php declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\RequestClient;
use App\Services\RequestClientPayload;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use JsonException;

class CveListV5GithubUpstream extends Command
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
     * Execute the console command.
     * @throws JsonException
     */
    public function handle(): void
    {
        $sendRequest = new RequestClient(
            request:  new RequestClientPayload(
                payload: [],
                method: 'GET',
                url: env('CVE_LIST_REPO_COMMIT_URL'),
                client: new Client(['verify' => true]),
                headers: [
                    "Content-Type" => "application/json",
                    "Accept: application/json",
                    "Authorization" => ''
                ]
            )
        );
        $response = $sendRequest->send()->response();
        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        print_r($response[0]['commit']['author']);

//        $dir = dirname(__DIR__, 1);
//        $script = $dir ."/scripts/pull-repo.sh";
//        $output = shell_exec("sh {$script}");
//
//        $this->info($output);
//        $this->info('Command completed successfully');

    }
}
