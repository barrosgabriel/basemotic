@extends('_layouts._app')

@section('titulo','Motic Escola')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.suplente')}}" class="breadcrumb">Suplentes</a>
@endsection

@section('content')

@section('titulo-header', 'Suplentes')

@section('conteudo-header', 'Esses são os projetos suplentes cadastrados no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container">

    <ul class="collapsible">
        <li>
            <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
            <div class="collapsible-body white">
                <form method="POST" action="{{ route('admin.suplente.filtrar') }}">
                    @includeIf('_layouts._suplente._filtro-suplente')
                </form>
            </div>
        </li>
    </ul>

    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
        </div>

        <div class="center-align">
            <div class="chip">
                Existem {{$quantidade}} projetos cadastrados no sistema para a edição de {{date('Y')}}.
                <i class="close material-icons">close</i>
            </div>
        </div>

        <div class="row">
            @includeIf('_layouts._suplente._tabela-suplente')
        </div>

        <div class="fixed-action-btn">
            <div class="fixed-action-btn">
                <a class="btn-floating btn-large waves-effect waves-light red tooltipped  modal-trigger"
                   data-position="top" data-delay="50" data-tooltip="Adicionar projeto suplente"
                   href="{{route ('admin.suplente.create')}}"><i class="material-icons">add</i></a>
            </div>
        </div>

    </div>
</div>
</div>

@section('conteudo-deletar', "Você tem certeza que deseja deletar o projeto abaixo?")
@includeIf('_layouts._modal-delete')

@endsection