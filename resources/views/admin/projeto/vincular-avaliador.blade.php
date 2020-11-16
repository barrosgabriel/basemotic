@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.projeto')}}" class="breadcrumb">Avaliador</a>
    <a href="" class="breadcrumb">Vincular projeto</a>
@endsection

@section('content')

@section('titulo-header', 'Vincular projeto')

@section('conteudo-header', 'Esses são os avaliadores disponíveis no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="row">
            <form method="post" action="{{route ('admin.projeto.vincula')}}">
                {{csrf_field()}}
                <div class="input-field col s12 m12 l12">
                    <i class="material-icons prefix">assignment</i>
                    {{\Illuminate\Support\Facades\Session::put('id', $projeto->id)}}
                    <select id="avaliadores" multiple name="avaliadores[]" required>
                        <option value="" disabled selected>Avaliadores...</option>
                        @forelse($avaliadores as $avaliador)
                            @if($avaliador->user->ativo == 1)
                            <option value="{{$avaliador->id}}">{{$avaliador->name}}</option>
                            @endif
                        @empty
                            <option>Sem avaliadores disponíveis</option>
                        @endforelse
                    </select>
                    <label>Avaliadores</label>
                </div>
                <button type='submit' class="btn blue darken-4" disabled id="envia_avaliador">Vincular</button>
            </form>
        </div>
    </div>
</div>

<table id="projetos"> 

</table>
@section('conteudo-deletar', "Você tem certeza que deseja deletar o avaliador abaixo?")
@includeIf('_layouts._modal-delete')

@endsection
