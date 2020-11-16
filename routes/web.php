<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/regulamento', 'HomeController@regulamento')->name('regulamento');

Route::get('/contato', 'HomeController@contato')->name('contato');

Route::get('/sobre', 'HomeController@sobre')->name('sobre');


//cadastro avaliadores

Route::get('/cadastroAvaliadoresExterno', ['as' => 'cadastro.avaliadores.externo', 'uses' => 'HomeController@cadastroAvaliadoresExter']);
Route::post('/cadastroAvaliadoresExternoSalvar', ['as' => 'cadastro.avaliadores.externo.salvar', 'uses' => 'HomeController@storeCadastroAvaliadoresExter']);
Route::post('cadastroAvaliadoresExterno/update/{id}', ['as' => 'cadastro.avaliadores.externo.update', 'uses' => 'HomeController@updateCadastroAvaliadoresExter']);


//validaCERTIFICADOS
Route::get('/chancela', ['as' => 'certificado.chancela.view', 'uses' => 'HomeController@chancelaView']);
Route::post('chancelaValidacao', ['as' => 'certificado.chancela.validar', 'uses' => 'HomeController@procuraChancela']);
Route::get('chancelaValidacaoInterna/{chancela}', ['as' => 'certificado.chancela.validarInterno', 'uses' => 'HomeController@procuraChancelaInterno']);


//protegido por questão de login
Route::group(['middleware' => 'auth'], function () {

    Route::get('/tabelaChancelaAluno/{id?}', ['as' => 'tabela.certificado.aluno', 'uses' => 'HomeController@tabelaChancelaVisualizarAluno']);
    Route::get('/tabelaChancelaOrientador/{id?}', ['as' => 'tabela.certificado.orientador', 'uses' => 'HomeController@tabelaChancelaVisualizarOrientador']);
    Route::get('/tabelaChancelaCoorientador/{id?}', ['as' => 'tabela.certificado.coorientador', 'uses' => 'HomeController@tabelaChancelaVisualizarCoorientador']);
    Route::get('/tabelaChancelaAvaliador/{id?}', ['as' => 'tabela.certificado.avaliador', 'uses' => 'HomeController@tabelaChancelaVisualizarAvaliador']);

    Route::get('certificadoAluno/{id}', ['as' => 'certificado.aluno', 'uses' => 'HomeController@certificadoAluno']);

    Route::get('certificadoAvaliador/{id}', ['as' => 'certificado.avaliador', 'uses' => 'HomeController@certificadoAvaliador']);

    Route::get('certificadoProfessorOrientador/{id}', ['as' => 'certificado.professor.orientador', 'uses' => 'HomeController@certificadoProfessorOrientador']);

    Route::get('certificadoProfessorCoorientador/{id}', ['as' => 'certificado.professor.coorientador', 'uses' => 'HomeController@certificadoProfessorCoorientador']);

    Route::get('/votacaoPopular/cadastro', ['as' => 'votacaoPopular.cadastro', 'uses' => 'HomeController@votacaoPopularCadastroUser']);
    Route::post('/votacaoPopular/salvar', ['as' => 'votacaoPopular.cadastro.salvar', 'uses' => 'HomeController@votacaoPopularCadastroUser_salvar']);
    Route::get('/votacaoPopular/home', ['as' => 'votacaoPopular.home', 'uses' => 'HomeController@indexUserVotacaoPopular']);
    Route::post('/votacao', ['as' => 'avaliacao-popular-escolha', 'uses' => 'HomeController@avaliacaoPopular']);
});


require_once('trofeus/trofeus.php');

require_once('auth/auth.php');

require_once('admin/admin.php');

require_once('escola/escola.php');

require_once('professor/professor.php');

require_once('avaliador/avaliador.php');

require_once('admin/projetoSustentavel/projetoSustentavel.php');

Route::get('/uploadServidor', function () {
    $exitCode1 = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('view:clear');
	//comanda o comando route:clear na primeira vez, depois execulta denovo sem ele comentado
    // $exitCode3 = Artisan::call('route:clear');
    $exitCode4 = Artisan::call('clear-compiled');
    $exitCode4 = Artisan::call('config:cache');

    return 'Pronto para uso.';
});
