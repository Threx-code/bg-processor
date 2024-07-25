<?php

declare(strict_types=1);

namespace Domains\CveFileNames\Models;

use Domains\CveFileNames\Observers\Observer as CveFileNamesObserver;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $fileName
 */
#[ObservedBy(CveFileNamesObserver::class)]
class CveFileNames extends Model
{
    use HasFactory, HasKey;
    protected $guarded = [];
}
