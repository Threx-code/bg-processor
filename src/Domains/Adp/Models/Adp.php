<?php

declare(strict_types=1);

namespace Domains\Adp\Models;

use Domains\Adp\Observers\Observer as AdpObserver;
use Domains\AdpMetrics\Models\AdpMetric;
use Domains\Cve\Models\Cve;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string $shortName
 * @property string $orgId
 * @property DateObject $dateUpdated
 * @property int cveId
 */
#[observedBy(AdpObserver::class)]
class Adp extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'dateUpdated' => Date::class,
        ];
    }

    public function cve(): BelongsTo
    {
        return $this->belongsTo(
            related: Cve::class,
            foreignKey: 'cveId',
            ownerKey: 'id'
        );
    }

    public function adpMetric(): HasMany
    {
        return $this->hasMany(
            related: AdpMetric::class,
            foreignKey: 'adpId',
            localKey: 'id'
        );
    }
}
