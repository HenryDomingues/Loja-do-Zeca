<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Material;
use App\Models\Categoria;

class MateriaisController extends Controller
{
    public function index()
    {
        $materiais = Material::with('categoria')->get();
        return view('materiais.index', compact('materiais'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('materiais.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'nullable|exists:categorias,id',
            'fabricante' => 'nullable|string|max:255',
            'unidade_medida' => 'nullable|string|max:50',
            'cor' => 'nullable|string|max:100',
            'textura' => 'nullable|string|max:100',
            'material_fabricacao' => 'nullable|string|max:255',
            'peso' => 'nullable|numeric',
            'data_validade' => 'nullable|date',
            'quantidade_estoque' => 'nullable|integer|min:0',
            'estoque_minimo' => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'name', 'categoria_id', 'fabricante', 'unidade_medida', 'cor', 'textura', 'material_fabricacao', 'peso', 'data_validade', 'quantidade_estoque', 'estoque_minimo'
        ]);

        // Create the material first (we won't store image path in DB)
        $material = Material::create($data);

        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $ext = $file->extension();
            $filename = $material->id . '.' . $ext;
            \Illuminate\Support\Facades\Storage::disk('public')->putFileAs('materiais', $file, $filename);
            // Do not save image path in DB per request
        }

        // Alertar se estoque estiver abaixo do mínimo
        if (($material->estoque_minimo ?? 0) > 0 && (($material->quantidade_estoque ?? 0) < ($material->estoque_minimo ?? 0))) {
            session()->flash('low_stock_message', "Estoque baixo para {$material->name}: {$material->quantidade_estoque} / {$material->estoque_minimo}");
        }

        return redirect()->route('materiais.index');
    }

    public function edit(Material $material)
    {
        $categorias = Categoria::all();
        return view('materiais.edit', compact('material', 'categorias'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'nullable|exists:categorias,id',
            'fabricante' => 'nullable|string|max:255',
            'unidade_medida' => 'nullable|string|max:50',
            'cor' => 'nullable|string|max:100',
            'textura' => 'nullable|string|max:100',
            'material_fabricacao' => 'nullable|string|max:255',
            'peso' => 'nullable|numeric',
            'data_validade' => 'nullable|date',
            'quantidade_estoque' => 'nullable|integer|min:0',
            'estoque_minimo' => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'name', 'categoria_id', 'fabricante', 'unidade_medida', 'cor', 'textura', 'material_fabricacao', 'peso', 'data_validade', 'quantidade_estoque', 'estoque_minimo'
        ]);

        if ($request->hasFile('imagem')) {
            // delete any existing files that start with the material id
            $files = \Illuminate\Support\Facades\Storage::disk('public')->files('materiais');
            foreach ($files as $f) {
                if (strpos(basename($f), $material->id . '.') === 0) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($f);
                }
            }

            $file = $request->file('imagem');
            $ext = $file->extension();
            $filename = $material->id . '.' . $ext;
            \Illuminate\Support\Facades\Storage::disk('public')->putFileAs('materiais', $file, $filename);
            // Do not set $data['imagem'] to avoid saving image info in DB
        }

        // Remover imagem atual se o usuário solicitar sem enviar nova
        if ($request->has('remover_imagem') && $request->input('remover_imagem')) {
            $files = \Illuminate\Support\Facades\Storage::disk('public')->files('materiais');
            foreach ($files as $f) {
                if (strpos(basename($f), $material->id . '.') === 0) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($f);
                }
            }
            $data['imagem'] = null;
        }

        $material->update($data);
        $material->refresh();

        // Alertar se estoque estiver abaixo do mínimo após atualização
        if (($material->estoque_minimo ?? 0) > 0 && (($material->quantidade_estoque ?? 0) < ($material->estoque_minimo ?? 0))) {
            session()->flash('low_stock_message', "Estoque baixo para {$material->name}: {$material->quantidade_estoque} / {$material->estoque_minimo}");
        }

        return redirect()->route('materiais.index');
    }

    public function destroy(Material $material)
    {
        // Deletar arquivos de imagem associados por id
        $files = \Illuminate\Support\Facades\Storage::disk('public')->files('materiais');
        foreach ($files as $f) {
            if (strpos(basename($f), $material->id . '.') === 0) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($f);
            }
        }

        $material->delete();
        return redirect()->route('materiais.index');
    }
}