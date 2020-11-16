<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nascimento')->nullable();
            $table->enum('sexo',['masculino','feminino', "nao especificado"])->default('nao especificado');
            $table->string('telefone')->nullable();
            $table->string('grauDeInstrucao')->nullable();
            $table->string('cpf')->nullable();
            $table->string('instituicao')->nullable();
            $table->integer('projetos')->default(0);

            $table->unsignedInteger('user_id')->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('avaliadores');
    }
}