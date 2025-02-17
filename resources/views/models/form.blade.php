<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $modelContract->exists ? 'Modifier : ' . $modelContract->name : 'Créer un nouveau modèle' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $modelContract->exists ? 'Modifier un modèle' : 'Créer un modèle' }}
                        </h2>
                    </header>
                    <form method="post" id="form"
                        action="{{ $modelContract->exists ? route('modelContract.update', $modelContract->id) : route('modelContract.store') }}"
                        class="mt-6 space-y-6">
                        @csrf
                        @if ($modelContract->exists)
                            @method('put')
                        @endif
                        <div>
                            <x-input-label for="name" value="Nom" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $modelContract->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="content" class="pb-1" value="Contenu du modèle" />
                            <textarea hidden name="content" id="content"></textarea>

                            <div class="mb-4">
                                <p class="text-gray-500 text-xs mb-2">Vous pouvez insérer des variables dans le texte de
                                    ce modèle en
                                    utilisant la syntaxe suivante : <code>%nomVariable%</code>. Remplacez
                                    <code>nomVariable</code> par l'une des variables suivantes pour personnaliser le
                                    contrat :
                                </p>

                                <div class="overflow-x-auto mb-4 text-sm">
                                    <table id="variables-table"
                                        class="table-auto border-collapse border rounded-md border-gray-300">
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th class="px-4 py-2 text-left">Statut</th>
                                                <th class="px-4 py-2 text-left">Variable</th>
                                                <th class="px-4 py-2 text-left">Description</th>
                                                <th class="px-4 py-2 text-left">Copier</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-b" data-variable="%date_start%">
                                                <td class="px-4 py-2 status"></td>
                                                <td class="px-4 py-2 font-medium">%date_start%</td>
                                                <td class="px-4 py-2">Date de début du contrat</td>
                                                <td class="px-4 py-2 text-center">
                                                    <button type="button"
                                                        data-clipboard-text="%date_start%">📋</button>
                                                </td>
                                            </tr>
                                            <tr class="border-b" data-variable="%date_end%">
                                                <td class="px-4 py-2 status"></td>
                                                <td class="px-4 py-2 font-medium">%date_end%</td>
                                                <td class="px-4 py-2">Date de fin du contrat</td>
                                                <td class="px-4 py-2 text-center">
                                                    <button type="button" data-clipboard-text="%date_end%">📋</button>
                                                </td>
                                            </tr>
                                            <tr class="border-b" data-variable="%monthly_price%">
                                                <td class="px-4 py-2 status"></td>
                                                <td class="px-4 py-2 font-medium">%monthly_price%</td>
                                                <td class="px-4 py-2">Montant mensuel du loyer</td>
                                                <td class="px-4 py-2 text-center">
                                                    <button type="button"
                                                        data-clipboard-text="%monthly_price%">📋</button>
                                                </td>
                                            </tr>
                                            <tr class="border-b" data-variable="%box%">
                                                <td class="px-4 py-2 status"></td>
                                                <td class="px-4 py-2 font-medium">%box%</td>
                                                <td class="px-4 py-2">Nom de la box</td>
                                                <td class="px-4 py-2 text-center">
                                                    <button type="button" data-clipboard-text="%box%">📋</button>
                                                </td>
                                            </tr>
                                            <tr class="border-b" data-variable="%tenant_id%">
                                                <td class="px-4 py-2 status"></td>
                                                <td class="px-4 py-2 font-medium">%tenant_id%</td>
                                                <td class="px-4 py-2">Identifiant du locataire</td>
                                                <td class="px-4 py-2 text-center">
                                                    <button type="button" data-clipboard-text="%tenant_id%">📋</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="editor">
                                    {!! old('content', $modelContract->content) !!}
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>Enregistrer</x-primary-button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        document.getElementById('form').addEventListener('submit', function(e) {
            const content = document.getElementById('content');
            content.value = quill.root.innerHTML;
        });

        // Fonction pour vérifier la présence des variables
        function checkVariablesInText() {
            const text = quill.root.innerHTML;
            const variables = ["%date_start%", "%date_end%", "%monthly_price%", "%box%", "%tenant_id%"];

            variables.forEach(function(variable) {
                const row = document.querySelector(`tr[data-variable="${variable}"]`);
                const statusCell = row.querySelector(".status");
                if (text.includes(variable)) {
                    statusCell.innerHTML =
                        '<span class="text-green-500 px-2 py-1 bg-green-100 rounded-md">Ajoutée</span>';
                } else {
                    statusCell.innerHTML =
                        '<span class="text-red-500 px-2 py-1 bg-red-100 rounded-md">Manquante</span>';
                }
            });
        }

        // Vérifier les variables lorsque le contenu est modifié
        quill.on('text-change', function() {
            checkVariablesInText();
        });

        // Vérifier les variables dès le chargement de la page
        document.addEventListener('DOMContentLoaded', checkVariablesInText);

        // Ajouter la fonctionnalité de copie
        document.querySelectorAll('[data-clipboard-text]').forEach(button => {
            button.addEventListener('click', () => {
                const variableText = button.getAttribute('data-clipboard-text');
                navigator.clipboard.writeText(variableText);
            });
        });
    </script>
</x-app-layout>
