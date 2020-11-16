@includeIf('_layouts._mensagem-erro')
@if(Session::get('mensagem'))
    @include('_layouts._mensagem-sucesso')
@endif
<div class="container">

    <div class="col s12 m12 l12">
        <div class="card-panel hoverable">
            <div class="row">
                <div class="card-content">
                    <ul class="collection with-header col s12 m12 l6">
                        <li class="collection-header"><h4 class="center-align">Dados pessoais</h4></li>
                        <li class="collection-item">Nome: {{$professor->name}}</li>
                        <li class="collection-item">Nascimento: {{$professor->nascimento}}</li>
                        <li class="collection-item">Sexo: {{$professor->sexo}}</li>
                        <li class="collection-item">E-mail: {{$professor->user->email}}</li>
                        <li class="collection-item">Telefone: {{$professor->telefone}}</li>
                        @foreach($professor->escola as $escola)
                            <li class="collection-item">Escola: {{$escola->name}}</li>
                        @endforeach
                        <li class="collection-item">CPF: {{$professor->cpf}}</li>
                        <li class="collection-item">Matrícula: {{$professor->matricula}}</li>
                        <li class="collection-item">Usuário: {{$professor->user->username}}</li>
                    </ul>
                    <ul class="collection with-header col s12 m12 l6">
                        <li class="collection-header"><h4 class="center-align">Endereço</h4></li>
                        <li class="collection-item">
                            ID: @if(isset($professor->user->endereco->id)){{$professor->user->endereco->id}}@endif</li>
                        <li class="collection-item">
                            Rua: @if(isset($professor->user->endereco->rua)){{$professor->user->endereco->rua}}@endif</li>
                        <li class="collection-item">
                            Número: @if(isset($professor->user->endereco->numero)){{$professor->user->endereco->numero}}@endif</li>
                        <li class="collection-item">
                            Bairro: @if(isset($professor->user->endereco->bairro)){{$professor->user->endereco->bairro}}@endif</li>
                        <li class="collection-item">
                            Complemento: @if(isset($professor->user->endereco->complemento)){{$professor->user->endereco->complemento}}@endif</li>
                        <li class="collection-item">
                            CEP: @if(isset($professor->user->endereco->cep)){{$professor->user->endereco->cep}}@endif</li>
                        <li class="collection-item">
                            Cidade: @if(isset($professor->user->endereco->cidade)){{$professor->user->endereco->cidade}}@endif</li>
                        <li class="collection-item">
                            Estado: @if(isset($professor->user->endereco->estado)){{$professor->user->endereco->estado}}@endif</li>
                        <li class="collection-item">
                            País: @if(isset($professor->user->endereco->pais)){{$professor->user->endereco->pais}}@endif</li>
                    </ul>
                    <ul class="collection with-header col s12 m12 l12">
                        <li class="collection-header"><h4 class="center-align">Projetos</h4></li>
                    </ul>
                    @forelse($professor->projeto as $projeto)
                        <ul class="collapsible col s12 m12 l12">
                            <li>
                                <div class="collapsible-header"><i
                                            class="material-icons">filter_drama</i>{{$projeto->titulo}}
                                    - Edição de {{$projeto->ano}}</div>
                                <div class="collapsible-body">
                                    <ul class="collection">
                                        <li class="collection-item">Título: {{$projeto->titulo}}</li>
                                        <li class="collection-item">Área: {{$projeto->area}}</li>
                                        <li class="collection-item">Resumo: {{$projeto->resumo}}</li>
                                        <li class="collection-item">
                                            Disciplinas: @foreach($projeto->disciplina as $disciplina) {{$disciplina->name.", "}}@endforeach</li>
                                        <li class="collection-header"><h4 class="center-align">Alunos</h4></li>
                                        @foreach($projeto->aluno as $aluno)
                                            <li class="collection-item">Aluno: {{$aluno->name}}</li>
                                        @endforeach
                                        <li class="collection-header"><h4 class="center-align">Professores</h4></li>
                                        @foreach($projeto->professor as $professor)
                                            <li class="collection-item">Professor: {{$professor->name}}
                                                - {{$professor->pivot->tipo}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @empty
                        <li class="collection-item"><span class="center-align">Professor sem projeto</span></li>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
