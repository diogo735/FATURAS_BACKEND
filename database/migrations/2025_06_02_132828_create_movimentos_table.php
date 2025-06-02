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
    Schema::create('movimentos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
        $table->foreignId('sub_categoria_id')->nullable()->constrained('sub_categorias')->onDelete('set null');
        $table->decimal('valor', 10, 2);
        $table->date('data_movimento');
        $table->text('nota')->nullable();
        $table->timestamps(); // inclui created_at e updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentos');
    }
};
