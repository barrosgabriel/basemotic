@extends('_layouts._app')

@section('titulo','Chancela')

{{-- @section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.aluno')}}" class="breadcrumb">Alunos</a>
@endsection
 --}}
@section('content')

@section('titulo-header', 'Valida Chancela')


@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
            <div class="center-align">
                    <div class="chip red">
                        {{Session::get('mensagem')}}
                        <i class="close material-icons">close</i>
                    </div>
                </div>
                {{Session::forget('mensagem')}}

            @endif
        </div>
        <div class="row">

            <form action="{{route('certificado.chancela.validar')}}" method="post">
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="chancela" required value="{{old('chancela')}}">
                    <label>Chancela</label>
                </div>

                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light col s12 blue darken-4">Validar
                            </button>
                        </div>

                    </div>
                </div>
            </form>

        </div>


    </div>
</div>

@endsection
