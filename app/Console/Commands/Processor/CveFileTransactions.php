<?php declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\CLIInterface;
use App\Console\Commands\Processor\InsertServices\CveStore;
use Domains\Adp\Services\Service as AdpService;

use Domains\CveFileNames\Models\CveFileNames;
use Domains\CveFileNames\Repositories\Repository as CveFileNamesRepository;
use Domains\Exploit\Services\Service as ExploitService;
use Domains\Credit\Services\Service as CreditService;
use Domains\CvssV3\Services\Service as CvssV3Service;
use Domains\Metric\Services\Service as MetricService;
use Domains\Reference\Services\Service as ReferenceService;
use Domains\Source\Services\Service as SourceService;
use Domains\Platform\Services\Service as PlatformService;
use Domains\Scenario\Services\Service as ScenarioService;
use Domains\Solution\Services\Service as SolutionService;
use Domains\Timeline\Services\Service as TimelineService;
use Domains\AdpMetrics\Services\Service as AdpMetricsService;
use Domains\Workaround\Services\Service as WorkaroundService;
use Domains\XGenerator\Services\Service as XGeneratorService;
use Domains\Description\Services\Service as DescriptionService;
use Domains\ProblemType\Services\Service as ProblemTypeService;
use Domains\CveFileNames\Services\Service as CveFileNamesService;
use Domains\GitHubCommit\Services\Service as GithubCommitService;
use Domains\VersionChange\Services\Service as VersionChangeService;
use Domains\ProductVersion\Services\Service as ProductVersionService;
use Domains\AffectedProduct\Services\Service as AffectedProductService;
use Domains\SupportingMedia\Services\Service as SupportingMediaService;
use Domains\ProblemDescription\Services\Service as ProblemDescriptionService;
use Domains\SolutionSupportingMedia\Services\Service as SolutionSupportingMediaService;
use Domains\WorkaroundSupportingMedia\Services\Service as WorkaroundSupportingMediaService;
use Illuminate\Contracts\Foundation\Application as ApplicationFoundation;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use JsonException;

final readonly class CveFileTransactions
{
    /**
     * @return ApplicationFoundation|Application|mixed
     */
    private static function dbManager(): mixed
    {
        return resolve(
            name: DatabaseManager::class
        );
    }

    /**
     * @throws JsonException
     */
    public static function process()
    {
        $dirPath = dirname(__FILE__, 5) . CLIInterface::CVE_REPOSITORY_PATH;
        self::processDirectory($dirPath);
    }

    private static function fileNames(): Collection
    {
        return (
            new CveFileNamesService(
            repository: new CveFileNamesRepository(
                query: CveFileNames::query(),
                database: self::dbManager()
            )
        )
        )->all();
    }

    /**
     * @throws JsonException
     */
    private static function processDirectory($directoryPath)
    {
        $files = scandir($directoryPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $filePath = $directoryPath . DIRECTORY_SEPARATOR . $file;
            if(is_dir($filePath)) {
                self::processDirectory($filePath);
            }
            else {
                if(self::fileNames()->contains(key: 'fileName', value: $filePath)) {
                    continue;
                }
                self::processFile($filePath);
            }
        }
    }


    /**
     * @throws JsonException
     */
    public static function processFile($filePath)
    {
        $jsonData = file_get_contents($filePath);
        $data = json_decode($jsonData, true, 512, JSON_THROW_ON_ERROR);


//            if(!empty($data['cveMetadata'])){
//                $cve = (new CveStore())->process($data['cveMetadata']);
//            }

            print_r($data);

        exit;
    }

}
