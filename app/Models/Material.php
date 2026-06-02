<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Material extends Model
{
    protected $table = 'materiais';

    protected $fillable = [
        'name',
        'imagem',
        'categoria_id',
        'fabricante',
        'unidade_medida',
        'cor',
        'textura',
        'material_fabricacao',
        'peso',
        'data_validade',
        'quantidade_estoque',
        'estoque_minimo',
    ];

    // Retorna o nome do arquivo de imagem baseado no id do material, se existir
    public function getImagemFileAttribute()
    {
        $files = \Illuminate\Support\Facades\Storage::disk('public')->files('materiais');
        foreach ($files as $file) {
            if (strpos(basename($file), $this->id . '.') === 0) {
                return basename($file);
            }
        }
        return null;
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    protected $casts = [
        'data_validade' => 'date',
        'peso' => 'decimal:2',
        'quantidade_estoque' => 'integer',
        'estoque_minimo' => 'integer',
    ];
}
