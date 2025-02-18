<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des contrats
        </h2>
        <a href="{{ route('contract.create') }}"
            class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
            Ajouter
        </a>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                            <p class="inline-block text-green-500 px-2 py-1 bg-green-100 rounded-md">
                                                Contrat actuel
                                            </p>
                                        @elseif ($contract->status == 'pending')
                                            <p class="inline-block text-blue-500 px-2 py-1 bg-blue-100rounded-md">
                                                Contrat futur
                                            </p>
                                        @else
                                            <p class="inline-block text-red-500 px-2 py-1 bg-red-100 rounded-md">
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
                                </tr>
                            @endforeach
                </div>
            </div>
</x-app-layout>
