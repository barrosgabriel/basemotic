@extends('_layouts._app')

@section('titulo','Motic Escola')

@section('breadcrumb')
    <a href="{{route ('escola')}}" class="breadcrumb">Home</a>
    <a href="{{route ('escola.professor.certificadosCoorientadores')}}" class="breadcrumb">Certificados Coorientadores</a>
@endsection

@section('content')

@section('titulo-header', 'Gerar certificado para coorientadores')

@section('conteudo-header', 'Esses são os professores coorientadores cadastrados na MOTIC ' . date('Y') . '!')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
                {{-- <form method="POST" enctype="multipart/form-data" action="{{ route('admin.professor.filtrar') }}">
                @includeIf('_layouts._professor._filtro-professor')
            </form> --}}
        </div>
        <div class="row">
            @includeIf('_layouts._professor._tabela-coorientador-certificados')
        </div>

    </div>
</div>

@section('conteudo-deletar', "Você tem certeza que deseja deletar o professor abaixo?")
@includeIf('_layouts._modal-delete')

@endsection
