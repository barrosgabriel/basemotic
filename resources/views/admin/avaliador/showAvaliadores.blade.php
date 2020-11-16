@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.avaliador')}}" class="breadcrumb">Avaliadores Validação</a>
    <a href="" class="breadcrumb">{{$avaliador->name}}</a>
@endsection

@section('content')

    <div class="section container">
        <div class="card-panel">
            <h1 class="header center orange-text">{{$avaliador->name}}</h1>
            <div class="row center">
                <h5 class="header col s12 light">Essas são todos os dados do avaliador {{$avaliador->name}}!</h5>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="col s12 m12 l12">
            <div class="card-panel hoverable">
                <div class="row">
                    <div class="card-content">
                        <ul class="collection with-header col s12 m12 l6">
                            <li class="collection-header"><h4 class="center-align">Dados pessoais</h4></li>
                            <li class="collection-item">Nome: {{$avaliador->avaliador->name}}</li>
                            <li class="collection-item">Nascimento: {{$avaliador->avaliador->nascimento}}</li>
                            <li class="collection-item">Sexo: {{$avaliador->avaliador->sexo}}</li>
                            <li class="collection-item">E-mail: {{$avaliador->email}}</li>
                            <li class="collection-item">Telefone: {{$avaliador->avaliador->telefone}}</li>
                            <li class="collection-item">Grau de Instrução: {{$avaliador->avaliador->grauDeInstrucao}}</li>
                            <li class="collection-item">CPF: {{$avaliador->avaliador->cpf}}</li>
                            <li class="collection-item">Usuário: {{$avaliador->username}}</li>
                        </ul>
                        <ul class="collection with-header col s12 m12 l6">
                            <li class="collection-header"><h4 class="center-align">Endereço</h4></li>
                            <li class="collection-item">
                                Rua: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->rua}}@endif</li>
                            <li class="collection-item">
                                Número: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->numero}}@endif</li>
                            <li class="collection-item">
                                Bairro: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->bairro}}@endif</li>
                            <li class="collection-item">
                                Complemento: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->complemento}}@endif</li>
                            <li class="collection-item">
                                CEP: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->cep}}@endif</li>
                            <li class="collection-item">
                                Cidade: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->cidade}}@endif</li>
                            <li class="collection-item">
                                Estado: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->estado}}@endif</li>
                            <li class="collection-item">
                                País: @if(isset($avaliador->endereco->id)){{$avaliador->endereco->pais}}@endif</li>
                        </ul> 
                        <ul class="collection with-header col s12 m12 l12">
                            <li class="collection-header"><h4 class="center-align">Projetos</h4></li>
                             @forelse ($avaliador->avaliador->projeto as $projeto)
                                @if($projeto->ano == date('Y'))
                                    <li class="collection-item">
                                        Projeto: {{$projeto->titulo}}
                                    </li>
                                @endif
                            @empty
                                <li class="collection-item">
                                    Avaliador sem projetos vinculados.
                                </li>
                            @endforelse 
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
