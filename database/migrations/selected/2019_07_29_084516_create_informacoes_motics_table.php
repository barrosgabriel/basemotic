<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacoesMoticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacoes_motics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('edicao');
            $table->string('data_inicio');
            $table->string('data_fim');
            $table->string('secretario');
            $table->string('assinatura_secretario');
            $table->string('prefeito');
            $table->string('assinatura_prefeito');
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
        Schema::dropIfExists('informacoes_motics');
    }
}
