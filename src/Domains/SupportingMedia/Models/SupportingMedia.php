<?php declare(strict_types=1);

namespace Domains\SupportingMedia\Models;

use Domains\Description\Models\Description;
use Domains\Models\concerns\HasKey;
use Domains\SupportingMedia\Observers\Observer as SupportingMediaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property int $descriptionId
 * @property bool $base64
 * @property string $type
 * @property string $value
 */

#[ObservedBy(SupportingMediaObserver::class)]
class SupportingMedia extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function description(): BelongsTo
    {
        return $this->belongsTo(Description::class, 'descriptionId', 'id');
    }

}
