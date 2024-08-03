<?php

declare(strict_types=1);

namespace Domains\Cna\Models;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\Casts\JsonData;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Helpers\ValueObjects\JsonObject;
use Domains\Cna\Observers\Observer as CnaObserver;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property int $cveId
 * @property string $title
 * @property JsonObject $providerMetadata
 * @property JsonObject $descriptions
 * @property JsonObject $affected
 * @property JsonObject $references
 * @property JsonObject $problemTypes
 * @property JsonObject $xGenerator
 * @property JsonObject $xLegacyV4Record
 * @property DateObject $dateUpdated
 */
#[ObservedBy(CnaObserver::class)]
class Cna extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }

    protected function casts(): array
    {
        return [
            'providerMetadata' => JsonData::class,
            'descriptions' => JsonData::class,
            'affected' => JsonData::class,
            'references' => JsonData::class,
            'problemTypes' => JsonData::class,
            'xGenerator' => JsonData::class,
            'xLegacyV4Record' => JsonData::class,
            'dateUpdated' => Date::class,
        ];
    }
}
