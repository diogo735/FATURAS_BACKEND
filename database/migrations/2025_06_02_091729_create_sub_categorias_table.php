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
        Schema::create('sub_categorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK para users
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade'); // FK para categorias
            $table->string('nome_subcat');
            $table->string('icone_nome');
            $table->string('cor_subcat');
            $table->timestamps(); // cria created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categorias');
    }
};
