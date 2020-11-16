<?php

Route::group(['prefix' => 'admin/avaliacao', 'namespace' => 'Admin\Avaliacao'], function () {

    Route::get('classificacao', ['as' => 'admin.avaliacao.classificacao', 'uses' => 'AdminAvaliacaoController@classificacao']);

    Route::get('classificacao-popular', ['as' => 'admin.avaliacao.classificacao-popular', 'uses' => 'AdminAvaliacaoController@classificacaoPopular']);

    Route::post('classificacao-popular-ano', ['as' => 'admin.avaliacao.classificacao-popular-ano', 'uses' => 'AdminAvaliacaoController@classificacaoPopularExibe']);

    Route::get('calcular-notas', ['as' => 'admin.avaliacao.calcular-notas', 'uses' => 'AdminAvaliacaoController@calcularNotas']);

    Route::get('projetos-avaliados', ['as' => 'admin.avaliacao.projetos-avaliados', 'uses' => 'AdminAvaliacaoController@projetosAvaliados']);

    Route::get('projetos-nao-avaliados', ['as' => 'admin.avaliacao.projetos-nao-avaliados', 'uses' => 'AdminAvaliacaoController@projetosNaoAvaliados']);

    Route::post('retorna-classificacao', ['as' => 'admin.avaliacao.retorna-classificacao', 'uses' => 'AdminAvaliacaoController@retornaClassificacao']);

    Route::any('filtro', ['as' => 'admin.avaliacao.filtro', 'uses' => 'AdminAvaliacaoController@filtro']);

    //lucas
    Route::get('prioridadeEmpate/{id}/{ano}', ['as' => 'admin.avaliacao.prioridade', 'uses' => 'AdminAvaliacaoController@classificacaoPrioridade']);
    //lucas
});