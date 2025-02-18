<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $contract->exists ? 'Modifier : ' . $contract->name : 'Créer un nouveau Contrat' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $contract->exists ? 'Modifier un Contrat' : 'Créer un Contrat' }}
                        </h2>
                    </header>

                    @if ($contract->exists)
                        <form method="post" action="{{ route('contract.update', $contract->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                        @else
                            <form method="post" action="{{ route('contract.store') }}" class="mt-6 space-y-6">
                                @csrf
                    @endif

                        <div>
                            <x-input-label for="tenant_id" value="Locataire" />
                            <select id="tenant_id" name="tenant_id"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                required>
                                <option value="">Choisir un locataire</option>
                                @foreach ($tenants as $tenant)
                                    <option value="{{ $tenant->id }}"
                                        {{ old('tenant_id', $contract->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                        {{ $tenant->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('tenant_id')" />
                        </div>

                        <div>
                            <x-input-label for="box_id" value="Box" />
                            <select id="box_id" name="box_id"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                required>
                                <option value="">Choisir une box</option>
                                @foreach ($boxes as $box)
                                    <option value="{{ $box->id }}"
                                        {{ old('box_id', $contract->box_id) == $box->id ? 'selected' : '' }}>
                                        {{ $box->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('box_id')" />
                        </div>

                        <div>
                            <x-input-label for="model_contract_id" value="Model de Contrat" />
                            <select id="model_contract_id" name="model_contract_id"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                required>
                                <option value="">Choisir un model</option>
                                @foreach ($modelContracts as $model)
                                    <option value="{{ $model->id }}"
                                        {{ old('model_contract_id', $contract->model_contract_id) == $model->id ? 'selected' : '' }}>
                                        {{ $model->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('model_contract_id')" />
                        </div>

                        <div>
                            <x-input-label for="price" value="Prix (seras afficher en € sur le contract)" />
                            <x-text-input id="price" name="price" type="number" step="0.01"
                                class="mt-1 block w-full" :value="old('price', $contract->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div>
                            <x-input-label for="date_start" value="Date de début" />
                            <x-text-input id="date_start" name="date_start" type="date" class="mt-1 block w-full"
                                :value="old('date_start', $contract->date_start ? $contract->date_start->format('Y-m-d') : '')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('date_start')" />
                        </div>
                        
                        <div>
                            <x-input-label for="date_end" value="Date de fin" />
                            <x-text-input id="date_end" name="date_end" type="date" class="mt-1 block w-full"
                                :value="old('date_end', $contract->date_end ? $contract->date_end->format('Y-m-d') : '')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('date_end')" />
                        </div>

                        <div>
                            <x-input-label for="resiliation_delay" value="Délai de résiliation" />
                            <x-text-input id="resiliation_delay" name="resiliation_delay" type="text"
                                class="mt-1 block w-full" :value="old('resiliation_delay', $contract->resiliation_delay)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('resiliation_delay')" />
                        </div>

                        <div>
                            <x-input-label for="localisation" value="Localisation" />
                            <x-text-input id="localisation" name="localisation" type="text" class="mt-1 block w-full"
                                :value="old('localisation', $contract->localisation)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('localisation')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>Enregistrer</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
