<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des modèles
        </h2>
        <a href="{{ route('modelContract.create') }}" class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
            Ajouter un modèle
        </a>
    </x-slot>

    <div class="py-12">
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
    </div>
</x-app-layout>
