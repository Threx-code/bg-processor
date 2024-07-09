<?php

namespace Domains\Description\Models;

use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Cve $cveId
 * @property string $value
 */
class Description extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    public function cve(): BelongsTo
    {
        return $this->belongsTo(Cve::class, 'cveId', 'id');
    }
    protected function casts(): array
    {
        return [
            'cveId' => Cve::class,
        ];
    }
}
