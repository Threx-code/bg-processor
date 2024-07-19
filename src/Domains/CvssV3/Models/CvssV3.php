<?php declare(strict_types=1);

namespace Domains\CvssV3\Models;

use Domains\CvssV3\Observers\Observer as CvssV3Observer;
use Domains\Metric\Models\Metric;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Metric $metricId
 * @property string $attackComplexity
 * @property string $attackVector
 * @property string $availabilityImpact
 * @property float $baseScore
 * @property string $baseSeverity
 * @property string $confidentialityImpact
 * @property string $integrityImpact
 * @property string $privilegesRequired
 * @property string $scope
 * @property string $userInteraction
 * @property string $vectorString
 * @property string $version
 */
#[ObservedBy(CvssV3Observer::class)]
class CvssV3 extends Model
{
    use HasFactory, HasKey;

    protected $table = 'cvss_v3s';

    protected $guarded = [];

    public function metric(): BelongsTo
    {
        return $this->belongsTo(Metric::class, 'metricId', 'id');
    }
    protected function casts(): array
    {
        return [
            'metricId' => Metric::class,
        ];
    }
}
