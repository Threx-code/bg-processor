<?php

declare(strict_types=1);

namespace Domains\Adp\Models;

use Domains\Cve\Models\Cve;
use Domains\CveFileNames\Observers\Observer;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string $shortName
 * @property string $orgId
 * @property DateObject $dateUpdated
 * @property Cve cveId
 */
#[observedBy(Observer::class)]
class Adp extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'dateUpdated' => Date::class,
            'cveId' => Cve::class,
        ];
    }

    public function cveId(): BelongsTo
    {
        return $this->belongsTo(
            related: Cve::class,
            foreignKey: 'cveId',
            ownerKey: 'id'
        );
    }
}
