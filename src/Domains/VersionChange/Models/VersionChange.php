<?php

namespace Domains\VersionChange\Models;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property AffectedProduct $affectedProductId
 * @property string $at
 * @property string $status
 */
class VersionChange extends Model
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
