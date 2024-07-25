<?php

declare(strict_types=1);

namespace Domains\Cve\Models;

use Domains\Adp\Models\Adp;
use Domains\Cve\Observers\Observer as CVeObserver;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Cna\Models\Cna;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property string $assignerOrgId
 * @property string $title
 * @property string $state
 * @property string $assignerShortName
 * @property DateObject $dateReserved
 * @property DateObject $datePublished
 * @property DateObject $dateUpdated
 */
#[ObservedBy(CVeObserver::class)]
class Cve extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'dateReserved' => Date::class,
            'datePublished' => Date::class,
            'dateUpdated' => Date::class,
        ];
    }

    public function adp(): HasMany
    {
        return $this->hasMany(
            related: Adp::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function cna(): HasMany
    {
        return $this->hasMany(
            related: Cna::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }
}
