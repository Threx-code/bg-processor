<?php

namespace Domains\ProblemDescription\Models;

use Domains\Models\concerns\HasKey;
use Domains\ProblemType\Models\ProblemType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property ProblemType $problemTypeId
 * @property string $cweId
 * @property string $lang
 * @property string $type
 * @property string $description
 */
class ProblemDescription extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function problemType(): BelongsTo
    {
        return $this->belongsTo(ProblemType::class, 'problemTypeId', 'id');
    }

    protected function casts(): array
    {
        return [
            'problemTypeId' => ProblemType::class,
        ];
    }
}
