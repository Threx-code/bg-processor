<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\CLIInterface;
use App\Console\Commands\Processor\Inserts\AdpStore;
use App\Console\Commands\Processor\Inserts\CnaStore;
use App\Console\Commands\Processor\Inserts\CveStore;
use App\Console\Commands\Processor\Inserts\FileNameStore;
use App\Console\Commands\Processor\Queries\CveQuery;
use Carbon\Carbon;
use Domains\Helpers\Payloads\DefaultFieldInterface;
use Domains\Helpers\Payloads\FieldInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

final readonly class FileProcessor
{
    public function directory(string $directory, Command $command): void
    {
        $files = scandir($directory);
        $files = array_filter($files, function ($file) {
            return ! in_array($file, ['.', '..']);
        });

        foreach ($files as $file) {
            $startTime = microtime(true);
            $fullPath = $directory.DIRECTORY_SEPARATOR.$file;
            if (is_dir($fullPath)) {
                $this->directory($fullPath, $command);
            } else {
                $this->process($fullPath, $file);
            }

            $endTime = microtime(true);
            $elapsedTimeMs = ($endTime - $startTime) * 1000;
            $formattedTime = number_format($elapsedTimeMs, 2).'ms';

            $command->info(
                string: str_replace(
                    search: ['{file_name}', '{duration}'],
                    replace: [$file, $formattedTime],
                    subject: CLIInterface::CURRENT_CVE_PROCESS_COMPLETED
                )
            );
        }
    }

    private function process(string $fullPath, string $file): void
    {
        $data = file_get_contents($fullPath);
        $data = json_decode($data, true);

        $cve = $this->runCve(data: $data);
        $this->runFilename(file: $file);

    }

    private static function defaultNull(): null
    {
        return DefaultFieldInterface::FIELD_NULL;
    }

    private function runCve(mixed $data): Model
    {
        $cveKey = '';

        $cves = $data[FieldInterface::FIELD_CVE_META_DATA] ?? self::defaultNull();
        $cves[FieldInterface::FIELD_DATA_TYPE] = $data[FieldInterface::FIELD_DATA_TYPE];
        $cves[FieldInterface::FIELD_DATA_VERSION] = $data[FieldInterface::FIELD_DATA_VERSION];

        $cveFromDb = (new CveQuery($cves))->query()->first();

        if ($cveFromDb) {
            $dateUpdated = Carbon::parse($cves[FieldInterface::FIELD_DATE_UPDATED])->format('Y-m-d') ?? self::defaultNull();
            $dateUpdatedFromDb = Carbon::parse($cveFromDb->dateUpdated->date)->format('Y-m-d');
            if ($dateUpdated > $dateUpdatedFromDb) {
                $cveKey = $cveFromDb->key;
            }
        }

        $cve = (new CveStore($cves, $cveKey))->process();

        if ($dateUpdated !== $dateUpdatedFromDb) {
            $this->runCna(data: $data, cve: $cve);
            $this->runAdp(data: $data, cve: $cve);
        }

        return $cve;
    }

    private function runCna($data, mixed $cve): void
    {
        $cnas = $data[FieldInterface::FIELD_CONTAINERS][FieldInterface::FIELD_CNA] ?? self::defaultNull();
        if (! empty($cnas)) {
            $cnas[FieldInterface::FIELD_CVE_ID] = $cve->id;
            $cnas[FieldInterface::FIELD_DATE_UPDATED] = $cve->dateUpdated;
            (new CnaStore($cnas))->process();
        }
    }

    private function runAdp($data, mixed $cve): void
    {
        $adps = $data[FieldInterface::FIELD_CONTAINERS][FieldInterface::FIELD_ADP] ?? self::defaultNull();
        if (! empty($adps)) {
            foreach ($adps as $adp) {
                $adp[FieldInterface::FIELD_CVE_ID] = $cve->id;
                $adp[FieldInterface::FIELD_DATE_UPDATED] = $cve->dateUpdated;
                (new AdpStore($adp))->process();
            }
        }
    }

    private function runFilename(string $file): void
    {
        (new FileNameStore([FieldInterface::FIELD_FILE_NAME => $file]))->process();
    }

    private function parseDate(string $date): string
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}
