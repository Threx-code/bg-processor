<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

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
                $this->process($fullPath);
            }
        }
    }

    private function process(string $file): void
    {
        $data = file_get_contents($file);
        $data = json_decode($data, true);
        print_r($data); exit;
    }
}
