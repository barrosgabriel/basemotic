<table class="centered responsive-table highlight bordered">

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
                        @isset($projeto->titulo)
                        {{$projeto->titulo}}

                        @endisset

                    @endif
                @empty
                    Aluno sem projeto
                @endforelse
            </td>
            <td width="20%">
                @can('view', $inscricao = \App\Inscricao::orderBy('id', 'desc')->first())
                    <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                       data-tooltip="Editar"
                       href=@if(Auth::user()->tipoUser == 'escola') "{{ route('escola.aluno.edit', $aluno->id) }}">
                        @elseif(Auth::user()->tipoUser == 'admin') "{{ route('admin.aluno.edit', $aluno->id) }}
                        ">@endif<i class="small material-icons">edit</i></a>
                    <a data-target="modal1" class="modal-trigger tooltipped" data-position="top" data-delay="50"
                       data-tooltip="Deletar" href="#modal1" data-id="{{$aluno->id}}"
                       data-name="{{$aluno->name}}" data-tipo="aluno"> <i
                                class="small material-icons">delete</i></a>
                @endcan
                <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Visualizar"
                   href=@if(Auth::user()->tipoUser == 'escola') "{{ route('escola.aluno.show', $aluno->id) }}">
                    @elseif(Auth::user()->tipoUser == 'admin') "{{ route('admin.aluno.show', $aluno->id) }}">@endif
                    <i class="small material-icons">library_books</i></a>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">Nenhum registro encontrado</td>
        </tr>
    @endforelse
    </tbody>
</table>
{{ $alunos->appends(request()->input())->links() }}
