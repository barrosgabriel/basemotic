<?php

Route::group(['prefix' => 'admin/projeto', 'namespace' => 'Admin\Projeto'], function () {

    Route::get('/', ['as' => 'admin.projeto', 'uses' => 'AdminProjetoController@index']);

    Route::get('show/{id}', ['as' => 'admin.projeto.show', 'uses' => 'AdminProjetoController@show']);

    Route::get('destroy/{id}', ['as' => 'admin.projeto.destroy', 'uses' => 'AdminProjetoController@destroy']);

    Route::get('edit/{id}', ['as' => 'admin.projeto.edit', 'uses' => 'AdminProjetoController@edit']);

    Route::get('create', ['as' => 'admin.projeto.create', 'uses' => 'AdminProjetoController@create']);

    Route::get('rebaixa/{id}', ['as' => 'admin.projeto.rebaixa', 'uses' => 'AdminProjetoController@rebaixaSuplente']);

    Route::post('update/{id}', ['as' => 'admin.projeto.update', 'uses' => 'AdminProjetoController@update']);

    Route::any('filtrar', ['as' => 'admin.projeto.filtrar', 'uses' => 'AdminProjetoController@filtrar']);

    Route::post('store', ['as' => 'admin.projeto.store', 'uses' => 'AdminProjetoController@store']);

    Route::get('relatorios', ['as' => 'admin.projeto.relatorios', 'uses' => 'AdminProjetoRelatorioController@index']);

    Route::get('vincular-avaliadores/{id}', ['as' => 'admin.projeto.vincular-avaliadores', 'uses' => 'AdminProjetoController@vincularAvaliador']);

    Route::post('vincular', ['as' => 'admin.projeto.vincula', 'uses' => 'AdminProjetoController@vincula']);

    Route::post('relatorios/todos-projetos', ['as' => 'admin.projeto.relatorios.todos-projetos', 'uses' => 'AdminProjetoRelatorioController@todosProjetos']);
    //
    //
    Route::post('relatorios/informacoes', ['as' => 'admin.projeto.relatorios.informacoes', 'uses' => 'AdminProjetoRelatorioController@informacoes']);
    //
    //
    Route::post('relatorios/categoria-projetos', ['as' => 'admin.projeto.relatorios.categoria-projetos', 'uses' => 'AdminProjetoRelatorioController@categoriaProjetos']);

    Route::get('relatorios/projeto-individual/{id}', ['as' => 'admin.projeto.relatorios.projeto-individual', 'uses' => 'AdminProjetoRelatorioController@projetoIndividual']);

    Route::any('relatorios/filtro/projetos', ['as' => 'admin.projeto.relatorios.filtro-projetos', 'uses' => 'AdminProjetoRelatorioController@filtroProjetos']);

    Route::get('relatorios/estande/projetos', ['as' => 'admin.projeto.relatorios.estande-projetos', 'uses' => 'AdminProjetoRelatorioController@estandeProjetos']);

});
Route::get('/json-categorias-projeto', 'Admin\Projeto\AdminProjetoController@categorias');

Route::get('/json-alunos-lista', 'Admin\Projeto\AdminProjetoController@alunos');

Route::get('/json-professores-lista', 'Admin\Projeto\AdminProjetoController@professores');

