@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.suplente')}}" class="breadcrumb">Suplentes</a>
    <a href="" class="breadcrumb">{{$projeto->titulo}}</a>
@endsection

@section('content')

@section('titulo-header', $projeto->titulo)

@section('conteudo-header', 'Esses são todos os dados do projeto '.$projeto->titulo)

@includeIf('_layouts._sub-titulo')

@include('_layouts._projeto._show-projeto')

@endsection