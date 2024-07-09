<?php

namespace Domains\SupportingMedia\Models;

use Domains\Description\Models\Description;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Description $descriptionId
 * @property bool $base64
 * @property string $type
 * @property string $value
 */
class SupportingMedia extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function description(): BelongsTo
    {
        return $this->belongsTo(Description::class, 'descriptionId', 'id');
    }

    protected function casts(): array
    {
        return [
            'descriptionId' => Description::class,
        ];
    }
}
