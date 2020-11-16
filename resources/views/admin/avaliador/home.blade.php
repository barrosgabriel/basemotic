@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.avaliador')}}" class="breadcrumb">Avaliadores</a>
@endsection

@section('content')

@section('titulo-header', 'Avaliadores')

@section('conteudo-header', 'Esses são os avaliadores cadastrados no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
        </div>
        <div class="center-align">
            <div class="chip">
                Existem {{$quantidade}} avaliadores liberados no sistema.
                <i class="close material-icons">close</i>
            </div>
        </div>
        <div class="row">
            @includeIf('_layouts._avaliador._tabela-avaliador')
        </div>

        <div class="fixed-action-btn">
            <a class="btn-floating btn-large waves-effect waves-light red tooltipped" data-position="top"
               data-delay="50" data-tooltip="Adicionar avaliador" href="{{route ('admin.avaliador.create')}}"><i
                        class="material-icons">add</i></a>
        </div>

    </div>
</div>

@section('conteudo-deletar', "Você tem certeza que deseja deletar o avaliador abaixo?")
@includeIf('_layouts._modal-delete')

@endsection
