<x-app-layout>
    <!-- EditorJS Core -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <!-- Plugin Header -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <!-- Plugin Table -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>

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

                        <div id="editorjs"></div>

                        <textarea id="editorData" name="content" hidden></textarea>

                        <div class="flex items-center gap-4">
                            <x-primary-button id="saveButton">Enregistrer</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialisation de l'éditeur
        const editor = new EditorJS({
            holder: 'editorjs',
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: ['link'],
                    config: {
                        placeholder: 'Entrez un titre',
                        levels: [1, 2, 3, 4],
                        defaultLevel: 2
                    }
                },
                table: {
                    class: Table,
                    inlineToolbar: true,
                    config: {
                        rows: 2,
                        cols: 3
                    }
                }
            },
            // Exemple de données initiales
            data: {
                blocks: {!! $modelContract->content ?? '[]' !!}
            }
        });

        // Sauvegarde des données de l'éditeur dans le textarea caché
        document.getElementById('saveButton').addEventListener('click', async () => {
            try {
                const outputData = await editor.save();
                document.getElementById('editorData').value = JSON.stringify(outputData.blocks);
            } catch (error) {
                console.error('Erreur lors de la sauvegarde : ', error);
            }
        });
    </script>
</x-app-layout>
