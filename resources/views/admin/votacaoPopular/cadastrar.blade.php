@extends('_layouts._app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.professor')}}" class="breadcrumb">Cadastro Usuário Votação Popular</a>

@endsection


@section('content')

@section('titulo-header', 'Cadastro Usuário Votação Popular')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório")

@includeIf('_layouts._sub-titulo')
<section class="section container">
    <div class="card-panel">
        @include('_layouts._mensagem-erro')
        <div class="row">
                <h5>Usuário</h5>
            <article class="col s12">
                <form method="POST" enctype="multipart/form-data"
                      action="{{route('votacaoPopular.cadastro.salvar')}}">

                      {{ csrf_field() }}
                      <div class="row">
                          <blockquote>
                              Ao escolher um usuário, se atente aos seguintes padrões:
                              <br>-Digite um usuário em letras minúsculas.
                              <br>-Digite um usuário sem caracteres especiais.
                              <br>Usuário: votacao.popular
                          </blockquote>
                          <div class="input-field col s12 m12 l12">
                              <i class="material-icons prefix">person</i>
                              <label for="username">Usuário <span style="color:red;font-weight:bold"> * </span></label>
                              <input type="text" name="username" value="{{old('username')}}" required>

                          </div>
                          <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">person</i>
                                <label for="email">E-mail <span style="color:red;font-weight:bold"> * </span></label>
                                <input type="text" name="email" value="{{old('email')}}" required>

                            </div>
                      </div>
                      <div class="row">
                          <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">lock</i>
                              <label for="password">Senha <span style="color:red;font-weight:bold"> * </span></label>
                              <input type="password" name="password" value="{{old('password')}}" required>
                          </div>

                          <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">lock</i>
                              <label for="password_confirmation">Confirmar senha <span style="color:red;font-weight:bold"> * </span></label>
                              <input type="password" name="password_confirmation" value="{{old('password')}}" required>
                          </div>
                      </div>


                  <div class="fixed-action-btn">
                      <button type="submit"
                              class="btn-floating btn-large waves-effect waves-light red tooltipped  modal-trigger"
                              data-position="top" data-delay="50" data-tooltip="Cadastrar"><i
                                  class="material-icons">add_circle_outline</i>
                      </button>
                  </div>

                </form>
            </article>
        </div>
    </div>
</section>

@endsection
