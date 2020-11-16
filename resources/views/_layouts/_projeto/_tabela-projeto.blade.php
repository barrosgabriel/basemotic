<table class="centered responsive-table highlight bordered" id="projetos">
    <thead>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Categoria</th>
        <th>Tipo</th>

        @if(Auth::user()->tipoUser == 'admin')
        <th>Escola</th>
        <th>Avaliadores</th>
        @endif
        <th>Ações</th>
        <th>Ano</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($projetos as $projeto)
        <tr>
            <td>{{$projeto->id}}</td>
            <td>{{str_limit($projeto->titulo,30)}}</td>
            <td>{{$projeto->categoria->categoria}}</td>
            <td>{{$projeto->tipo}}</td>
            @if(Auth::user()->tipoUser == 'admin')
            <td>{{$projeto->escola->name}}</td>
            <td>{{$projeto->avaliadores}}</td>
            @endif
            <td>
                @can('view', $inscricao = \App\Inscricao::orderBy('id', 'desc')->first())
                <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Editar" href=@if(Auth::user()->tipoUser == 'escola') "{{ route('escola.projeto.edit', $projeto->id) }}">
                    @elseif(Auth::user()->tipoUser == 'admin') "{{ route('admin.projeto.edit', $projeto->id) }}">@endif<i
                            class="small material-icons">edit</i></a>
                <a data-target="modal1" class="modal-trigger tooltipped" data-position="top"
                   data-delay="50" data-tooltip="Deletar" href="#modal1" data-id="{{$projeto->id}}"
                   data-name="{{$projeto->titulo}}" data-projeto="normal" data-tipo="projeto"> <i
                            class="small material-icons">delete</i></a>
                @endcan
                <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Visualizar"
                   href=@if(Auth::user()->tipoUser == 'escola') "{{ route('escola.projeto.show', $projeto->id) }}">
                    @elseif(Auth::user()->tipoUser == 'admin') "{{ route('admin.projeto.show', $projeto->id) }}">@endif <i
                            class="small material-icons">library_books</i></a>
                @if(Auth::user()->tipoUser == 'admin')
                        @if($projeto->ano == date('Y'))
                            <a class="tooltipped" data-position="top" data-delay="50"
                           data-tooltip="Rebaixar a projeto suplente"
                           href="{{ route("admin.projeto.rebaixa", $projeto->id) }}"> <i
                                    class="small material-icons">arrow_downward</i></a>
                                    @if($projeto->avaliadores < 3 && $projeto->tipoEscola != 'estadual' && $projeto->tipoEscola != 'privada')
                                <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Vincular avaliadores"
                                   href="{{route ('admin.projeto.vincular-avaliadores', $projeto->id)}}"> <i class="small material-icons">stars</i></a>
                            @endif
                        @endif
                @endif
            </td>

            <td>{{$projeto->ano}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7">Nenhum registro encontrado</td>
        </tr>
    @endforelse
    </tbody>
</table>
{{--  {{ $projetos->appends(request()->input())->links() }}  --}}
