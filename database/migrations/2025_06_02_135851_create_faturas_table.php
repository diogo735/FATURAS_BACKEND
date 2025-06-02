<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('faturas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('movimento_id')->constrained('movimentos')->onDelete('cascade');
        $table->string('tipo_documento');
        $table->string('numero_fatura');
        $table->date('data_fatura');
        $table->string('nif_emitente');
        $table->string('codigo_ATCUD');
        $table->string('nome_empresa')->nullable();
        $table->string('nif_cliente')->nullable();
        $table->text('descricao')->nullable();
        $table->decimal('total_iva', 10, 2);
        $table->decimal('total_final', 10, 2);
        $table->text('imagem_fatura')->nullable(); // Pode ser URL ou base64
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faturas');
    }
};
