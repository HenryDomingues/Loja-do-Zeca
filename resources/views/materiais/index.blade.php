<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materiais') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('materiais.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Criar Material</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('low_stock_message'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function(){
                                alert(@json(session('low_stock_message')));
                            });
                        </script>
                    @endif
                    <div class="grid gap-6">
                        @foreach($materiais as $material)
                            <article class="grid gap-6 rounded-3xl border border-gray-200 bg-white p-5 shadow-sm lg:grid-cols-[280px_minmax(0,1fr)]">
                                <div class="w-full lg:w-auto h-48 bg-gray-100 rounded-3xl overflow-hidden flex items-center justify-center">
                                    @if($material->imagem_file && \Illuminate\Support\Facades\Storage::disk('public')->exists('materiais/' . $material->imagem_file))
                                        <img src="{{ asset('storage/materiais/' . $material->imagem_file) }}" alt="{{ $material->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="text-center px-4">
                                            <div class="text-sm font-semibold text-gray-500">Sem imagem</div>
                                            <div class="text-xs text-gray-400">Adicione ao editar</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col justify-between">
                                    <div>
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                            <div>
                                                <div class="text-xs uppercase tracking-[0.2em] text-blue-600 font-semibold">Material de Construção</div>
                                                <h2 class="mt-2 text-2xl font-semibold text-gray-900">#{{ $material->id }} - {{ $material->name }}</h2>
                                                <p class="mt-2 text-sm text-gray-500">Categoria: {{ $material->categoria->nome ?? 'Sem categoria' }}</p>
                                                <p class="mt-1 text-sm text-gray-500">Aplicação: {{ $material->categoria->aplicacao ?? 'Sem aplicação' }}</p>
                                                @if( ($material->estoque_minimo ?? 0) > 0 && ($material->quantidade_estoque ?? 0) < ($material->estoque_minimo ?? 0) )
                                                    <div class="mt-2 flex items-center gap-3" role="status" aria-live="polite">
                                                        <span class="relative inline-flex h-3 w-3">
                                                            <span class="absolute inline-flex h-3 w-3 rounded-full bg-red-400 opacity-75 animate-ping"></span>
                                                            <span class="relative inline-flex h-3 w-3 rounded-full bg-red-600"></span>
                                                        </span>
                                                        <span class="text-sm font-semibold text-red-600">Estoque baixo: {{ $material->quantidade_estoque ?? 0 }} / {{ $material->estoque_minimo ?? 0 }}</span>
                                                    </div>
                                                @elseif( ($material->estoque_minimo ?? 0) > 0 && ($material->quantidade_estoque ?? 0) == ($material->estoque_minimo ?? 0) )
                                                    <div class="mt-2 flex items-center gap-3" role="status" aria-live="polite">
                                                        <span class="relative inline-flex h-3 w-3">
                                                            <span class="absolute inline-flex h-3 w-3 rounded-full bg-yellow-300 opacity-75 animate-ping"></span>
                                                            <span class="relative inline-flex h-3 w-3 rounded-full bg-yellow-500"></span>
                                                        </span>
                                                        <span class="text-sm font-semibold text-yellow-700">Estoque no mínimo: {{ $material->quantidade_estoque ?? 0 }} / {{ $material->estoque_minimo ?? 0 }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex gap-2">
                                                <a href="{{ route('materiais.edit', $material) }}" class="inline-flex items-center px-4 py-2 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-700">Editar</a>
                                                <form action="{{ route('materiais.destroy', $material) }}" method="POST" onsubmit="return confirm('Confirma exclusão deste material?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full bg-red-600 text-white font-semibold hover:bg-red-700">Excluir</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                                            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Fabricante</div>
                                                <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->fabricante ?? '-' }}</div>
                                            </div>
                                            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Unidade</div>
                                                <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->unidade_medida ?? '-' }}</div>
                                            </div>
                                            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Cor</div>
                                                <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->cor ?? '-' }}</div>
                                            </div>
                                            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Textura</div>
                                                <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->textura ?? '-' }}</div>
                                            </div>
                                            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Material</div>
                                                <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->material_fabricacao ?? '-' }}</div>
                                            </div>
                                            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Peso</div>
                                                <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->peso ? number_format($material->peso, 2, ',', '.') . ' kg' : '-' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                                        <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                            <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Validade</div>
                                            <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->data_validade ? $material->data_validade->format('Y-m-d') : 'Não se aplica' }}</div>
                                        </div>
                                        <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                            <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Quantidade</div>
                                            <div class="mt-2 text-sm font-medium text-gray-900">{{ $material->quantidade_estoque ?? 0 }}</div>
                                        </div>
                                        @php
                                            $q = $material->quantidade_estoque ?? 0;
                                            $min = $material->estoque_minimo ?? 0;
                                        @endphp
                                        @if($min > 0 && $q < $min)
                                            <div class="rounded-3xl border border-red-200 bg-red-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-red-600">Estoque mínimo</div>
                                                <div class="mt-2 text-sm font-medium text-red-700">{{ $min }}</div>
                                            </div>
                                        @elseif($min > 0 && $q == $min)
                                            <div class="rounded-3xl border border-yellow-200 bg-yellow-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-yellow-700">Estoque mínimo</div>
                                                <div class="mt-2 text-sm font-medium text-yellow-800">{{ $min }}</div>
                                            </div>
                                        @else
                                            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Estoque mínimo</div>
                                                <div class="mt-2 text-sm font-medium text-gray-900">{{ $min }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
