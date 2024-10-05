<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Box
 *
 *
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property int $surface
 * @property string $description
 * @property int|null $volume
 * @property int $default_price
 */
class Box
{
    use HasFactory;

    protected $table = 'boxs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'name',
        'surface',
        'description',
        'volume',
        'default_price',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }
}
