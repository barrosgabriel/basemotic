@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.config.liberarCertificados')}}" class="breadcrumb">Gerenciar certificados</a>
@endsection

@section('content')

@section('titulo-header', 'Gerenciar certificados')

@section('conteudo-header', 'Aqui você pode gerenciar os certificados para os usuários.')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
            <blockquote>Atenção! Liberar ou bloquear certificados implicará apenas na visualização das ações de gerar certificados.
            </blockquote>

                <div class="row">
                    <div class="center center-align">
                        @if ($verificaCertificados['libera_certificado'] == 0)
                        <button data-target="modalLiberarCertificados" class="waves-effect waves-light btn blue darken-4 modal-trigger" href="#modalLiberarCertificados"><i
                                    class="material-icons right"  
                                     >send</i>liberar certificados
                        </button>
                        @else
                        <button data-target="modalDesativarCertificados" class="waves-effect waves-light btn blue darken-4 modal-trigger" href="#modalDesativarCertificados"><i
                            class="material-icons right"  
                             >send</i>bloquear certificados
                        </button>
                        @endif


                        <div id="modalLiberarCertificados" class="modal">
                            <div class="modal-content">
                                <h3 align="center">Tem certeza que deseja liberar os certificados?</h3>

                                <div class="row">
                                        <h5 align="center">Ao liberar, os certificados ficarão disponíveis para retirada dos usuários.
                                        </h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="waves-effect waves-light btn blue darken-4" onclick="$('#modalLiberarCertificados').modal('close');">Cancelar</a>
                                <a class="waves-effect waves-light btn blue darken-4" href="{{ route("admin.config.liberarCertificados.store") }}" >Liberar</a>
                            </div>
                    </div>

                    <div id="modalDesativarCertificados" class="modal">
                            <div class="modal-content">
                                <h3 align="center">Tem certeza que deseja bloquear os certificados?</h3>

                                <div class="row">
                                        <h5 align="center">Ao bloquear, os certificados ficarão bloqueados aos usuários.
                                        </h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="waves-effect waves-light btn blue darken-4" onclick="$('#modalDesativarCertificados').modal('close');">Cancelar</a>
                                <a class="waves-effect waves-light btn blue darken-4" href="{{ route("admin.config.desativarCertificados.store") }}" >Bloquear</a>
                            </div>
                    </div>


                </div>

        </div>
    </div>

<br><br><br>

        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
            <blockquote>Atenção! Ao zerar o número de certificados gerados, os usuários poderão gerar os certificados novamente.
            </blockquote>

                <div class="row">
                    <div class="center center-align">
                        
                        <button data-target="modalResetarNumCertificados" class="waves-effect waves-light btn blue darken-4 modal-trigger" href="#modalResetarNumCertificados"><i
                                    class="material-icons right"  
                                     >send</i>resetar número de certificados gerados
                        </button>
                       
                    </div>

    <div id="modalResetarNumCertificados" class="modal">
            <div class="modal-content">
                <h3 align="center">Tem certeza que deseja resetar o número de certificados gerados?</h3>

                <div class="row">
                        <h5 align="center">Ao zerar, os usuários poderão gerar os certificados novamente.
                        </h5>
                </div>
            </div>
            <div class="modal-footer">
                <a class="waves-effect waves-light btn blue darken-4" onclick="$('#modalResetarNumCertificados').modal('close');">Cancelar</a>
                <a class="waves-effect waves-light btn blue darken-4" href="{{ route('admin.config.resetarNumCertificados.store') }}">Resetar</a>
            </div>
    </div>

@endsection