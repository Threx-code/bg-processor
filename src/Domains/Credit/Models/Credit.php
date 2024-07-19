<?php declare(strict_types=1);

namespace Domains\Credit\Models;

use Domains\Credit\Observers\Observer as CreditObserver;
use Domains\Cve\Models\Cve;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property Cve $cveId
 * @property string $lang
 * @property string $type
 * @property string $value
 */
#[ObservedBy(CreditObserver::class)]
class Credit extends Model
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
