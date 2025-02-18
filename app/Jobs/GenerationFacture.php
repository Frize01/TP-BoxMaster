<?php
namespace App\Jobs;

use App\Models\Box;
use App\Models\Contract;
use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerationFacture implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     *
     * @param $userId
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // Récupérer l'utilisateur par son ID
        $user = \App\Models\User::find($this->userId);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            // L'utilisateur n'existe pas, gérer l'erreur si nécessaire
            return;
        }

        $boxs = Box::where('owner_id', $user->id)->pluck('id')->toArray();
        $currentPeriod = Carbon::now()->format('m-Y');

        $contracts = Contract::whereIn('box_id', $boxs)
            ->whereDoesntHave('bills', function ($query) use ($currentPeriod) {
                $query->where('period_number', $currentPeriod);
            })
            ->get();

        foreach ($contracts as $contract) {
            Bill::create([
                'contract_id' => $contract->id,
                'paiement_montant' => $contract->price,
                'payment_date' => null,
                'period_number' => $currentPeriod,
            ]);
        }
    }
}