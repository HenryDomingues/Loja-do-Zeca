<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Material') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('materiais.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6 rounded-lg border border-gray-200 bg-gray-50 p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Imagem do material</h3>
                            <p class="text-sm text-gray-600 mb-3">Faça upload de uma imagem para este material. Esta opção fica fora dos campos de tabela.</p>
                            <input type="file" name="imagem" id="imagem" accept="image/*" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            <div id="imagem-warning" class="mt-2 text-sm text-yellow-700 hidden"></div>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="categoria_id" class="block text-gray-700 text-sm font-bold mb-2">Categoria:</label>
                            <select name="categoria_id" id="categoria_id" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                                <option value="">-- Nenhuma --</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="fabricante" class="block text-gray-700 text-sm font-bold mb-2">Fabricante:</label>
                                <input type="text" name="fabricante" id="fabricante" value="{{ old('fabricante') }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="unidade_medida" class="block text-gray-700 text-sm font-bold mb-2">Unidade de Medida:</label>
                                <input type="text" name="unidade_medida" id="unidade_medida" value="{{ old('unidade_medida') }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="cor" class="block text-gray-700 text-sm font-bold mb-2">Cor:</label>
                                <input type="text" name="cor" id="cor" value="{{ old('cor') }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="textura" class="block text-gray-700 text-sm font-bold mb-2">Textura:</label>
                                <input type="text" name="textura" id="textura" value="{{ old('textura') }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="material_fabricacao" class="block text-gray-700 text-sm font-bold mb-2">Material de Fabricação:</label>
                                <input type="text" name="material_fabricacao" id="material_fabricacao" value="{{ old('material_fabricacao') }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="peso" class="block text-gray-700 text-sm font-bold mb-2">Peso (kg):</label>
                                <input type="number" step="0.01" name="peso" id="peso" value="{{ old('peso') }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="data_validade" class="block text-gray-700 text-sm font-bold mb-2">Data de Validade:</label>
                                <input type="date" name="data_validade" id="data_validade" value="{{ old('data_validade') }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="quantidade_estoque" class="block text-gray-700 text-sm font-bold mb-2">Quantidade em Estoque:</label>
                                <input type="number" name="quantidade_estoque" id="quantidade_estoque" value="{{ old('quantidade_estoque', 0) }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                            <div>
                                <label for="estoque_minimo" class="block text-gray-700 text-sm font-bold mb-2">Estoque Mínimo:</label>
                                <input type="number" name="estoque_minimo" id="estoque_minimo" value="{{ old('estoque_minimo', 0) }}" class="border-gray-300 rounded-md shadow-sm w-full px-3 py-2">
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Criar</button>
                            <a href="{{ route('materiais.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">Cancelar</a>
                        </div>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function(){
                            const input = document.getElementById('imagem');
                            const warn = document.getElementById('imagem-warning');
                            const MAX_SIZE_BYTES = 2 * 1024 * 1024; // 2MB
                            const MAX_DIM = 2000; // px

                            function showWarning(msg){
                                warn.textContent = msg;
                                warn.classList.remove('hidden');
                            }
                            function clearWarning(){
                                warn.textContent = '';
                                warn.classList.add('hidden');
                            }

                            input && input.addEventListener('change', function(e){
                                clearWarning();
                                const file = this.files && this.files[0];
                                if (!file) return;
                                if (file.size > MAX_SIZE_BYTES){
                                    showWarning('Arquivo muito grande (>' + (MAX_SIZE_BYTES/1024/1024) + 'MB). Otimize antes de enviar.');
                                }
                                const url = URL.createObjectURL(file);
                                const img = new Image();
                                img.onload = function(){
                                    if (img.naturalWidth > MAX_DIM || img.naturalHeight > MAX_DIM){
                                        showWarning('A imagem tem dimensão grande ('+img.naturalWidth+'x'+img.naturalHeight+'). Considere redimensionar para melhor desempenho.');
                                    }
                                    URL.revokeObjectURL(url);
                                };
                                img.onerror = function(){
                                    showWarning('Não foi possível ler a imagem selecionada.');
                                    URL.revokeObjectURL(url);
                                };
                                img.src = url;
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
