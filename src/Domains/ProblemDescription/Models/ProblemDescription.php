<?php declare(strict_types=1);

namespace Domains\ProblemDescription\Models;

use Domains\Models\concerns\HasKey;
use Domains\ProblemType\Models\ProblemType;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Domains\ProblemDescription\Observers\Observer as ProblemDescriptionObserver;
/**
 * @property int $id
 * @property string $key
 * @property int $problemTypeId
 * @property string $cweId
 * @property string $lang
 * @property string $type
 * @property string $description
 */

#[ObservedBy(ProblemDescriptionObserver::class)]
class ProblemDescription extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function problemType(): BelongsTo
    {
        return $this->belongsTo(ProblemType::class, 'problemTypeId', 'id');
    }

}
