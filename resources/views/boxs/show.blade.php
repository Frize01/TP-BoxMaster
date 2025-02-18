<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Box - {{ $box->name }}
        </h2>
        <div class="flex align-middle gap-4">
            <a href="{{ route('box.edit', $box->id) }}"
                class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
                Modifier
            </a>
            <form action="{{ route('box.destroy', $box->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-500 px-2 py-1 bg-red-100 hover:bg-red-200 rounded-md hover:text-red-700">
                    Supprimer
                </button>
            </form>
        </div>

    </x-slot>

    <div class="py-6 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold pb-3 text-gray-900">
                        Informations
                    </h3>
                    <p>
                        <span class="font-bold">Adresse :</span> {{ $box->address }}
                    </p>
                    <p>
                        <span class="font-bold">Surface :</span> {{ $box->surface }} m²
                    </p>
                    <p>
                        <span class="font-bold">Volume :</span> {{ $box->volume }} m³
                    </p>
                    <p>
                        <span class="font-bold">Prix :</span> {{ $box->default_price }}€/mois
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-row justify-between items-center my-4">
                        <h3 class="text-xl font-bold text-gray-900">
                            Contracts
                        </h3>
                        <a href="{{ route('contract.createWithBox', $box->id) }}"
                            class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
                            Créer un nouveau contract
                        </a>
                    </div>
                    @if ($contracts->isEmpty())
                        <p>Aucun contract pour le moment</p>
                    @else
                        <div
                            class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                            <table class="w-full text-left table-auto min-w-max">
                                <thead>
                                    <tr class="hover:bg-slate-50">
                                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                                            <p class="block text-sm font-normal leading-none text-slate-500">
                                                Nom
                                            </p>
                                        </th>
                                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                                            <p class="block text-sm font-normal leading-none text-slate-500">
                                                État
                                            </p>
                                        </th>
                                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                                            <p class="block text-sm font-normal leading-none text-slate-500">
                                                Prix
                                            </p>
                                        </th>
                                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                                            <p class="block text-sm font-normal leading-none text-slate-500">
                                                Date de début
                                            </p>
                                        </th>
                                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                                            <p class="block text-sm font-normal leading-none text-slate-500">
                                                Date de fin
                                            </p>
                                        </th>
                                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                                            <p class="block text-sm font-normal leading-none text-slate-500">
                                                Afficher
                                            </p>
                                        </th>
                                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                                            <p class="block text-sm font-normal leading-none text-slate-500">
                                                Téléchargement
                                            </p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contracts as $contract)
                                        <tr class="hover:bg-slate-50">
                                            <td class="p-4 border-b border-slate-200">
                                                <p class="block text-sm text-slate-800">
                                                    {{ $contract->tenant->name }}
                                                </p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200">
                                                @if ($contract->status == 'active')
                                                    <p
                                                        class="inline-block text-green-500 px-2 py-1 bg-green-100 rounded-md">
                                                        Contrat actuel
                                                    </p>
                                                @elseif ($contract->status == 'pending')
                                                    <p
                                                        class="inline-block text-blue-500 px-2 py-1 bg-blue-100rounded-md">
                                                        Contrat futur
                                                    </p>
                                                @else
                                                    <p
                                                        class="inline-block text-red-500 px-2 py-1 bg-red-100 rounded-md">
                                                        Contrat terminé
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="p-4 border-b border-slate-200">
                                                <p class="block text-sm text-slate-800">
                                                    {{ $contract->price }} €
                                                </p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200">
                                                <p class="block text-sm text-slate-800">
                                                    {{ $contract->date_start->format('d/m/Y') }}
                                                </p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200">
                                                <p class="block text-sm text-slate-800">
                                                    {{ $contract->date_end->format('d/m/Y') }}
                                                </p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200">
                                                <a href="{{ route('contract.show', $contract->id) }}"
                                                    class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
                                                    Voir
                                                </a>
                                            </td>
                                            <td class="p-4 border-b border-slate-200">
                                                <a href="{{ route('contract.pdf',   $contract->id) }}"
                                                    class="text-purple-500 px-2 py-1 bg-purple-100 hover:bg-purple-200 rounded-md hover:text-purple-700">
                                                    Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
