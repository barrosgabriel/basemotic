@extends('_layouts._app')

@section('titulo','Motic Professor')

@section('breadcrumb')
    <a href="{{route ('professor')}}" class="breadcrumb">Home</a>
    <a href="{{route ('professor.projeto')}}" class="breadcrumb">Home</a>
@endsection

@section('content')

@section('titulo-header', 'Projeto')

@section('conteudo-header', 'Esse é o projeto que você faz parte')

@includeIf('_layouts._sub-titulo')
    <div class="section container">
        <div class="card-panel">
            <div class="row">
                @if(!isset($professor->projeto))
                    <ul class="collection with-header">
                        <li class="collection-header"><h4 class="center-align">Professor sem projeto</h4></li>
                        <li class="collection-item">Para cadastrar um projeto, logue com o perfil da escola e cadastre. Após fazer isso, ele irá aparecer aqui.</li>

                    </ul>
                @else
                    @foreach($professor->projeto as $p)
                        <ul class="collapsible col s12 m12 l12">
                            <li>
                                <div class="collapsible-header"><i
                                            class="material-icons">filter_drama</i>{{$p->titulo}}
                                    - Edição de {{$p->ano}}</div>
                                <div class="collapsible-body">
                                    <ul class="collection">
                                        <li class="collection-item">Título: {{$p->titulo}}</li>
                                        <li class="collection-item">Área: {{$p->area}}</li>
                                        <li class="collection-item">
                                            Disciplinas: @foreach($p->disciplina as $disciplina) {{$disciplina->name.", "}}@endforeach</li>
                                            <li class="collection-item">Resumo: @if($p->resumo == NULL)
                                                {{'Não informado'}}
                                                @else
                                                    {{$p->resumo}}
                                                @endif
                                            </li>
                                            <li class="collection-item">Objetivo: @if($p->objetivo == NULL)
                                                {{'Não informado'}}
                                                @else
                                                    {{$p->objetivo}}
                                                @endif
                                            </li>
                                            <li class="collection-item">Metodologia: @if($p->metodologia == NULL)
                                                {{'Não informado'}}
                                                @else
                                                    {{$p->metodologia}}
                                                @endif
                                            </li>
                                            <li class="collection-item">Recurso: @if($p->recurso == NULL)
                                                {{'Não informado'}}
                                                @else
                                                    {{$p->recurso}}
                                                @endif
                                            </li>
                                        @foreach($p->aluno as $aluno)
                                            <li class="collection-item">Aluno: {{$aluno->name}}</li>
                                        @endforeach
                                        @foreach($p->professor as $professor)
                                            <li class="collection-item">Professor: {{$professor->name}}
                                                - {{$professor->pivot->tipo}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection