@includeIf('_layouts._mensagem-erro')
@if(Session::get('mensagem'))
    @include('_layouts._mensagem-sucesso')
@endif

<div class="container">

    <div class="col s12 m12 l12">
        <div class="card-panel hoverable">
            <div class="row">
                <div class="card-content">
                    <ul class="collection with-header col s12 m12 l12">
                        <li class="collection-item">Escola: {{$projeto->escola->name}}</li>
                        <li class="collection-item">Título: {{$projeto->titulo}}</li>
                        <li class="collection-item">Área: {{$projeto->area}}</li>
                        <li class="collection-item">Resumo: {{$projeto->resumo}}</li>
                        <li class="collection-item">Objetivo: {{$projeto->objetivo}}</li>
                        <li class="collection-item">Metodologia: {{$projeto->metodologia}}</li>
                        <li class="collection-item">Recurso: {{$projeto->recurso}}</li>
                        <li class="collection-item">Avaliação: {{$projeto->avaliacao}}</li>
                        <li class="collection-item">
                            Disciplinas: @foreach($projeto->disciplina as $disciplina) {{$disciplina->name.", "}}@endforeach</li>
                    </ul>
                    <ul class="collection with-header col s12 m12 l6">
                        <li class="collection-header"><h4 class="center-align">Alunos</h4></li>
                        @foreach($projeto->aluno as $aluno)
                        <li class="collection-item">Aluno: {{$aluno->name}}</li>
                        <li class="collection-item">Ano/Etapa: {{$aluno->pivot->etapa_projeto}}</li>
                    @endforeach
                    </ul>
                    <ul class="collection with-header col s12 m12 l6">
                        <li class="collection-header"><h4 class="center-align">Professores</h4></li>
                        @foreach($projeto->professor as $professor)
                            <li class="collection-item">Professor: {{$professor->name}} - {{$professor->pivot->tipo}}</li>
                        @endforeach
                    </ul>
                    @if(Auth::user()->tipoUser == 'admin')
                        <ul class="collection with-header col s12 m12 l12">
                            <li class="collection-header"><h4 class="center-align">Avaliadores</h4></li>                     
                            @forelse($projeto->avaliador as $avaliador)         
                                <li class="collection-item">Avaliador: {{$avaliador->name}}</li>
                            @empty
                                <li class="collection-item">Projeto sem avaliadores</li>
                            @endforelse
                        </ul>
                    @endif
                    <ul class="collection with-header col s12 m12 l12">
                        <li class="collection-header"><h4 class="center-align">Notas</h4></li>
                        <table class="centered responsive-table highlight bordered">
                            <thead>
                            <tr>
                                <th>Pensamento Científico</th>
                                <th>Relevância Científica</th>
                                <th>Registro da Pesquisa</th>
                                <th>Clareza e Habilidade</th>
                                <th>Capacidade Criativa</th>
                                <th>Nota Final</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @php
                                    $notaUm = 0;
                                    $notaDois = 0;
                                    $notaTres = 0;
                                    $notaQuatro = 0;
                                    $notaCinco = 0;
                                    foreach($projeto->nota as $nota){
                                        $notaUm += $nota->notaUm;
                                        $notaDois += $nota->notaDois;
                                        $notaTres += ($nota->notaTres + $nota->notaQuatro);
                                        $notaQuatro += ($nota->notaCinco + $nota->notaSeis);
                                        $notaCinco += $nota->notaSete;
                                    }
                                @endphp
                                <td>{{$notaUm}} pontos</td>
                                <td>{{$notaDois}} pontos</td>
                                <td>{{$notaTres}} pontos</td>
                                <td>{{$notaQuatro}} pontos</td>
                                <td>{{$notaCinco}} pontos</td>
                                <td>{{$projeto->notaFinal}} pontos</td>
                            </tr>
                            </tbody>
                        </table>
                        @php $i = 0 @endphp
                        @foreach($projeto->nota as $nota)
                            @php $i++@endphp
                            <li class="collection-item">Observação {{$i}}: {{$nota->observacoes}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
