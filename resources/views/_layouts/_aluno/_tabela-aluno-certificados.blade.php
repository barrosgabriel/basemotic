<table class="centered responsive-table highlight bordered" id="tabelaAvaliadores">

    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ano/Etapa</th>
        @if(Auth::user()->tipoUser == 'admin')
            <th>Escola</th>
        @endif
        <th>Turma</th>
        <th>Projeto</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($alunos as $aluno)


        <tr>
            <td>{{$aluno->id}}</td>
            <td>{{$aluno->name}}</td>
            <td>{{$aluno->etapa}}</td>

            @if(Auth::user()->tipoUser == 'admin')
                <td>{{$aluno->escola->name}}</td>
            @endif
            <td>{{$aluno->turma}}</td>
            <td>
                @forelse($aluno->projeto as $projeto)
                    @if($projeto->ano == date('Y'))
                        {{$projeto->titulo}}
                    @endif
                @empty
                    Aluno sem projeto
                @endforelse
            </td>
            <td width="20%">
                @can('view', $inscricao = \App\Inscricao::orderBy('id', 'desc')->first())
                @endcan

                @if ($aluno ->nCertificadosGerados == 0)

                <a class="tooltipped" target="_blank" data-position="top" data-delay="50" data-tooltip="Gerar certificado"
                   href=@if(Auth::user()->tipoUser == 'escola') "{{ route('certificado.aluno', $aluno->id) }}">
                    @elseif(Auth::user()->tipoUser == 'admin') "{{ route('certificado.aluno', $aluno->id) }}">@endif
                    <i class="small material-icons">school</i></a>
                @else 
                <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Certificado já gerado">
                 <i class="small material-icons">block</i></a>
                @endif
                
            </td>
        </tr>



    @empty
        <tr>
            <td colspan="7">Nenhum registro encontrado</td>
        </tr>

    @endforelse
    </tbody>
</table>
