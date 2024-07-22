<?php declare(strict_types=1);

namespace Domains\Solution\Models;

use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Domains\Solution\Observers\Observer as SolutionObserver;
use Domains\SolutionSupportingMedia\Models\SolutionSupportingMedia;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property int $cveId
 * @property string $lang
 * @property string $value
 */

#[ObservedBy(SolutionObserver::class)]
class Solution extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }

    public function solutionSupportingMedia(): HasMany
    {
        return $this->hasMany(SolutionSupportingMedia::class, 'solutionId', 'id');
    }
}
