@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.projeto')}}" class="breadcrumb">Projetos</a>
    <a href="{{route ('admin.projeto.create')}}" class="breadcrumb">Cadastro</a>
@endsection

@section('content')

@section('titulo-header', 'Cadastrar projeto')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório e deve-se selecionar exatamente 3 alunos.")

@includeIf('_layouts._sub-titulo')

<section class="section container">
    <div class="card-panel">
        <div class="row">
            @include('_layouts._mensagem-erro')
            <article class="col s12">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.projeto.store') }}">

                    <h5>Dados básicos</h5>

                    <div class="row">
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">perm_identity</i>
                            <label for="nome">Título <span style="color:red;font-weight:bold"> * </span></label>
                            <input type="text" name="titulo" value="{{Request::old('titulo')}}" required>
                        </div>
                        <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix">perm_identity</i>
                            <label for="nome">Área <span style="color:red;font-weight:bold"> * </span></label>
                            <input type="text" name="area"  value="{{Request::old('area')}}" required>
                        </div>
                    </div>

                    <blockquote>
                        ATENÇÃO!
                        O resumo, objetivo, metodologia e recurso devem ter entre 50 e 3000 caracteres.
                    </blockquote>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="resumo" id="textarea1" data-length="3000" minlength="50"
                                      class="materialize-textarea">{{Request::old('resumo')}}</textarea>
                            <label for="textarea1">Resumo <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="objetivo" id="textarea2" data-length="3000" minlength="50"
                                      class="materialize-textarea">{{Request::old('objetivo')}}</textarea>
                            <label for="textarea2">Objetivo <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="metodologia" id="textarea3" data-length="3000" minlength="50"
                                      class="materialize-textarea">{{Request::old('metodologia')}}</textarea>
                            <label for="textarea3">Metodologia <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                        <textarea name="recurso" id="textarea4"  data-length="3000" minlength="50"
                                      class="materialize-textarea">{{Request::old('recurso')}}</textarea>
                            <label for="textarea4">Recurso <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea name="avaliacao" id="textarea5" data-length="3000"
                                      class="materialize-textarea">{{Request::old('avaliacao')}}</textarea>
                            <label for="textarea4">Avaliação <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <blockquote>
                        Você pode escolher mais de uma disciplina.
                    </blockquote>

                    <div class="row">

                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <select name="turno" id="turno"  required>
                                <option value="" disabled selected >Selecione um turno</option>
                                <option value="1">Manhã</option>
                                <option value="2">Tarde</option>
                                <option value="3">Noite</option>
                            </select>
                            <label>Turno <span style="color:red;font-weight:bold"> * </span></label>
                        </div>





                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <select multiple name="disciplina_id[]" id="disciplina_id[]" required>
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
                            <select name="escola_id" id="escolaprojeto" required>
                                <option value="" disabled selected>Escolas</option>
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
                            <label>Categoria <span style="color:red;font-weight:bold"> * </span></label>
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
                            <label>Orientador<span style="color:red;font-weight:bold"> * </span> </label>
                        </div>

                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">assignment</i>
                            <select name="coorientador" id="coorientador" >
                            </select>
                            <label>Coorientador</label>
                        </div>

                        <div class="input-field col s12 m6 l7">

                    <a data-target="modal1" class="modal-trigger tooltipped #512da8 deep-purple darken-2 btn" data-position="top" data-delay="50" data-position="top" data-delay="50" data-tooltip="Regras Orientadores"
                        href="#modalRegrasOrientadores" >Regras Orientadores</a>

                        <div id="modalRegrasOrientadores" class="modal">
                                <div class="modal-content">
                                    <h4 align="center">Regras Orientadores</h4>

                                    <div class="row">
                                            <h5 align="center">Para inscrição do trabalho no sistema da MOTIC 2019, o professor/a orientador/a e o
                                                    professor/a coorientador/a poderão orientar ou coorientar mais de um trabalho, desde que
                                                    em turnos diferentes, podendo ser na mesma ou em outra escola. No máximo de 3 trabalhos por orientador.
                                            </h5>
                                    </div>
                                    <div class="row">
                                            <h5 align="center">Caso algum dos critérios acima não for obedecido, o professor/orientar não estará listado nas opções</h5>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <a class="btn #512da8 deep-purple darken-2" onclick="$('.modal').modal('close');">Ok</a>

                                </div>

                            </div>
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
