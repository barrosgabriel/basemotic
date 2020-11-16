@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.config.limites')}}" class="breadcrumb">Limite de projetos</a>
@endsection

@section('content')

@section('titulo-header', 'Limites')

@section('conteudo-header', 'Aqui você pode configurar o limite de projetos que cada professor poderá estar vinculado.')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
            <blockquote>Atenção! O limite de projetos que estiver definido irá impactar todos os professores que irão se
                vincular futuramente. Sejam eles como orientador ou coorientador.
            </blockquote>

            <form method="POST" enctype="multipart/form-data"
                  action="{{ route("admin.config.limites.store") }}">
                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input type="number" name="limite" required id="limite"
                               value="{{$limite->limite or old('limite')}}">
                        <label for="limite">Limites de projetos por professores</label>
                    </div>
                    <div class="center center-align">
                        <button class="waves-effect waves-light btn blue darken-4" type="submit"><i
                                    class="material-icons right">send</i>salvar
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
