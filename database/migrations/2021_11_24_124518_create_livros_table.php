<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('categoria');
            $table->string('codigo');
            $table->string('autor');
            $table->boolean('ebook');
            $table->float('tamanho_arquivo', 4, 2)->nullable();
            $table->float('peso', 4, 2)->nullable();
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
