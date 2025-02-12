<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Box - {{ $box->name }}
        </h2>
        <a href="{{ route('box.edit', $box->id) }}" class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
            Modifier
        </a>
    </x-slot>

    <div class="py-6 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold pb-3 text-gray-900">
                        Informations
                    </h3>
                    <p>
                        <span class="font-bold">Description :</span> {{ $box->description }}
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
                    <h3 class="text-lg font-medium leading-6 pb-4 text-gray-900">
                        Locations
                    </h3>
                    @if ($locations->isEmpty())
                        <p>Aucune location pour le moment</p>
                    @else
                    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Nom
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                            <tr class="hover:bg-slate-50
                                @if ($location->date_end > now() && $location->date_start < now())
                                    bg-blue-50
                                @elseif ($location->date_end < now())
                                    bg-red-50
                                @endif
                            ">
                                <td class="p-4 border-b border-slate-200">
                                    <p class="block text-sm text-slate-800">
                                        {{ $location->tenant->name }}
                                    </p>
                                </td>
                                <td class="p-4 border-b border-slate-200">
                                    <p class="block text-sm text-slate-800">
                                        {{ $location->price }} €
                                    </p>
                                </td>
                                <td class="p-4 border-b border-slate-200">
                                    <p class="block text-sm text-slate-800">
                                        {{ $location->date_start->format('d/m/Y') }}
                                    </p>
                                </td>
                                <td class="p-4 border-b border-slate-200">
                                    <p class="block text-sm text-slate-800">
                                        {{ $location->date_end->format('d/m/Y') }}
                                    </p>
                                </td>

                            </tr>
                            @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
