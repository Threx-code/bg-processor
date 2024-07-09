<?php

declare(strict_types=1);

namespace Domains\Cve\Models;

use Domains\CveFileNames\Observers\CveFileNameObserver;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $cveId
 * @property string $title
 * @property string $state
 * @property string $assignerShortName
 * @property DateObject $dateReserved
 * @property DateObject $datePublished
 * @property DateObject $dateUpdated
 */

#[ObservedBy(CveFileNameObserver::class)]
class Cve extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'dateReserved' => Date::class,
            'datePublished' => Date::class,
            'dateUpdated' => Date::class,
        ];
    }
}
