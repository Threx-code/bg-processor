<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\Processor\Inserts\AffectedProductsStore;
use App\Console\Commands\Processor\Inserts\CveStore;
use App\Console\Commands\Processor\Inserts\PlatformStore;
use App\Console\Commands\Processor\Inserts\ProductVersionStore;
use App\Console\Commands\Processor\Inserts\VersionChangeStore;
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
        $cveId = (new CveStore($data[FieldInterface::FIELD_CVE_META_DATE]))->process()->id;

        $affectedProducts = $data[FieldInterface::FIELD_CONTAINERS][FieldInterface::FIELD_CNA][FieldInterface::FIELD_AFFECTED];
        if(!empty($affectedProducts)) {
            foreach ($affectedProducts as $product) {
                $product[FieldInterface::FIELD_CVE_ID] = $cveId;
                $affectedProductId = (new AffectedProductsStore($product))->process()->id;

                $platforms = $product[FieldInterface::FIELD_PLATFORMS]  ?? FieldInterface::FIELD_NULL;
                if (!empty($platforms)) {
                    foreach ($platforms as $platform) {
                        $platform[FieldInterface::FIELD_AFFECTED_PRODUCT_ID] = $affectedProductId;
                        (new PlatformStore($platform))->process();
                    }
                }

                $productVersions = $product[FieldInterface::FIELD_VERSIONS] ?? FieldInterface::FIELD_NULL;
                if(!empty($productVersions)) {
                    foreach ($productVersions as $version) {
                        $version[FieldInterface::FIELD_AFFECTED_PRODUCT_ID] = $affectedProductId;
                        $versionId = (new ProductVersionStore($version))->process();

                        $changes = $version[FieldInterface::FIELD_CHANGES] ?? FieldInterface::FIELD_NULL;
                        if (!empty($changes)) {
                            foreach ($changes as $change) {
                                $changes[FieldInterface::FIELD_PRODUCT_VERSION] = $versionId;
                                (new VersionChangeStore($change))->process();
                              }
                        }
                    }
                }


            }
        }
    }
}
