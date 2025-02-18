<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contrat - {{ $contract->box->name }} - {{ $contract->tenant->name }}
        </h2>
        <a href="{{ route('contract.edit', $contract->id) }}"
            class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
            Modifier
        </a>
    </x-slot>

    <div class="flex flex-col md:flex-row justify-around max-w-7xl mx-auto">
        <div class="py-6 flex-1 h-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg min-h-full">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-bold pb-3 text-gray-900">
                            Informations sur le client
                        </h3>
                        <p> <span class="font-bold">Nom :</span> {{ $contract->tenant->name }}</p>
                        <p>
                            <span class="font-bold">Numero de téléphone :</span> {{ $contract->tenant->tel }}
                        </p>
                        <p>
                            <span class="font-bold">Mail :</span> <a href="mailto:{{ $contract->tenant->mail }}">{{ $contract->tenant->mail }}</a>
                        </p>
                        <p>
                            <span class="font-bold">Adresse :</span> {{ $contract->tenant->address }}
                        </p>
                        <p>
                            <span class="font-bold">RIB :</span> {{ Str::mask($contract->tenant->rib, '*', 4) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6 flex-1 h-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg min-h-full">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-bold pb-3 text-gray-900">
                            Informations sur le box
                        </h3>
                        <p>
                            <span class="font-bold">Adresse :</span> {{ $contract->box->address }}
                        </p>
                        <p>
                            <span class="font-bold">Surface :</span> {{ $contract->box->surface }} m²
                        </p>
                        <p>
                            <span class="font-bold">Volume :</span> {{ $contract->box->volume }} m³
                        </p>
                        <p>
                            <span class="font-bold">Prix :</span> {{ $contract->box->default_price }}€/mois
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold pb-3 text-gray-900">
                        Informations sur le Contrat
                    </h3>
                    <p>
                        <span class="font-bold">Prix :</span> {{ $contract->price }}€/mois
                    </p>
                    <p>
                        <span class="font-bold">Debut du debut de contrat :</span> {{ $contract->date_start->format('d/m/Y') }}
                    </p>
                    <p>
                        <span class="font-bold">Fin du debut de contrat :</span> {{ $contract->date_end->format('d/m/Y') }}
                    </p>
                    <p>
                        <span class="font-bold">Résiliation :</span> {{ $contract->resiliation_delay }}
                    </p>
                    <p>
                        <span class="font-bold">Lieu :</span> {{ $contract->localisation }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                @if ($modelContracts->isEmpty())
                    <p class="text-gray-500 text-center p-6">Aucun modèle trouvé</p>
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
                                  Actions
                              </p>
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($modelContracts as $modelContract)
                      <tr class="hover:bg-slate-50">
                          <td class="p-4 border-b border-slate-200">
                              <p class="block text-sm text-slate-800">
                                  {{ $modelContract->name }}
                              </p>
                          </td>
                          <td class="p-4 border-b border-slate-200">
                            <div class="flex h-full gap-2">
                                <a href="{{ route('modelContract.show', $modelContract->id) }}" class="text-blue-500 px-2 py-1 bg-blue-100 rounded-md hover:text-blue-700">
                                    Voir
                                </a>
                                <a href="{{ route('modelContract.edit', $modelContract->id) }}" class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
                                    Modifier
                                </a>
                                <form action="{{ route('modelContract.destroy', $modelContract->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 px-2 py-1 bg-red-100 hover:bg-red-200 rounded-md hover:text-red-700">
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
    </div> --}}

</x-app-layout>
