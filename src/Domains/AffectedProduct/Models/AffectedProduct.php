<?php declare(strict_types=1);

namespace Domains\AffectedProduct\Models;

use Domains\AffectedProduct\Observers\Observer as AffectedProductObserver;
use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Domains\Platform\Models\Platform;
use Domains\ProductVersion\Models\ProductVersion;
use Domains\VersionChange\Models\VersionChange;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property Cve $cveId
 * @property string $product
 * @property string $vendor
 * @property string $defaultStatus
 */
#[observedBy(AffectedProductObserver::class)]
class AffectedProduct extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }

    public function platform(): HasMany
    {
        return $this->hasMany(Platform::class, 'affectedProductId', 'id');
    }

    public function productVersions(): HasMany
    {
        return $this->hasMany(ProductVersion::class, 'affectedProductId', 'id');
    }

    public function versionChanges(): HasMany
    {
        return $this->hasMany(VersionChange::class, 'affectedProductId', 'id');
    }

    protected function casts(): array
    {
        return [
            'cveId' => Cve::class,
        ];
    }
}
