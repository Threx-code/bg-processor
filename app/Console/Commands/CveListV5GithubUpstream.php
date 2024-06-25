<?php declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
     */
    public function handle(): void
    {
        $dir = dirname(__DIR__, 1);
        $script = $dir ."/scripts/pull-repo.sh";
        $output = shell_exec("sh {$script}");

        $this->info($output);
        $this->info('Command completed successfully');

    }
}
