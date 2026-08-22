<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('genero');
            $table->year('ano_publicacao');
            $table->integer('quantidade_estoque')->default(0);
            $table->foreignId('autor_id')->constrained('autores')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); // Soft Delete exigido no item 6 da Parte 3
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};