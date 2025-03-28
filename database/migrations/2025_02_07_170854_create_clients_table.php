<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Chave primária (id)
            $table->string('nome'); // Nome do cliente
            $table->string('email')->nullable(); // Email (opcional)
            $table->string('telefone'); // Telefone
            $table->text('comentarios')->nullable(); // Comentários (opcional)
            $table->timestamps(); // Cria os campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients'); // Remove a tabela clients
    }
}
