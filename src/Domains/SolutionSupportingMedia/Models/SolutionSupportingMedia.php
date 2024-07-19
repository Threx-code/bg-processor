<?php declare(strict_types=1);

namespace Domains\SolutionSupportingMedia\Models;

use Domains\Models\concerns\HasKey;
use Domains\Solution\Models\Solution;
use Domains\SolutionSupportingMedia\Observers\Observer as SolutionSupportingMediaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Solution $solutionId
 * @property bool $base64
 * @property string $type
 * @property string $value
 */

#[ObservedBy(SolutionSupportingMediaObserver::class)]
class SolutionSupportingMedia extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function solution(): BelongsTo
    {
        return $this->belongsTo(Solution::class, 'solutionId', 'id');
    }

    protected function casts(): array
    {
        return [
            'solutionId' => Solution::class,
        ];
    }
}
