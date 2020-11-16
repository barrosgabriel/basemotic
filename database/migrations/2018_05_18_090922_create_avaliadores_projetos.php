<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliadoresProjetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliadores_projetos', function (Blueprint $table) {
            $table->integer('avaliador_id')->unsigned()->nullable();
            $table->foreign('avaliador_id')->references('id')->on('avaliadores')->onDelete('set null');

            $table->integer('projeto_id')->unsigned()->nullable();
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliadores_projetos');
    }
}