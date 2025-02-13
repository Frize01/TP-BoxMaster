<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Box
 *
 *
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property int $surface
 * @property string $address
 * @property int|null $volume
 * @property int $default_price
 */
class Box extends Model
{
    use HasFactory;

    protected $table = 'boxs';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'name',
        'surface',
        'address',
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

    public function isAvailable(): Attribute
    {
        if ($this->contract()->where('box_id', $this->id)->where('date_start', '<=', now())->where('date_end', '>', now())->count() == 0)
        {
            return Attribute::make(get: fn () => true);
        }

        return Attribute::make(get: fn () => false);
    }

    public function contract(): HasMany
    {
        return $this->hasMany(Contract::class, 'box_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
