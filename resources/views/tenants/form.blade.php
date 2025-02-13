<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $tenant->exists ? 'Modifier : ' . $tenant->name : 'Créer un nouveau locataire' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $tenant->exists ? 'Modifier un locataire' : 'Créer un locataire' }}
                        </h2>
                    </header>

                    @if($tenant->exists)
                        <form method="post" action="{{ route('tenant.update', $tenant->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                    @else
                        <form method="post" action="{{ route('tenant.store') }}" class="mt-6 space-y-6">
                            @csrf
                    @endif

                        <div>
                            <x-input-label for="name" value="Nom" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $tenant->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="tel" value="Téléphone" />
                            <x-text-input id="tel" name="tel" type="text" class="mt-1 block w-full"
                                :value="old('tel', $tenant->tel)" required maxlength="13" minlength="10" />
                            <x-input-error class="mt-2" :messages="$errors->get('tel')" />
                        </div>

                        <div>
                            <x-input-label for="mail" value="Email" />
                            <x-text-input id="mail" name="mail" type="email" class="mt-1 block w-full"
                                :value="old('mail', $tenant->mail)" required maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('mail')" />
                        </div>

                        <div>
                            <x-input-label for="address" value="Adresse" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $tenant->address)" required maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div>
                            <x-input-label for="rib" value="RIB" />
                            <x-text-input id="rib" name="rib" type="text" class="mt-1 block w-full"
                                :value="old('rib', $tenant->rib)" required maxlength="34" minlength="34" />
                            <x-input-error class="mt-2" :messages="$errors->get('rib')" />
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
