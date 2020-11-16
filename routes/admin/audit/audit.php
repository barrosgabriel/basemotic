<?php

Route::group(['prefix' => 'admin/auditoria', 'namespace' => 'Audit'], function () {

    Route::get('/', ['as' => 'admin.auditoria', 'uses' => 'AuditController@index']);

    Route::get('/usuarios', ['as' => 'admin.auditoria.usuarios', 'uses' => 'AuditController@usuarios']);

    Route::get('/usuarios-nao-logados', ['as' => 'admin.auditoria.usuarios-nao-logados', 'uses' => 'AuditController@usuariosNaoLogados']);

    Route::any('/usuarios/filtrar', ['as' => 'admin.auditoria.usuarios.filtrar', 'uses' => 'AuditController@usuariosFiltrar']);

    Route::any('filtrar', ['as' => 'admin.auditoria.filtrar', 'uses' => 'AuditController@filtrar']);

    Route::get('/relatorios/registros', ['as' => 'admin.auditoria.registros', 'uses' => 'AuditController@export']);

    Route::get('relatorios', ['as' => 'admin.auditoria.relatorios', 'uses' => 'AuditController@relatorios']);

    Route::post('filtrar/relatorios/usuarios', ['as' => 'admin.auditoria.relatorios.user.filtrar', 'uses' => 'AuditController@filtrarUsuarios']);

    Route::get('relatorios/registro-individual/{id}', ['as' => 'admin.auditoria.relatorios.registro.individual', 'uses' => 'AuditController@exportByUser']);

});