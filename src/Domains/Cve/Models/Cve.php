<?php

declare(strict_types=1);

namespace Domains\Cve\Models;

use Domains\Adp\Models\Adp;
use Domains\AdpMetrics\Models\AdpMetric;
use Domains\Cve\Observers\Observer;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
#[ObservedBy(Observer::class)]
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

    public function adps(): HasMany
    {
        return $this->hasMany(
            related: Adp::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function adpMetric(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: AdpMetric::class,
            through: Adp::class,
            firstKey: 'cveId',
            secondKey: 'adpId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }
}
