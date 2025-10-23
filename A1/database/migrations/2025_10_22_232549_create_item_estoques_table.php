<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
   {
        Schema::create('item_estoques', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Nome do item
            $table->integer('quantidade')->default(0); // Quantidade
            $table->text('descricao')->nullable(); // Descrição opcional
            $table->unsignedBigInteger('user_id'); // Chave estrangeira para o usuário (instituição)
            $table->timestamps(); // Colunas created_at e updated_at

            // Define a chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_estoques');
    }
};
