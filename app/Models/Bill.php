<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Box
 *
 *
 * @property int $id
 * @property Contract $contract_id
 * @property int $paiement_montant
 * @property string $period_number
 * @property \Illuminate\Support\Carbon $payment_date
 */

class Bill extends Model
{

    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory;

    protected $table = 'bills';

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'paiement_montant',
        'payment_date',
        'period_number',
        'contract_id',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];


    /**
     * Obtenir le contrat associé à la facture.
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }
}
