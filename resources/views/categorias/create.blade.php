<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">Ocorreu um erro ao enviar o formulário.</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('categorias.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome da categoria:</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="aplicacao" class="block text-gray-700 text-sm font-bold mb-2">Aplicação da categoria:</label>
                            <select name="aplicacao" id="aplicacao" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full px-3 py-2">
                                <option value="">-- Selecione --</option>
                                <option value="Fundação" {{ old('aplicacao') == 'Fundação' ? 'selected' : '' }}>Fundação</option>
                                <option value="Acabamento" {{ old('aplicacao') == 'Acabamento' ? 'selected' : '' }}>Acabamento</option>
                                <option value="Estrutura" {{ old('aplicacao') == 'Estrutura' ? 'selected' : '' }}>Estrutura</option>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Criar</button>
                            <a href="{{ route('categorias.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
