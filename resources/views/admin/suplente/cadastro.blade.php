@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.suplente')}}" class="breadcrumb">suplentes</a>
    <a href="{{route ('admin.suplente.create')}}" class="breadcrumb">Cadastro</a>
@endsection

@section('content')

@section('titulo-header', 'Cadastrar projeto suplente')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório e deve-se selecionar exatamente 3 alunos.")

@includeIf('_layouts._sub-titulo')

<section class="section container">
    <div class="card-panel">
        <div class="row">
            @include('_layouts._mensagem-erro')
            <article class="col s12">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.suplente.store') }}">

                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>

                    <h5>Dados básicos</h5>

                    <div class="row">
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">perm_identity</i>
                            <label for="nome">Título <span style="color:red;font-weight:bold"> * </span></label>
                            <input type="text" name="titulo" required>
                        </div>
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">perm_identity</i>
                            <label for="nome">Área <span style="color:red;font-weight:bold"> * </span></label>
                            <input type="text" name="area" required>
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
                                      class="materialize-textarea"></textarea>
                            <label for="textarea1">Resumo <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="objetivo" id="textarea2" data-length="3000"
                                      class="materialize-textarea"></textarea>
                            <label for="textarea2">Objetivo <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="metodologia" id="textarea3" data-length="3000"
                                      class="materialize-textarea"></textarea>
                            <label for="textarea3">Metodologia <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="recurso" id="textarea4" data-length="3000"
                                      class="materialize-textarea"></textarea>
                            <label for="textarea4">Recurso <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="avaliacao" id="textarea5" data-length="3000"
                                      class="materialize-textarea"></textarea>
                            <label for="textarea4">Avaliação <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <blockquote>
                        Você pode escolher mais de uma disciplina.
                    </blockquote>

                    <div class="row">

                    <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <select name="turno" id="turno" required>
                                <option value="" disabled selected>Selecione um turno</option>
                                <option value="1">Manhã</option>
                                <option value="2">Tarde</option>
                                <option value="3">Noite</option>
                            </select>
                            <label>Turno <span style="color:red;font-weight:bold"> * </span></label>
                        </div>


                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <select multiple name="disciplina_id[]">
                                <option value="" disabled selected>Selecione as disciplinas</option>
                                @forelse ($disciplinas as $disciplina)
                                    <option value="{{$disciplina->id}}">{{$disciplina->name}}</option>
                                @empty
                                    <option value="">Nenhuma disciplina cadastrada no sistema! Entre em contato com
                                        o administrador.
                                    </option>
                                @endforelse
                            </select>
                            <label>Disciplinas <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class="row">

                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <select name="escola_id" id="escolasuplente">
                                <option disabled selected>Escola</option>
                                @forelse ($escolas as $escola)
                                    <option value="{{$escola->id}}">{{$escola->name}}</option>
                                @empty
                                    <option value="">Nenhuma escola cadastrada no sistema! Entre em contato com o
                                        administrador.
                                    </option>
                                @endforelse
                            </select>
                            <label>Escola <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select name="categoria_id" id="categorias" required>
                            </select>
                            <label>Categoria *</label>
                        </div>

                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select multiple name="aluno_id[]" id="alunos" required>
                            </select>
                            <label>Alunos <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class="row">

                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select name="orientador" id="orientador" required>
                            </select>
                            <label>Orientador <span style="color:red;font-weight:bold"> * </span></label>
                        </div>

                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select name="coorientador" id="coorientador" required>
                            </select>
                            <label>Coorientador</label>
                        </div>

                    </div>

                    {{csrf_field()}}

                    <div class="fixed-action-btn">
                        <button disabled id="envia" type="submit"
                                class="btn-floating btn-large waves-effect waves-light red tooltipped  modal-trigger"
                                data-position="top" data-delay="50" data-tooltip="Cadastrar"><i
                                    class="material-icons">add_circle_outline</i></button>
                    </div>

                </form>

            </article>
        </div>
    </div>
</section>

@endsection


























