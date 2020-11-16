@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.avaliador.tabelaCertificado')}}" class="breadcrumb">Certificados Avaliadores</a>
@endsection

@section('content')

@section('titulo-header', 'Gerar certificados para avaliadores')

@section('conteudo-header', 'Esses são os avaliadores cadastrados na MOTIC ' . date('Y') . '!')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{ route("admin.avaliador.filtrar") }}">
                @includeIf('_layouts._avaliador._filtro-avaliador')
            </form>
        </div>
        <div class="center-align">
            <div class="chip">
                Existem {{$quantidade}} avaliadores liberado no sistema.
                <i class="close material-icons">close</i>
            </div>
        </div>
        <div class="row">
            @includeIf('_layouts._avaliador._tabela-avaliador-certificados')
        </div>


    </div>
</div>

@section('conteudo-deletar', "Você tem certeza que deseja deletar o avaliador abaixo?")
@includeIf('_layouts._modal-delete')

@endsection
