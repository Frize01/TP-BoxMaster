<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Accueil
        </h2>
    </x-slot>



    <div class="py-6 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold pb-3 text-gray-900">
                        Factures
                    </h3>
                    <p class="text-lg">{{ $bills->where('payment_date', '!=' ,null)->count() }} factures payé
                        soit <span class="text-green-500 font-bold">{{ $bills->where('payment_date', '!=' ,null)->sum('paiement_montant') }}€</span>
                    </p>
                    <p class="text-lg mt-4">{{ $bills->where('payment_date', null)->count() }} factures en attente de paiement
                        soit <span class="text-red-500 font-bold">{{ $bills->where('payment_date', null)->sum('paiement_montant') }}€</span> en voici la liste
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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
