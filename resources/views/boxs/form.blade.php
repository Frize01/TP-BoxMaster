<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Affiche le nom de la box si elle existe, sinon un titre pour la création --}}
            {{ $box->exists ? 'Modifier : ' . $box->name : 'Créer une nouvelle box' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $box->exists ? 'Modifier une box' : 'Créer une box' }}
                        </h2>
                    </header>

                    {{-- Choix du formulaire en fonction de l'existence de la box --}}
                    @if($box->exists)
                        <form method="post" action="{{ route('box.update', $box->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                    @else
                        <form method="post" action="{{ route('box.store') }}" class="mt-6 space-y-6">
                            @csrf
                    @endif

                        <div>
                            <x-input-label for="name" value="Nom" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $box->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="address" value="Adresse" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $box->address)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div>
                            <x-input-label for="default_price" value="Prix par defaut" />
                            <x-text-input id="default_price" name="default_price" type="number" class="mt-1 block w-full"
                                :value="old('default_price', $box->default_price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('default_price')" />
                        </div>

                        <div>
                            <x-input-label for="surface" value="Surface" />
                            <x-text-input id="surface" name="surface" type="number" class="mt-1 block w-full"
                                :value="old('surface', $box->surface)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('surface')" />
                        </div>

                        <div>
                            <x-input-label for="volume" value="Volume" />
                            <x-text-input id="volume" name="volume" type="number" class="mt-1 block w-full"
                                :value="old('volume', $box->volume)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('volume')" />
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
