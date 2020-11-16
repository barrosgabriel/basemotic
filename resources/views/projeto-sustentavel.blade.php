@extends('_layouts._app')

@section('titulo','Motic - Votação Projeto Sustentável')

@section('content')

    <div class="section container">
        <div class="card-panel">
            <h1 class="header center orange-text">Votação Projeto Sustentável</h1>
        </div>
    </div>
    
    <div class="section container">
        <div class="card-panel">
            <div class="row">
                @if(Session::get('mensagem'))
                    @include('_layouts._mensagem-sucesso')
                @endif
                
                <form method="post" action="{{route('projetoSustentavel.escolha')}}">
                    {{csrf_field()}}
                    <div class="input-field col s12 m12 l12">
                        <select name="projetos" id="projetos" required>
                            <option value="" disabled selected>Projetos...</option>
                            @foreach($projetoSustentavel as $projeto)
                                <option value="{{$projeto->id}}">{{$projeto->titulo}}</option>
                                @endforeach
                        </select>
                        <label>Projetos</label>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <div class="row">
                                <button type="submit" class="btn-large col s12 tooltipped blue darken-4" data-position="top" data-delay="50"
                                        data-tooltip="Votar"><i class="material-icons">check</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @php

    @endphp

@endsection

