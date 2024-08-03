<?php

namespace App\Console\Commands\Processor\Queries;

use Domains\Cve\Models\Cve;
use Domains\Cve\Repositories\Repository;
use Domains\Cve\Services\Service as CveService;
use Domains\Helpers\Payloads\FieldInterface;
use Illuminate\Support\Collection;

class CveQuery extends BaseQuery
{
    private function service(): CveService
    {
        return new CveService(
            repository: new Repository(
                query: Cve::query(),
                database: self::dbResolver()
            )

        );
    }
    private function with(): array
    {
        return [
            'adp' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(1);
            },
            'cna' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(1);
            },
        ];
    }

    public function query(): Collection
    {
        return $this->service()->findBy(
            column: 'title',
            value: $this->data[FieldInterface::FIELD_CVE_ID],
            with: $this->with()
        );
    }

}
