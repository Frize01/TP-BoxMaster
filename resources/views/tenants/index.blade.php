<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des locataires
        </h2>
        <a href="{{ route('tenant.create') }}"
            class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
            Ajouter
        </a>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold pb-3 text-gray-900">Effectuer un export des différents locataire</h2>
                    <a href="{{ route('tenant.export') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        📤 Exporter en CSV
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                @if ($tenants->isEmpty())
                    <p class="text-gray-500 text-center p-6">Aucun locataire trouvé</p>
                @else
                    <table class="w-full min-w-7xl text-left table-auto">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Nom
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Mail
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Téléphone
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Actions
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $tenant->name }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $tenant->mail }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $tenant->tel }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <div class="flex h-full gap-2">
                                            <a href="{{ route('tenant.show', $tenant->id) }}"
                                                class="text-blue-500 px-2 py-1 bg-blue-100 rounded-md hover:text-blue-700">
                                                Voir
                                            </a>
                                            <a href="{{ route('tenant.edit', $tenant->id) }}"
                                                class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
                                                Modifier
                                            </a>
                                            <form action="{{ route('tenant.destroy', $tenant->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 px-2 py-1 bg-red-100 hover:bg-red-200 rounded-md hover:text-red-700">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
