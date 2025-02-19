<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Accueil
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold pb-3 text-gray-900">Calcul des impôts pour l'année {{ $currentYear }}
                    </h3>

                    @if ($billByYear <= 0)
                        <p class="text-gray-500 text-center">Aucun revenu trouvé pour cette année</p>
                    @else
                        <p class="text-lg mt-4">
                            Total des revenus pour l'année {{ $currentYear }} :
                            <span class="font-bold">{{ number_format($billByYear, 2) }} €</span>
                        </p>

                        @if ($billByYear <= 15000)
                            <div class="mt-6">
                                <h4 class="text-xl">Régime Micro-Foncier</h4>
                                <p class="mt-2">Montant total à déclarer (case 4 BE déclaration n°2042) :
                                    <span>{{ number_format($billByYear, 2) }} €</span>
                                </p>
                                <p class="mt-2">Montant imposable (après abattement de 30%) :
                                    <span>{{ number_format($billByYear * 0.7, 2) }} €</span>
                                </p>
                            </div>
                        @else
                            <div class="mt-6">
                                <h4 class="text-xl">Régime Réel</h4>
                                <p class="mt-2">Montant total à déclarer (case 4 BA déclaration n°2044) :
                                    <span>{{ number_format($billByYear, 2) }} €</span>
                                </p>
                                <p class="mt-2">Montant imposable (100% des revenus) :
                                    <span>{{ number_format($billByYear, 2) }} €</span>
                                </p>
                            </div>
                        @endif
                    @endif

                    <div class="flex justify-end py-2">
                        <a href="{{ route('impots.index') }}"
                            class="text-gray-500 px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded-md hover:text-gray-700 text-center">
                            Consulter toutes les années
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold pb-3 text-gray-900">Effectuer un export des différents paiements</h2>
                    <a href="{{ route('bill.export') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        📤 Exporter en Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($bills->isEmpty())
                        <p class="text-gray-500 text-center">Aucune facture trouvée</p>
                    @else
                        <h3 class="text-xl font-bold pb-3 text-gray-900">
                            Factures impayées
                        </h3>
                        <p class="text-lg mt-4">{{ $bills->where('payment_date', null)->count() }} factures en attente
                            de
                            paiement
                            soit <span
                                class="text-red-500 font-bold">{{ $bills->where('payment_date', null)->sum('paiement_montant') }}€</span>
                            en voici la liste
                        </p>

                        <table class="w-full min-w-7xl text-left table-auto mt-2">
                            <thead>
                                <tr>
                                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                                        <p class="block text-sm font-normal leading-none text-slate-500">
                                            Période de facture
                                        </p>
                                    </th>

                                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                                        <p class="block text-sm font-normal leading-none text-slate-500">
                                            Montant de facture
                                        </p>
                                    </th>

                                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                                        <p class="block text-sm font-normal leading-none text-slate-500">
                                            Facture
                                        </p>
                                    </th>

                                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                                        <p class="block text-sm font-normal leading-none text-slate-500">
                                            Contrat
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills->where('payment_date', null) as $bill)
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-4 border-b border-slate-200">
                                            <p class="block text-sm text-slate-800">
                                                {{ $bill->period_number }}
                                            </p>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <p class="block text-sm text-slate-800">
                                                {{ $bill->paiement_montant }}€
                                            </p>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <a href="{{ route('bill.download', $bill->id) }}"
                                                class="text-purple-500 px-2 py-1 bg-purple-100 hover:bg-purple-200 rounded-md hover:text-purple-700">
                                                Télécharger
                                            </a>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <a href="{{ route('contract.show', $bill->contract_id) }}"
                                                class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
                                                Voir le contrat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
