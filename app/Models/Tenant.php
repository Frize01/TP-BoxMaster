<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Tenant
 *
 *
 * @property int $id
 * @property string $name
 * @property int $tel
 * @property string $mail
 * @property string $address
 * @property string $rib
 * @property User $owner_id
 */
class Tenant extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $table = 'tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tel',
        'mail',
        'address',
        'rib',
        'linked_user'
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
        return [
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contract(): HasMany
    {
        return $this->hasMany(Contract::class, 'tenant_id');
    }
}
