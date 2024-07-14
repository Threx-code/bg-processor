<?php

namespace Domains\Solution\Models;

use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Domains\SolutionSupportingMedia\Models\SolutionSupportingMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property Cve $cveId
 * @property string $lang
 * @property string $value
 */
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

    protected function casts(): array
    {
        return [
            'cveId' => Cve::class,
        ];
    }
}
