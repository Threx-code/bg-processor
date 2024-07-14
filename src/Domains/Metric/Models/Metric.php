<?php

namespace Domains\Metric\Models;

use Domains\Cve\Models\Cve;
use Domains\CvssV3\Models\CvssV3;
use Domains\Models\concerns\HasKey;
use Domains\Scenario\Models\Scenario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property Cve $cveId
 * @property string $format
 */
class Metric extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }

    public function cvssV3(): HasMany
    {
        return $this->hasMany(CvssV3::class, 'metricId', 'id');
    }

    public function scenario(): HasMany
    {
        return $this->hasMany(Scenario::class, 'metricId', 'id');
    }

    protected function casts(): array
    {
        return [
            'cveId' => Cve::class,
        ];
    }
}
