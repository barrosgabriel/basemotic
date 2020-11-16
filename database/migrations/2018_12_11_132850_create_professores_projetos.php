<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessoresProjetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores_projetos', function (Blueprint $table) {
            $table->integer('professor_id')->unsigned()->nullable();
            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('set null');
            $table->integer('projeto_id')->unsigned()->nullable();
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('set null');
            $table->text('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::DropIfExists ('professores_projetos');
    }
}
