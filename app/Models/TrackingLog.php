<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * TrackingLog model.
 *
 * @package App\Models
 *
 * @property  int $id
 * @property  int $url_id
 * @property  int $status_code
 * @property  string $body
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 */
class TrackingLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'url_id',
        'status_code',
        'body',
    ];
}
