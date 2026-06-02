<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'aplicacao',
    ];

    public function materiais()
    {
        return $this->hasMany(Material::class, 'categoria_id');
    }
}
