<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Box - {{ $tenant->name }}
        </h2>
        <a href="{{ route('tenant.edit', $tenant->id) }}" class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
            Modifier
        </a>
    </x-slot>

    <div class="py-6 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold pb-3 text-gray-900">
                        Informations sur {{ $tenant->name }}
                    </h3>
                    <p>
                        <span class="font-bold">Numero de téléphone :</span> {{ $tenant->tel }}
                    </p>
                    <p>
                        <span class="font-bold">Mail :</span> <a href="mailto:{{ $tenant->mail }}">{{ $tenant->mail }}</a>
                    </p>
                    <p>
                        <span class="font-bold">Adresse :</span> {{ $tenant->address }}
                    </p>
                    <p>
                        <span class="font-bold">RIB :</span> {{ Str::mask($tenant->rib, '*',4) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
