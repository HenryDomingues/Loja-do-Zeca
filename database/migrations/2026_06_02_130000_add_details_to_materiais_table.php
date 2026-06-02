<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('materiais', function (Blueprint $table) {
            $table->string('fabricante')->nullable();
            $table->string('unidade_medida')->nullable();
            $table->string('cor')->nullable();
            $table->string('textura')->nullable();
            $table->string('material_fabricacao')->nullable();
            $table->decimal('peso', 10, 2)->nullable();
            $table->date('data_validade')->nullable();
            $table->integer('quantidade_estoque')->default(0);
            $table->integer('estoque_minimo')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materiais', function (Blueprint $table) {
            $table->dropColumn([
                'fabricante',
                'unidade_medida',
                'cor',
                'textura',
                'material_fabricacao',
                'peso',
                'data_validade',
                'quantidade_estoque',
                'estoque_minimo',
            ]);
        });
    }
};
