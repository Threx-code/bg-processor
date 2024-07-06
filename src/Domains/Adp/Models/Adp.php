<?php declare(strict_types=1);

namespace Domains\Adp\Models;

use Domains\AdpMetrics\Models\Cve;
use Domains\Adp\Casts\Date;
use Domains\Adp\Casts\Title;
use Domains\Adp\Observers\AdpObserver;
use Domains\Adp\ValueObjects\DateUpdatedObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property Title $title
 * @property string $shortName
 * @property string $orgId
 * @property DateUpdatedObject $dateUpdated
 * @property Cve cveId
 */

#[observedBy(AdpObserver::class)]
class Adp extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'dateUpdated' => Date::class,
            'title' => Title::class,
            'cveId' => Cve::class
        ];
    }
}
