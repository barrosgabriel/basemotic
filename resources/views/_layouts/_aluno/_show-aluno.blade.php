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
                        <li class="collection-item">Nome: {{$aluno->name}}</li>
                        <li class="collection-item">Nascimento: {{$aluno->nascimento}}</li>
                        <li class="collection-item">Sexo: {{$aluno->sexo}}</li>
                        <li class="collection-item">E-mail: {{$aluno->email}}</li>
                        <li class="collection-item">Telefone: {{$aluno->telefone}}</li>
                        <li class="collection-item">Escola: {{$aluno->escola->name}}</li>
                        <li class="collection-item">Ano/Etapa: {{$aluno->etapa}}</li>
                        <li class="collection-item">Turma: {{$aluno->turma}}</li>
                    </ul>
                    <ul class="collection with-header col s12 m12 l6">
                        <li class="collection-header"><h4 class="center-align">Endereço</h4></li>
                        <li class="collection-item">Rua: {{$aluno->rua}}</li>
                        <li class="collection-item">Número: {{$aluno->numero}}</li>
                        <li class="collection-item">Bairro: {{$aluno->bairro}}</li>
                        <li class="collection-item">Complemento: {{$aluno->complemento}}</li>
                        <li class="collection-item">CEP: {{$aluno->cep}}</li>
                        <li class="collection-item">Cidade: {{$aluno->cidade}}</li>
                        <li class="collection-item">Estado: {{$aluno->estado}}</li>
                        <li class="collection-item">País: {{$aluno->pais}}</li>
                    </ul>
                    <ul class="collection with-header col s12 m12 l12">
                        <li class="collection-header"><h4 class="center-align">Projetos</h4></li>
                    </ul>
                    @forelse($aluno->projeto as $projeto)
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
                                        @foreach($projeto->aluno as $aluno)
                                            <li class="collection-item">Aluno: {{$aluno->name}}</li>
                                        @endforeach
                                        @foreach($projeto->professor as $professor)
                                            <li class="collection-item">Professor: {{$professor->name}}
                                                - {{$professor->pivot->tipo}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @empty
                        <li class="collection-item"><span class="center-align">Aluno sem projeto</span></li>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>