@extends('_layouts._app')

@section('titulo','Avaliador Externo')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.avaliador')}}" class="breadcrumb">Avaliador</a>
    @if(isset($avaliador))
        <a href="" class="breadcrumb">Editar</a>
    @else
        <a href="{{route ('admin.avaliador.create')}}" class="breadcrumb">Cadastro</a>
    @endif
@endsection

@section('content')

@section('titulo-header', 'Cadastro  de avaliador')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório")

@includeIf('_layouts._sub-titulo')

<section class="section container">
    @if(Session::get('mensagem'))
         @include('_layouts._mensagem-sucesso')
    @endif

    <div class="card-panel">
        <div class="row">
            <article class="col s12">

                @include('_layouts._mensagem-erro')
                <form method="POST" enctype="multipart/form-data"
                      action="{{ route('cadastro.avaliadores.externo.salvar')}}">

                {{csrf_field()}}



                <h5>Dados básicos</h5>

                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">perm_identity</i>
                        <input minlength="2" id="name" class="validate" type="text" name="name"
                               value="{{old('name')}}" required>
                        <label data-error="Insira um nome válido!" data-success="Ok" for="name">Nome do avaliador
                            <span style="color:red;font-weight:bold"> * </span></label>
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">today</i>
                        <input type="text" class="datepicker" name="nascimento"
                               value="{{old('nascimento')}}">
                        <label for="nascimento">Nascimento</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">people</i>
                        <select name="sexo">
                            <option value="{{old('sexo')}}" disabled selected>Sexo</option>
                            <option value="feminino">Feminino </option>
                            <option value="masculino" >Masculino </option>

                        </select>
                        <label>Sexo *</label>
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">book</i>
                        <select name="grauDeInstrucao">
                            <option value="{{old('grauDeInstrucao')}}" disabled selected>Grau de Instrução</option>
                            <option value="Técnico">Técnico</option>
                            <option value="Graduado">Graduado</option>
                            <option value="Mestrado">Mestrado</option>
                            <option value="Doutorado">Doutorado</option>


                        </select>
                        <label>Grau de Instrição</label>
                    </div>

                </div>
                <div class="row">

                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">email</i>
                        <input minlength="10" class='validate' id='email' type="email" name="email"
                               value="{{old('email')}}" required>
                        <label data-error="Insira um e-mail válido!" data-success="Ok"
                               for="email">Email <span style="color:red;font-weight:bold"> * </span></label>
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">local_phone</i>
                        <input id="telefone" class="validate tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Somente números e no mínimo 8 números" type="number" name="telefone"
                               data-length="16" value="{{old('telefone')}}">
                        <label data-error="Insira um telefone válido!" data-success="Ok"
                               for="telefone">Telefone</label>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">perm_identity</i>
                        <input minlength="2" id="instituicao" class="validate" type="text" name="instituicao"
                               value="{{old('instituicao')}}" required>
                        <label data-error="Insira uma instituição válida!" data-success="Ok" for="instituicao">Instituição
                            <span style="color:red;font-weight:bold"> * </span></label>
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">perm_identity</i>
                        <input required id="cpf" class="validate tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Somente números" type="text" name="cpf"
                               data-length="14" value="{{old('cpf')}}">
                        <label data-error="Insira um cpf válido!" data-success="Ok"
                               for="telefone">CPF<span style="color:red;font-weight:bold"> * </span></label>
                    </div>
                </div>

                <h5>Endereço</h5>

                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">explore</i>
                        <input id="cep" class="validate tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Somente números e no máximo 8 números" type="number" name="cep"
                               data-length="8"
                               value="{{old('cep')}}">
                        <label data-error="Insira um cep válido!" data-success="Ok"
                               for="cep">CEP</label>
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">business</i>
                        <input id="bairro" class="validate" type="text" name="bairro"
                               value="{{old('bairro')}}">
                        <label data-error="Insira um bairro válido!" data-success="Ok"
                               for="bairro">Bairro</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 m6 l4">
                        <i class="material-icons prefix">home</i>
                        <input class="validate" id="rua" type="text" name="rua"
                               value="{{old('rua')}}">
                        <label data-error="Insira uma rua válida!" data-success="Ok"
                               for="rua">Rua</label>
                    </div>

                    <div class="input-field col s12 m6 l4">
                        <i class="material-icons prefix">filter_1</i>
                        <input class="validate" id="numero" type="number" name="numero"
                               value="{{old('numero')}}">
                        <label data-error="Insir a um número válido!" data-success="Ok"
                               for="numero">N°</label>
                    </div>

                    <div class="input-field col s12 m12 l4">
                        <i class="material-icons prefix">home</i>
                        <input type="text" name="complemento"
                               value="{{old('complemento')}}">
                        <label for="complemento">Complemento</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 m12 l4">
                        <i class="material-icons prefix">location_city</i>
                        <input id="cidade" class="validate" type="text" name="cidade"
                               value="São Leopoldo"
                               value="{{old('cidade')}}">
                        <label data-error="Insira uma cidade válida!" data-success="Ok"
                               for="cidade">Cidade</label>
                    </div>

                    <div class="input-field col s12 m6 l4">
                        <i class="material-icons prefix">location_city</i>
                        <input id="estado" class="validate" type="text" name="estado"
                               value="Rio Grande do Sul"
                               value="{{old('estado')}}">
                        <label data-error="Insira um estado válido!" data-success="Ok"
                               for="estado">Estado</label>
                    </div>

                    <div class="input-field col s12 m6 l4">
                        <i class="material-icons prefix">location_city</i>
                        <input class="validate" id="pais" type="text" name="pais" value="Brasil"
                               value="{{old('pais')}}">
                        <label data-error="Insira um país válido!" data-success="Ok"
                               for="pais">País</label>
                    </div>
                </div>

                @if(!isset($avaliador))

                    <h5>Usuário</h5>

                    <div class="row">
                        <div class="input-field col s12 m6 l12">
                            <i class="material-icons prefix">person</i>
                            <input id="usuario" class="validate tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Insira um usuário com até 30 caracteres"
                                   type="text" name="username" value="{{old('username')}}"
                                   required>
                            <label data-error="Insira um usuário válido!" data-success="Ok"
                                   for="usuario">Usuário <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" class="validate tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Insira uma senha com no mínimo 6 caracteres" type="password"
                                   name="password"
                                   value="{{old('password')}}" required>
                            <label data-error="Insira uma senha válida!" data-success="Ok"
                                   for="password">Senha <span style="color:red;font-weight:bold"> * </span></label>
                        </div>

                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">lock</i>
                            <input class="validate tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Confirme sua senha" id="password_confirmation" type="password"
                                   name="password_confirmation" value="{{old('password')}}" required>
                            <label data-error="Insira uma senha válida!" data-success="Ok"
                                   for="password_confirmation">Confirmar senha <span style="color:red;font-weight:bold"> * </span></label>
                        </div>
                    </div>
                @endif
                <div class="fixed-action-btn">
                    <button type="submit" class="btn-floating btn-large waves-effect waves-light red tooltipped"
                            data-position="top" data-delay="50" data-tooltip="Cadastrar"><i class="material-icons">add_circle_outline</i>
                    </button>
                </div>

                </form>

            </article>
        </div>
    </div>
</section>


@endsection

