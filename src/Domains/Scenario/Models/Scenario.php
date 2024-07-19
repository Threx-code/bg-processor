<?php declare(strict_types=1);

namespace Domains\Scenario\Models;

use Domains\Metric\Models\Metric;
use Domains\Models\concerns\HasKey;
use Domains\Scenario\Observers\Observer as ScenarioObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Metric $metricId
 * @property string $lang
 * @property string $value
 */

#[ObservedBy(ScenarioObserver::class)]
class Scenario extends Model
{
    use HasFactory, HasKey;

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
