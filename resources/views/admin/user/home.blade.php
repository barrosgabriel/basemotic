@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.user')}}" class="breadcrumb">Usuários</a>
@endsection

@section('content')

@section('titulo-header', 'Usuários')

@section('conteudo-header', 'Esses são os usuários cadastrados no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.user.filtrar') }}">
                @includeIf('_layouts._usuario._filtro-usuario')
            </form>
        </div>
        <div class="center-align">
            <div class="chip">
                Existem {{$quantidade}} usuários cadastrados no sistema.
                <i class="close material-icons">close</i>
            </div>
        </div>
        <div class="row">
            @includeIf('_layouts._usuario._tabela-usuario')
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large waves-effect waves-light red tooltipped" data-position="top"
               data-delay="50" data-tooltip="Adicionar admin"
               href="{{route ('admin.user.create')}}">
                <i class="material-icons">add</i></a>
        </div>
    </div>
</div>

@section('conteudo-deletar', "Você tem certeza que deseja deletar o usuário abaixo?")
@includeIf('_layouts._modal-delete')

@endsection