<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->text('img_cat')->nullable();
            $table->string('cor_cat')->nullable();
            $table->string('nome_cat');
            $table->unsignedBigInteger('tipo_movimento_id');
            $table->foreign('tipo_movimento_id')->references('id')->on('tipo_movimento')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
