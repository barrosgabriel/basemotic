@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('votacaoPopular.home')}}" class="breadcrumb">Home</a>
    <a href="{{route ('votacaoPopular.home')}}" class="breadcrumb">Votação Popular</a>
@endsection

@section('content')

@section('titulo-header', 'Votação Popular')

@section('conteudo-header', 'Esses são os projetos cadastrados no sistema!')

@includeIf('_layouts._sub-titulo')
<div class="section container">
    <div class="card-panel">

        <div class="row">
            @includeIf('votacao-popular')
        </div>



    </div>
</div>


@endsection
