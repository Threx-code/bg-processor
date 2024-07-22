<?php declare(strict_types=1);

namespace Domains\ProductVersion\Models;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Domains\ProductVersion\Observers\Observer as ProductVersionObserver;

/**
 * @property int $id
 * @property string $key
 * @property int $affectedProductId
 * @property string $version
 * @property string $lessThan
 * @property string $status
 * @property string $versionType
 */

#[ObservedBy(ProductVersionObserver::class)]
class ProductVersion extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function affectedProduct(): BelongsTo
    {
        return $this->belongsTo(AffectedProduct::class, 'affectedProductId', 'id');
    }
}

