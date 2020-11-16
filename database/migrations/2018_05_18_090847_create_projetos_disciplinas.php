<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetosDisciplinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos_disciplinas', function (Blueprint $table) {
            $table->integer('projeto_id')->unsigned()->nullable();
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('set null');

            $table->integer('disciplina_id')->unsigned()->nullable();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::DropIfExists ('projetos_disciplinas');

    }
}
