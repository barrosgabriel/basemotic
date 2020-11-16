@extends('_layouts._app')

@section('titulo','Avisos')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('criaAviso.view')}}" class="breadcrumb">Avisos</a>
@endsection

@section('content')

@section('titulo-header', 'Aviso')


@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
            <div class="center-align">
                    <div class="chip green">
                        {{Session::get('mensagem')}}
                        <i class="close material-icons">close</i>
                    </div>
                </div>
                {{Session::forget('mensagem')}}

            @endif
        </div>
        <div class="row">

            <form action="{{route('criaAviso.salvar')}}" method="post">
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="titulo" required value="{{$informacao->titulo or old('titulo')}}">
                    <label>Titulo:</label>
                </div>
                <div class="input-field">
                        <i class="material-icons prefix">person</i>
                        <input type="text" name="corpo_aviso" required value="{{$informacao->corpo_aviso or old('corpo_aviso')}}">
                        <label>Mensagem:</label>
                </div>
                <div class="input-field">
                        <select name="ativo">
                        <option value="{{$informacao->ativo or old('ativo')}}" disabled selected>@if((isset($informacao->ativo)) && $informacao->ativo == 0 ) Desativado @elseif((isset($informacao->ativo)) && $informacao->ativo == 1 ) Ativado @else Escolha uma das opções abaixo @endif</option>
                          <option value="1">Ativado</option>
                          <option value="0">Desativado</option>


                        </select>
                        <label>Escolha a exibição do aviso</label>
                      </div>
                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light col s12 blue darken-4">Salvar
                            </button>
                        </div>

                    </div>
                </div>
            </form>

        </div>


    </div>
</div>

@endsection
