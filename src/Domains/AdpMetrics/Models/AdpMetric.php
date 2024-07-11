<?php

declare(strict_types=1);

namespace Domains\AdpMetrics\Models;

use Domains\Adp\Models\Adp;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Adp $adpId
 * @property string $type
 * @property string $contentId
 * @property string $role
 * @property string $exploitation
 * @property string $automatable
 * @property string $technicalImpact
 * @property string $version
 * @property DateObject $date
 */
class AdpMetric extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function adp(): BelongsTo
    {
        return $this->belongsTo(Adp::class, 'adpId', 'id');
    }

    protected function casts(): array
    {
        return [
            'date' => Date::class,
        ];
    }
}

