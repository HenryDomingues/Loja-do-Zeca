<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('categorias.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Criar Categoria</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-6 py-3 text-left font-semibold">ID</th>
                                <th class="border border-gray-300 px-6 py-3 text-left font-semibold">Nome</th>
                                <th class="border border-gray-300 px-6 py-3 text-left font-semibold">Aplicação</th>
                                <th class="border border-gray-300 px-6 py-3 text-left font-semibold">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-6 py-3">{{ $categoria->id }}</td>
                                    <td class="border border-gray-300 px-6 py-3">{{ $categoria->nome }}</td>
                                    <td class="border border-gray-300 px-6 py-3">{{ $categoria->aplicacao ?? '-' }}</td>
                                    <td class="border border-gray-300 px-6 py-3">
                                        <div class="flex flex-wrap gap-2 items-center whitespace-nowrap">
                                            <a href="{{ route('categorias.edit', $categoria) }}" class="inline-flex items-center px-3 py-1 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 min-w-[70px] justify-center">Editar</a>
                                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('Confirma exclusão desta categoria?');" class="inline-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 shadow-sm min-w-[80px] justify-center">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
