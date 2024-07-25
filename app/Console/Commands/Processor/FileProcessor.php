<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\Processor\Inserts\AdpStore;
use App\Console\Commands\Processor\Inserts\CnaStore;
use App\Console\Commands\Processor\Inserts\CveStore;
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

                //check if the file exist in the database
                $this->process($fullPath);
            }
        }
    }

    private function process(string $file): void
    {
        $data = file_get_contents($file);
        $data = json_decode($data, true);
        $cves = $data[FieldInterface::FIELD_CVE_META_DATA];
        $cves[FieldInterface::FIELD_DATA_TYPE] = $data[FieldInterface::FIELD_DATA_TYPE];
        $cves[FieldInterface::FIELD_DATA_VERSION] = $data[FieldInterface::FIELD_DATA_VERSION];

        $cveId = (new CveStore($cves))->process()->id;

        $cnas = $data[FieldInterface::FIELD_CONTAINERS][FieldInterface::FIELD_CNA] ?? FieldInterface::FIELD_NULL;
        if ($cnas !== FieldInterface::FIELD_NULL) {
            $cnas[FieldInterface::FIELD_CVE_ID] = $cveId;
            (new CnaStore($cnas))->process();
        }

        $adps = $data[FieldInterface::FIELD_CONTAINERS][FieldInterface::FIELD_ADP] ?? FieldInterface::FIELD_NULL;
        if ($adps !== FieldInterface::FIELD_NULL) {
            foreach ($adps as $adp) {
                $adp[FieldInterface::FIELD_CVE_ID] = $cveId;
                (new AdpStore($adp))->process();
            }
        }

    }
}
