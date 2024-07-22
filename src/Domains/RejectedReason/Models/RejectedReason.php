<?php

declare(strict_types=1);

namespace Domains\RejectedReason\Models;

use Domains\RejectedReason\Observers\Observer as RejectedReasonObserver;
use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property string $lang
 * @property string $value
 * @property int cveId
 */
#[observedBy(RejectedReasonObserver::class)]
class RejectedReason extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];


    public function cve(): BelongsTo
    {
        return $this->belongsTo(
            related: Cve::class,
            foreignKey: 'cveId',
            ownerKey: 'id'
        );
    }
}
