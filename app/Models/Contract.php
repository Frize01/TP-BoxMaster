<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Contract
 *
 * @property int $id
 * @property Box $box_id
 * @property Tenant $tenant_id
 * @property float $price
 * @property string $resiliation_delay
 * @property string $localisation
 * @property ModelContract $model_contract_id
 * @property \Illuminate\Support\Carbon $date_start
 * @property \Illuminate\Support\Carbon $date_end
 */
class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'box_id',
        'tenant_id',
        'price',
        'resiliation_delay',
        'localisation',
        'date_start',
        'date_end',
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
            'date_start' => 'datetime',
            'date_end' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class, 'box_id', 'id');
    }


    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(ModelContract::class, 'model_contract_id', 'id');
    }

    public function status(): Attribute
    {
        $now = now();

        if ($now->lessThan($this->date_start)) {
            $status = 'pending';
        } elseif ($now->greaterThan($this->date_end)) {
            $status = 'ending';
        } else {
            $status = 'active';
        }

        return Attribute::make(
            get: fn () => $status
        );
    }
}
