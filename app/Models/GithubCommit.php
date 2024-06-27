<?php declare(strict_types=1);

namespace App\Models;

use App\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $key
 * @property int $id
 * @property string $commit_date
 */
class GithubCommit extends Model
{
    use HasFactory, HasKey;
}
