@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.config.desativarAvaliadores')}}" class="breadcrumb">Desativar Avaliadores</a>
@endsection

@section('content')

@section('titulo-header', 'Desativar Avaliadores')

@section('conteudo-header', 'Aqui você pode desativar os avaliadores cadastrados no sistema.')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
            <blockquote>Atenção! Ao desativar, os avaliadores já cadastrados ficarão inativos no sistema, sendo necessário ativá-los novamente na próxima edição. Essa atividade deverá ser feita após o término de cada edição, pelo administrador. Todos os logins dos avaliadores não estarão mais funcionando após este comando.
            </blockquote>

                <div class="row">
                    <div class="center center-align">
                        <button data-target="modalDesativarAvaliadores" class="waves-effect waves-light btn blue darken-4 modal-trigger" href="#modalDesativarAvaliadores"><i
                                    class="material-icons right"  
                                     >send</i>desativar avaliadores
                        </button>
                        <div id="modalDesativarAvaliadores" class="modal">
                            <div class="modal-content">
                                <h3 align="center">Tem certeza que deseja desativar os avaliadores?</h3>

                                <div class="row">
                                        <h5 align="center">Ao desativar, os avaliadores já cadastrados ficarão inativos no sistema, sendo necessário ativá-los novamente na próxima edição. Essa atividade deverá ser feita após o término de cada edição, pelo administrador. Todos os logins dos avaliadores não estarão mais funcionando após este comando.
                                        </h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="waves-effect waves-light btn blue darken-4" onclick="$('#modalDesativarAvaliadores').modal('close');">Cancelar</a>
                                <a class="waves-effect waves-light btn blue darken-4" href="{{ route("admin.config.desativarAvaliadores.store") }}" >Desativar</a>
                            </div>
                    </div>
                </div>

        </div>
    </div>
</div>

@endsection