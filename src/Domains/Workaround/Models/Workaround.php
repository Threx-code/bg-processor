<?php

namespace Domains\Workaround\Models;

use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Domains\Workaround\Observers\Observer as WorkaroundObserver;
use Domains\WorkaroundSupportingMedia\Models\WorkaroundSupportingMedia;
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

#[ObservedBy(WorkaroundObserver::class)]
class Workaround extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }

    public function workaroundSupportingMedia(): HasMany
    {
        return $this->hasMany(WorkaroundSupportingMedia::class, 'workaroundId', 'id');
    }

}
