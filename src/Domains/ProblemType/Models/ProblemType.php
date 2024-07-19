<?php

declare(strict_types=1);

namespace Domains\ProblemType\Models;

use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Domains\ProblemDescription\Models\ProblemDescription;
use Domains\ProblemType\Observers\Observer as ProblemTypeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property Cve $cveId
 * @property string $cweId
 * @property string $description
 * @property string $lang
 * @property string $type
 */
#[ObservedBy(ProblemTypeObserver::class)]
class ProblemType extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }

    public function problemDescription(): HasMany
    {
        return $this->hasMany(ProblemDescription::class, 'problemTypeId', 'id');
    }

    protected function casts(): array
    {
        return [
            'cveId' => Cve::class,
        ];
    }
}
