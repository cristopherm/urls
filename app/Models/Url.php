<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Url model.
 *
 * @package App\Models
 *
 * @property  int $id
 * @property  string $name
 * @property  string $address
 * @property  string $last_status_code
 * @property  string $last_verified_at
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 */
class Url extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
        'last_status_code',
        'last_verified_at',
    ];

    /**
     * The attributes that should be cast to date.
     *
     * @var array
     */
    protected $dates = [
        'last_verified_at',
    ];

    /**
     * The logs that belong to the logs.
     */
    public function logs()
    {
        return $this->hasMany(TrackingLog::class)
            ->orderBy('created_at', 'desc');
    }
}
