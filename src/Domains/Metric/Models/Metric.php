<?php declare(strict_types=1);

namespace Domains\Metric\Models;

use Domains\Cve\Models\Cve;
use Domains\CvssV3\Models\CvssV3;
use Domains\Models\concerns\HasKey;
use Domains\Scenario\Models\Scenario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Domains\Metric\Observers\Observer as MetricObserver;

/**
 * @property int $id
 * @property string $key
 * @property int $cveId
 * @property string $format
 */

#[ObservedBy(MetricObserver::class)]
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

}
