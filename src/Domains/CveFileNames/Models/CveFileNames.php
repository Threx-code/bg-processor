<?php

namespace Domains\CveFileNames\Models;

use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $fileName
 * @property string $year
 */
class CveFileNames extends Model
{
    use HasFactory, HasKey;
    protected $guarded = [];
}

