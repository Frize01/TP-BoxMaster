<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Box - {{ $modelContract->name }}
        </h2>
        <a href="{{ route('modelContract.edit', $modelContract->id) }}"
            class="text-blue-500 px-2 py-1 bg-blue-100 hover:bg-blue-200 rounded-md hover:text-blue-700">
            Modifier
        </a>
    </x-slot>

    <div class="py-6 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-around gap-4">
            <div id="editor" class="a4-sheet">
                {!! $modelContract->content !!}
            </div>

            <div>
                <div class="overflow-x-auto text-sm">
                    <table id="variables-table"
                        class="table-auto border-collapse border rounded-md border-gray-300 bg-white">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 text-left">Statut</th>
                                <th class="px-4 py-2 text-left">Variable</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b" data-variable="%date_start%">
                                <td class="px-4 py-2 status"></td>
                                <td class="px-4 py-2 font-medium">%date_start%</td>
                            </tr>
                            <tr class="border-b" data-variable="%date_end%">
                                <td class="px-4 py-2 status"></td>
                                <td class="px-4 py-2 font-medium">%date_end%</td>
                            </tr>
                            <tr class="border-b" data-variable="%monthly_price%">
                                <td class="px-4 py-2 status"></td>
                                <td class="px-4 py-2 font-medium">%monthly_price%</td>
                            </tr>
                            <tr class="border-b" data-variable="%box%">
                                <td class="px-4 py-2 status"></td>
                                <td class="px-4 py-2 font-medium">%box%</td>
                            </tr>
                            <tr class="border-b" data-variable="%tenant_id%">
                                <td class="px-4 py-2 status"></td>
                                <td class="px-4 py-2 font-medium">%tenant_id%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const quill = new Quill('#editor', {
            readOnly: true,
            modules: {
                toolbar: null
            },
            theme: 'snow'
        });

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


        // Vérifier les variables dès le chargement de la page
        document.addEventListener('DOMContentLoaded', checkVariablesInText);
    </script>
</x-app-layout>
