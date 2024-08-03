<?php

declare(strict_types=1);

namespace Domains\Adp\Models;

use Domains\Adp\Observers\Observer as AdpObserver;
use Domains\Cve\Models\Cve;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\Casts\JsonData;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Helpers\ValueObjects\JsonObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property int cveId
 * @property string $title
 * @property JsonObject $providerMetaData
 * @property JsonObject $problemTypes
 * @property JsonObject $affected
 * @property JsonObject $metrics
 * @property DateObject $dateUpdated
 */
#[observedBy(AdpObserver::class)]
class Adp extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'problemTypes' => JsonData::class,
            'providerMetaData' => JsonData::class,
            'affected' => JsonData::class,
            'metrics' => JsonData::class,
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
}
