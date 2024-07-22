<?php

namespace Domains\WorkaroundSupportingMedia\Models;

use Domains\Models\concerns\HasKey;
use Domains\Workaround\Models\Workaround;
use Domains\WorkaroundSupportingMedia\Observers\Observer as WorkaroundSupportingMediaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property int $workaroundId
 * @property bool $base64
 * @property string $type
 * @property string $value
 */
#[ObservedBy(WorkaroundSupportingMediaObserver::class)]
class WorkaroundSupportingMedia extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function workaround(): BelongsTo
    {
        return $this->belongsTo(Workaround::class, 'workaroundId', 'id');
    }

}
