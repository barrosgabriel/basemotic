@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.professor')}}" class="breadcrumb">Professor</a>
    @if(isset($professor))
        <a href="{{route ('admin.professor.edit', $professor->id)}}" class="breadcrumb">Editar</a>
    @else
        <a href="{{{route ('admin.professor.create')}}}" class="breadcrumb">Cadastro</a>
    @endif
@endsection

@section('campo-escola')


    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">people</i>
        <select multiple name="escola_id[]">
            <option value="" disabled selected>Selecione a escola</option>
            @forelse ($escolas as $escola)
                <option value="{{$escola->id}}"
                        @if(isset($professor)) @foreach($professor->escola as $e) @if ($escola->id == $e->id) selected @endif @endforeach @endif>{{$escola->name}}</option>
            @empty
                <option value="">Nenhuma escola cadastrada no sistema! Entre em contato com o
                    administrador.
                </option>
            @endforelse
        </select>
        <label>Escola *</label>
    </div>

@endsection

@section('content')

@section('titulo-header', 'Cadastrar professor')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório")

@includeIf('_layouts._sub-titulo')
<section class="section container">
    <div class="card-panel">
        @include('_layouts._mensagem-erro')
        <div class="row">
            <article class="col s12">
                <form method="POST" enctype="multipart/form-data"
                      action="@if(isset($professor)){{ route("admin.professor.update", $professor->user->id) }} @else {{ route('admin.professor.store') }} @endif">
                    @includeIf('_layouts._professor._form-professor')
                </form>
            </article>
        </div>
    </div>
</section>

@endsection
