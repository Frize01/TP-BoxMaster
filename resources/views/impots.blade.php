<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Impôts
        </h2>
    </x-slot>

    @forelse ($billByYear as $year => $totalRevenus)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-bold pb-3 text-gray-900">
                            Calcul des impôts pour l'année {{ $year }}
                        </h3>

                        <p class="text-lg mt-4">
                            Total des revenus pour l'année {{ $year }} :
                            <span class="font-bold">{{ number_format($totalRevenus, 2) }} €</span>
                        </p>

                        @if ($totalRevenus <= 15000)
                            <div class="mt-6">
                                <h4 class="text-xl">Régime Micro-Foncier</h4>
                                <p class="mt-2">Montant total à déclarer (case 4 BE déclaration n°2042) :
                                    <span>{{ number_format($totalRevenus, 2) }} €</span>
                                </p>
                                <p class="mt-2">Montant imposable (après abattement de 30%) :
                                    <span>{{ number_format($totalRevenus * 0.7, 2) }} €</span>
                                </p>
                            </div>
                        @else
                            <div class="mt-6">
                                <h4 class="text-xl">Régime Réel</h4>
                                <p class="mt-2">Montant total à déclarer (case 4 BA déclaration n°2044) :
                                    <span>{{ number_format($totalRevenus, 2) }} €</span>
                                </p>
                                <p class="mt-2">Montant imposable (100% des revenus) :
                                    <span>{{ number_format($totalRevenus, 2) }} €</span>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="text-gray-500 text-center">Aucun revenu trouvé pour cette année</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</x-app-layout>