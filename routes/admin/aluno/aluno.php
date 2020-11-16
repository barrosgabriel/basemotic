<?php

Route::group(['prefix' => 'admin/aluno', 'namespace' => 'Admin\Aluno'], function () {

    Route::get('tabela-certificados', ['as' => 'admin.aluno.tabelaCertificado', 'uses' => 'AdminAlunoController@indexCertificados']);

    Route::get('/', ['as' => 'admin.aluno', 'uses' => 'AdminAlunoController@index']);

    Route::get('show/{id}', ['as' => 'admin.aluno.show', 'uses' => 'AdminAlunoController@show']);

    Route::get('destroy/{id}', ['as' => 'admin.aluno.destroy', 'uses' => 'AdminAlunoController@destroy']);

    Route::get('edit/{id}', ['as' => 'admin.aluno.edit', 'uses' => 'AdminAlunoController@edit']);

    Route::get('create', ['as' => 'admin.aluno.create', 'uses' => 'AdminAlunoController@create']);

    Route::post('update/{id}', ['as' => 'admin.aluno.update', 'uses' => 'AdminAlunoController@update']);

    Route::any('filtrar', ['as' => 'admin.aluno.filtrar', 'uses' => 'AdminAlunoController@filtrar']);

    Route::post('relatorio-filtrar', ['as' => 'admin.aluno.relatorios.filtrar', 'uses' => 'AdminAlunoRelatorioController@filtrar']);

    Route::post('store', ['as' => 'admin.aluno.store', 'uses' => 'AdminAlunoController@store']);

    Route::get('relatorios', ['as' => 'admin.aluno.relatorios', 'uses' => 'AdminAlunoRelatorioController@index']);
    //lucas
    Route::get('certificado/{id}', ['as' => 'admin.aluno.certificado', 'uses' => 'AdminAlunoRelatorioController@alunoCertificado']);
    //lucas
    Route::get('/todos-alunos-resumo', ['as' => 'admin.aluno.relatorios.todos.alunos', 'uses' => 'AdminAlunoRelatorioController@todosAlunos']);

    Route::get('/alunos-por-escola', ['as' => 'admin.aluno.relatorios.alunos.por.escola', 'uses' => 'AdminAlunoRelatorioController@alunosPorEscola']);

    Route::get('/relatorio-aluno/{id}', ['as' => 'admin.aluno.relatorios.aluno-individual', 'uses' => 'AdminAlunoRelatorioController@alunoIndividual']);

    Route::get('relatorios/alunos-ativos', ['as' => 'admin.aluno.relatorios.alunos-ativos', 'uses' => 'AdminAlunoRelatorioController@alunosAtivos']);

});



Route::get('/json-ano', 'Admin\Aluno\AdminAlunoController@escolaCategoria');



