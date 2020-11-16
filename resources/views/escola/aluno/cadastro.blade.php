@extends('_layouts._app')

@section('titulo','Motic Escola')

@section('breadcrumb')
    <a href="{{route ('escola')}}" class="breadcrumb">Home</a>
    <a href="{{route ('escola.aluno')}}" class="breadcrumb">Alunos</a>
    @if(isset($aluno))
        <a href="" class="breadcrumb">Editar</a>
    @else
        <a href="{{route ('escola.aluno.create')}}" class="breadcrumb">Cadastro</a>
    @endif
@endsection

@section('campo-escola')
    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">people</i>
        <select id='escolaAluno' name="escola_id">
            <option value="{{$escola->id}}" selected>{{$escola->name or old('name')}}</option>
        </select>
        <label>Escola *</label>
    </div>
@endsection

@section('campo-etapa')
    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">book</i>
        <select name="categoria_id">
            <option value="" disabled selected>Ano/Etapa</option>
            @foreach($ano as $etapa)
                <option value="{{$etapa->id}}"
                        @if(isset($aluno)) @if($aluno->etapa == $etapa->etapa) selected @endif @endif>{{$etapa->etapa}}</option>
            @endforeach
        </select>
        <label><Ano>Ano/Etapa *</label>
    </div>
@endsection

@section('content')

@section('titulo-header', 'Cadastrar aluno')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório.")

@includeIf('_layouts._sub-titulo')
<div class="container section">
    <div class="card-panel">
        @includeIf('_layouts._mensagem-erro')
        <div class="row">
            <form class="col s12" method="post" enctype="multipart/form-data"
                  action="@if(isset($aluno)){{ route('escola.aluno.update', $aluno->id) }}
                  @else {{ route('escola.aluno.store') }}@endif ">
                {{csrf_field()}}
                @include('_layouts._aluno._form-aluno')
            </form>
        </div>
    </div>
</div>

@endsection