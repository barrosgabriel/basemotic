<table class="centered responsive-table highlight bordered">

    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Usuário</th>
        @if(Auth::user()->tipoUser == 'admin')
            <th>Escola</th>
        @endif
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($professores as $professor)
        <tr>
            <td>{{$professor->id}}</td>
            <td>{{$professor->name}}</td>
            <td>{{$professor->user->username}}</td>
            @if(Auth::user()->tipoUser == 'admin')
                <td>
                    @foreach($professor->escola as $escola)
                        {{$escola->name}}<br>
                    @endforeach
                </td>
            @endif
            <td>
                @can('view', $inscricao = \App\Inscricao::orderBy('id', 'desc')->first())
                    <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                       data-tooltip="Editar"
                       href=@if(Auth::user()->tipoUser == 'escola') "{{ route('escola.professor.edit', $professor->id) }}">
                        @elseif(Auth::user()->tipoUser == 'admin')
                            "{{ route('admin.professor.edit', $professor->id) }}">@endif<i
                                class="small material-icons">edit</i></a>
                    <a data-target="modal1" class="modal-trigger tooltipped" data-position="top" data-delay="50"
                       data-tooltip="Deletar" href="#modal1" data-id="{{$professor->id}}"
                       data-name="{{$professor->name}}" data-tipo="professor"> <i
                                class="small material-icons">delete</i></a>
                @endcan
                <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Visualizar"
                   href=@if(Auth::user()->tipoUser == 'escola') "{{ route('escola.professor.show', $professor->id) }}">
                    @elseif(Auth::user()->tipoUser == 'admin')
                        "{{ route('admin.professor.show', $professor->id) }}">@endif <i
                            class="small material-icons">library_books</i></a>
{{--
                <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Certificado"
                            href="{{route ('certificado.professor', $professor->id)}}"> <i
                                     class="small material-icons">school</i></a> --}}
            </td>
        </tr>

    @empty
        <tr>
            <td colspan="7">Nenhum registro encontrado</td>
        </tr>
    @endforelse
    </tbody>
</table>
{{ $professores->appends(request()->input())->links() }}
