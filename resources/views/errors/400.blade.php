@extends('_layouts._app')

@section('titulo','Erro')

@section('breadcrumb')
    <a href="{{route ('avaliador')}}" class="breadcrumb">Home</a>
@endsection

@section('content')
    <div class="container">
        <h2>Código de erro: {{$exception->getMessage()}}</h2>
        <h3>OPS: Você esqueceu de avaliar algum critério. Volte para a página de avaliação e tente de novo.</h3>
        <a class="waves-effect waves-light btn" href="{{route('avaliador')}}"><i class="material-icons left">cloud</i>Voltar</a>
    </div>
@endsection
