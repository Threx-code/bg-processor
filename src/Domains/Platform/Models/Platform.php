<?php

declare(strict_types=1);

namespace Domains\Platform\Models;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Models\concerns\HasKey;
use Domains\Platform\Observers\Observer as PlatformObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property AffectedProduct $affectedProductId
 * @property string $platform
 */
#[ObservedBy(PlatformObserver::class)]
class Platform extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function affectedProduct(): BelongsTo
    {
        return $this->belongsTo(AffectedProduct::class, 'affectedProductId', 'id');
    }

    protected function casts(): array
    {
        return [
            'affectedProductId' => AffectedProduct::class,
        ];
    }
}
