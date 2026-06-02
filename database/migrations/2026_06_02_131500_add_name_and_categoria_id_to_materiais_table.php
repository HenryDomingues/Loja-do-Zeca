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
            if (!Schema::hasColumn('materiais', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('materiais', 'categoria_id')) {
                $table->foreignId('categoria_id')->nullable()->after('name')->constrained('categorias')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materiais', function (Blueprint $table) {
            if (Schema::hasColumn('materiais', 'categoria_id')) {
                $table->dropConstrainedForeignId('categoria_id');
            }
            if (Schema::hasColumn('materiais', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
