<?php declare(strict_types=1);

namespace Domains\AdpMetrics\Models;

use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdpMetrics extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];
}
