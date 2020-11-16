<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nascimento');
            $table->enum('sexo',['masculino','feminino', "nao especificado"])->default('nao especificado');
            $table->string('telefone')->nullable();
            $table->string('grauDeInstrucao')->nullable();
            $table->string('cpf')->nullable();
            $table->integer('matricula')->nullable();
            $table->enum('camisa',['PP','P','M','G','GG'])->default('M');
            $table->integer('manha')->default('0')->nullable();
            $table->integer('tarde')->default('0')->nullable();
            $table->integer('noite')->default('0')->nullable();
            $table->unsignedInteger('user_id')->nullable()->unique();
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
        Schema::dropIfExists('professores');
    }
}