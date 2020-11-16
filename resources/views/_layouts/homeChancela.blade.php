@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.aluno.tabelaCertificado')}}" class="breadcrumb">Visualizar Certificados</a>
@endsection

@section('content')

@section('titulo-header', 'Visualizar certificados')

@section('conteudo-header', 'Esses são os usuários que já tiveram os certificados gerados na MOTIC ' . date('Y') . '!')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
            {{--  <form method="POST" enctype="multipart/form-data" action="{{ route('admin.aluno.filtrar') }}">
                @includeIf('_layouts._aluno._filtro-aluno')
            </form>  --}}
        </div>
        <div class="row">
            @includeIf('_layouts._tabela-chancelas')
        </div>
        
    </div>
</div>

@section('conteudo-deletar', "Você tem certeza que deseja deletar o aluno abaixo?")
@includeIf('_layouts._modal-delete')

@endsection