<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 100);
            $table->string('area', 100);
            $table->string('estande', 20)->nullable();
            $table->longText('resumo');
            $table->longText('objetivo');
            $table->longText('metodologia');
            $table->longText('recurso');
            $table->integer('turno')->nullable();
            $table->longText('avaliacao');
            $table->integer('ano')->default(date('Y'));
            $table->enum('tipo', ['normal', 'suplente'])->default('normal');
            $table->integer('avaliadores')->default(0);
            $table->integer('notaFinal')->default(0);
            $table->integer('votacao_popular')->default(0);
            $table->string('avaliado')->default('nao');
            $table->string('escola');

            $table->unsignedInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');

            $table->unsignedInteger('escola_id')->nullable();
            $table->foreign('escola_id')->references('id')->on('escolas')->onDelete('set null');

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
        Schema::dropIfExists('projetos');
    }
}