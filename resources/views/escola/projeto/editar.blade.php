@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('escola')}}" class="breadcrumb">Home</a>
    <a href="{{route ('escola.projeto')}}" class="breadcrumb">Projetos</a>
    <a href="" class="breadcrumb">Editar</a>
@endsection

@section('content')

@section('titulo-header', 'Editar projeto')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório.")

@includeIf('_layouts._sub-titulo')

<section class="section container">
    <div class="card-panel">
        <div class="row">
            <article class="col s12">
                @include('_layouts._mensagem-erro')
                <form method="POST" enctype="multipart/form-data"
                      action="{{ route('escola.projeto.update', $projeto->id) }}">

                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>

                    <h5>Dados básicos</h5>

                    <div class="row">
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">perm_identity</i>
                            <label for="nome">Título *</label>
                            <input type="text" name="titulo" value="{{$projeto->titulo}}" required>
                        </div>
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">perm_identity</i>
                            <label for="nome">Área *</label>
                            <input type="text" name="area" value="{{$projeto->area}}" required>
                        </div>
                    </div>

                    <blockquote>
                        ATENÇÃO!
                        O resumo deve ter entre 50 e 3000 caracteres.
                    </blockquote>


                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="resumo" id="textarea1" data-length="3000"
                                      class="materialize-textarea">{{$projeto->resumo}}</textarea>
                            <label for="textarea1">Resumo *</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="objetivo" id="textarea2" data-length="3000"
                                      class="materialize-textarea">{{$projeto->objetivo}}</textarea>
                            <label for="textarea2">Objetivo *</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="metodologia" id="textarea3" data-length="3000"
                                      class="materialize-textarea">{{$projeto->metodologia}}</textarea>
                            <label for="textarea3">Metodologia *</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="recurso" id="textarea4" data-length="3000"
                                      class="materialize-textarea">{{$projeto->recurso}}</textarea>
                            <label for="textarea4">Recurso *</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="avaliacao" id="textarea5" data-length="3000"
                                      class="materialize-textarea">{{$projeto->avaliacao}}</textarea>
                            <label for="textarea4">Avaliação *</label>
                        </div>
                    </div>

                    <blockquote>
                        Você pode escolher mais de uma disciplina.
                    </blockquote>

                    <div class="row">


                        {{-- <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <select name="turno" id="turno">
                            <option value="{{$projeto->turno}}" disabled selected>@if($projeto->turno == 1)Manha
                                    @elseif($projeto->turno == 2)Tarde @else Noite
                                @endif</option>
                                <option value="1">Manhã</option>
                                <option value="2">Tarde</option>
                                <option value="3">Noite</option>
                            </select>
                            <label>Turno *</label>
                    </div> --}}


                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <select multiple name="disciplina_id[]">
                                <option value="" disabled selected>Selecione as disciplinas</option>
                                @forelse ($disciplinas as $disciplina)
                                    <option value="{{$disciplina->id}}" @foreach($projeto->disciplina as $d) @if($disciplina->name == $d->name) selected @endif @endforeach>{{$disciplina->name}}</option>
                                @empty
                                    <option value="">Nenhuma disciplina cadastrada no sistema! Entre em contato com
                                        o administrador.
                                    </option>
                                @endforelse
                            </select>
                            <label>Disciplinas</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select name="categoria_id" id="categorias" required>
                                <option selected
                                        value="{{$projeto->categoria->id}}">{{$projeto->categoria->categoria}}</option>
                            </select>
                            <label>Categoria *</label>
                        </div>

                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select multiple name="aluno_id[]" id="alunos" required>
                                @if(isset($alunos))
                                    @foreach($alunos as $aluno)
                                    <option @foreach($projeto->aluno as $a) @if($aluno->id == $a->id) selected
                                            @endif @endforeach value="{{$aluno->id}}">{{$aluno->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <label>Alunos *</label>
                        </div>
                    </div>

                    <div class="row">

                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select name="orientador" id="orientador" required>
                                @foreach($professores as $professor)
                                    <option @foreach($projeto->professor as $p) @if($p->id == $professor->id and $p->pivot->tipo == "orientador") selected
                                            @endif @endforeach value="{{$professor->id}}">{{$professor->name}}</option>
                                @endforeach
                            </select>
                            <label>Orientador *</label>
                        </div>

                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select name="coorientador" id="coorientador">
                                    <option selected value="">Nenhum</option>
                                @foreach($professores as $professor)
                                    <option @foreach($projeto->professor as $p) @if($p->id == $professor->id and $p->pivot->tipo == "coorientador") selected
                                            @endif @endforeach value="{{$professor->id}}">{{$professor->name}}</option>
                                @endforeach
                            </select>
                            <label>Coorientador</label>
                        </div>

                        

                    {{csrf_field()}}

                    <p class="center-align">
                        <button class="waves-effect waves-light btn" type="submit"><i
                                    class="material-icons right">send</i>salvar
                        </button>
                    </p>

                </form>
                <input type="hidden" id="id_escola" name="id_escola" value="@if (isset(Auth::user()->escola->id)) {{Auth::user()->escola->id}} @endif">
            </article>
        </div>
    </div>
    </div>
</section>
@endsection


























