<?php declare(strict_types=1);

namespace Domains\Description\Models;

use Domains\Cve\Models\Cve;
use Domains\Description\Observers\Observer as DescriptionObserver;
use Domains\Models\concerns\HasKey;
use Domains\SupportingMedia\Models\SupportingMedia;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property int $cveId
 * @property string $value
 */

#[ObservedBy(DescriptionObserver::class)]
class Description extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }

    public function supportingMedia(): HasMany
    {
        return $this->hasMany(SupportingMedia::class, 'descriptionId', 'id');
    }

}
