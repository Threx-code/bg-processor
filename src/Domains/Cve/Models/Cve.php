<?php

declare(strict_types=1);

namespace Domains\Cve\Models;

use Domains\Adp\Models\Adp;
use Domains\AdpMetrics\Models\AdpMetric;
use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Credit\Models\Credit;
use Domains\Cve\Observers\Observer;
use Domains\CvssV3\Models\CvssV3;
use Domains\Description\Models\Description;
use Domains\Exploit\Models\Exploit;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Metric\Models\Metric;
use Domains\Models\concerns\HasKey;
use Domains\Platform\Models\Platform;
use Domains\ProblemDescription\Models\ProblemDescription;
use Domains\ProblemType\Models\ProblemType;
use Domains\ProductVersion\Models\ProductVersion;
use Domains\Scenario\Models\Scenario;
use Domains\Solution\Models\Solution;
use Domains\SolutionSupportingMedia\Models\SolutionSupportingMedia;
use Domains\Source\Models\Source;
use Domains\SupportingMedia\Models\SupportingMedia;
use Domains\Timeline\Models\Timeline;
use Domains\VersionChange\Models\VersionChange;
use Domains\Workaround\Models\Workaround;
use Domains\WorkaroundSupportingMedia\Models\WorkaroundSupportingMedia;
use Domains\XGenerator\Models\XGenerator;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property string $key
 * @property string $cveId
 * @property string $title
 * @property string $state
 * @property string $assignerShortName
 * @property DateObject $dateReserved
 * @property DateObject $datePublished
 * @property DateObject $dateUpdated
 */
#[ObservedBy(Observer::class)]
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

    public function affectedProduct(): HasMany
    {
        return $this->hasMany(
            related: AffectedProduct::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function metric(): HasMany
    {
        return $this->hasMany(
            related: Metric::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function description(): HasMany
    {
        return $this->hasMany(
            related: Description::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function credit(): HasMany
    {
        return $this->hasMany(
            related: Credit::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function exploit(): HasMany
    {
        return $this->hasMany(
            related: Exploit::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function problemType(): HasMany
    {
        return $this->hasMany(
            related: ProblemType::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function solution(): HasMany
    {
        return $this->hasMany(
            related: Solution::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function source(): HasMany
    {
        return $this->hasMany(
            related: Source::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function timeline(): HasMany
    {
        return $this->hasMany(
            related: Timeline::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function workaround(): HasMany
    {
        return $this->hasMany(
            related: Workaround::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function xGenerator(): HasMany
    {
        return $this->hasMany(
            related: XGenerator::class,
            foreignKey: 'cveId',
            localKey: 'id'
        );
    }

    public function adpMetric(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: AdpMetric::class,
            through: Adp::class,
            firstKey: 'cveId',
            secondKey: 'adpId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function cvssV3(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: CvssV3::class,
            through: Metric::class,
            firstKey: 'cveId',
            secondKey: 'metricId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function scenario(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: Scenario::class,
            through: Metric::class,
            firstKey: 'cveId',
            secondKey: 'metricId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function platform(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: Platform::class,
            through: AffectedProduct::class,
            firstKey: 'cveId',
            secondKey: 'affectedProductId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function productVersion(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: ProductVersion::class,
            through: AffectedProduct::class,
            firstKey: 'cveId',
            secondKey: 'affectedProductId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function versionChange(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: VersionChange::class,
            through: AffectedProduct::class,
            firstKey: 'cveId',
            secondKey: 'affectedProductId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function supportingMedia(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: SupportingMedia::class,
            through: Description::class,
            firstKey: 'cveId',
            secondKey: 'descriptionId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function problemDescription(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: ProblemDescription::class,
            through: ProblemType::class,
            firstKey: 'cveId',
            secondKey: 'problemTypeId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function solutionSupportingMedia(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: SolutionSupportingMedia::class,
            through: Solution::class,
            firstKey: 'cveId',
            secondKey: 'solutionId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }

    public function workaroundSupportingMedia(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: WorkaroundSupportingMedia::class,
            through: Workaround::class,
            firstKey: 'cveId',
            secondKey: 'workaroundId',
            localKey: 'id',
            secondLocalKey: 'id'
        );
    }
}
