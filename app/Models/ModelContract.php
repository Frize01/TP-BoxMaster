<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;



/**
 * Class ModelContract
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property User $owner_id
 * @property int $default_deposit
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class ModelContract extends Model
{
    use HasFactory;

    protected $table = 'contract_models';

    public static $availableVariable = [
        '%date_start%' => 'Date de début du contrat',
        '%date_end%' => 'Date de fin du contrat',
        '%monthly_price%' => 'Montant mensuel du loyer',
        '%box%' => 'Nom de la box',
        '%depot_garantie' => 'Montant du dépôt de garantie',
        '%tenant%' => 'Le locataire',
        '%adresse_box%' => 'Adresse de la box',
        '%bailleur_nom%' => 'Nom du Bailleur',
        '%bailleur_adresse%' => 'Adresse du Bailleur',
        '%locataire_adresse%' => 'Adresse du Locataire',
        '%delai_resiliation%' => 'Délai de résiliation',
        '%lieu%' => 'Lieu de signature',
        '%date_signature%' => 'Date de signature'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'content',
        'owner_id',
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
            'content' => 'json',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the ModelContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'model_contract_id');
    }


    public function generateContent(Contract $contract)
    {
        $sentence = $this->content;
        $replacements = [
            '%date_start%' => $contract->date_start->format('d/m/Y'),
            '%date_end%' => $contract->date_end->format('d/m/Y'),
            '%monthly_price%' => $contract->price.'€',
            '%box%' => $contract->box->name,
            '%adresse_box%' => $contract->box->address,
            '%depot_garantie%' => $contract->deposit.'€',
            '%tenant%' => $contract->tenant->name,
            '%bailleur_nom%' => Auth::user()->name,
            '%bailleur_adresse%' => Auth::user()->address,
            '%locataire_adresse%' => $contract->tenant->address,
            '%delai_resiliation%' => $contract->resiliation_delay,
            '%lieu%' => $contract->localisation ,
            '%date_signature%' => now()->format('d/m/Y')
        ];

        $modified_sentence = preg_replace_callback('/%(\w+)%/', function ($matches) use ($replacements) {
            $key = '%' . $matches[1] . '%';
            return isset($replacements[$key]) ? $replacements[$key] : $matches[0];  // Retourner la valeur correspondante ou le placeholder original
        }, $sentence);

        return $modified_sentence;
    }
}
