<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\Processor\Inserts\AdpStore;
use App\Console\Commands\Processor\Inserts\CnaStore;
use App\Console\Commands\Processor\Inserts\CveStore;
use App\Console\Commands\Processor\Inserts\FileNameStore;
use Domains\Helpers\Payloads\DefaultFieldInterface;
use Domains\Helpers\Payloads\FieldInterface;

final readonly class FileProcessor
{
    public function directory(string $directory): void
    {
        $files = scandir($directory);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $fullPath = $directory.DIRECTORY_SEPARATOR.$file;
            if (is_dir($fullPath)) {
                $this->directory($fullPath);
            } else {
                $this->process($fullPath, $file);
            }
        }
    }

    private function process(string $fullPath, string $file): void
    {
        $data = file_get_contents($fullPath);
        $data = json_decode($data, true);

        $cveId = $this->runCve(data: $data);
        $this->runCna(data: $data, cveId: $cveId);
        $this->runAdp(data: $data, cveId: $cveId);
        $this->runFilename(file: $file);

    }

    public static function defaultNull(): null
    {
        return DefaultFieldInterface::FIELD_NULL;
    }

    public function runCve(mixed $data): mixed
    {
        $cves = $data[FieldInterface::FIELD_CVE_META_DATA];
        $cves[FieldInterface::FIELD_DATA_TYPE] = $data[FieldInterface::FIELD_DATA_TYPE];
        $cves[FieldInterface::FIELD_DATA_VERSION] = $data[FieldInterface::FIELD_DATA_VERSION];

        return (new CveStore($cves))->process()->id;
    }

    public function runCna($data, mixed $cveId): void
    {
        $cnas = $data[FieldInterface::FIELD_CONTAINERS][FieldInterface::FIELD_CNA] ?? self::defaultNull();
        if (! empty($cnas)) {
            $cnas[FieldInterface::FIELD_CVE_ID] = $cveId;
            (new CnaStore($cnas))->process();
        }
    }

    public function runAdp($data, mixed $cveId): void
    {
        $adps = $data[FieldInterface::FIELD_CONTAINERS][FieldInterface::FIELD_ADP] ?? self::defaultNull();
        if (! empty($adps)) {
            foreach ($adps as $adp) {
                $adp[FieldInterface::FIELD_CVE_ID] = $cveId;
                (new AdpStore($adp))->process();
            }
        }
    }

    public function runFilename(string $file): void
    {
        (new FileNameStore([FieldInterface::FIELD_FILE_NAME => $file]))->process();
    }
}
