<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosProjetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_projetos', function (Blueprint $table) {
            $table->integer('aluno_id')->unsigned()->nullable();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('set null');

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
        Schema::DropIfExists ('alunos_projetos');
    }
}
