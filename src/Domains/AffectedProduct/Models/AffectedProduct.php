<?php

namespace Domains\AffectedProduct\Models;

use Domains\Cve\Models\Cve;
use Domains\AffectedProduct\Observers\Observer;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Cve $cveId
 * @property string $product
 * @property string $vendor
 * @property string $defaultStatus
 */

#[observedBy(Observer::class)]
class AffectedProduct extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }
}

