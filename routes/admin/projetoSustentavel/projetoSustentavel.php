<?php

Route::group(['prefix' => 'projetoSustentavel','middleware' => 'auth'], function () {

    //rotas projeto sustentável
    Route::get('/home', ['as' => 'projetoSustentavel.home', 'uses' => 'HomeController@projetoSustentavel']);
    Route::get('/cadastroUsuario', ['as' => 'projetoSustentavel.cadastroUsuario', 'uses' => 'HomeController@projetoSustentavelCadastroUsuario']);
    Route::post('/salvarUsuario', ['as' => 'projetoSustentavel.cadastro.salvarUsuario', 'uses' => 'HomeController@projetoSustentavelCadastroUsuarioSalvar']);
    Route::post('/projetoSustentavel', ['as' => 'projetoSustentavel.escolha', 'uses' => 'HomeController@projetoSustentavelEscolha']);
    Route::get('/classificacao', ['as' => 'admin.projetoSustentavel.classificacao', 'uses' => 'HomeController@projetoSustentavelExibe']);
    Route::post('/classificacao-ano', ['as' => 'admin.projetoSustentavel.classificacao-ano', 'uses' => 'HomeController@projetoSustentavelExibeAno']);

});
