<table class="centered responsive-table highlight bordered">

    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Usuário</th>
        <th>E-mail</th>
        <th>Tipo usuário</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{str_limit($user->email, 25)}}</td>
            <td>{{$user->tipoUser}}</td>
            <td width="20%">
                <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Editar" href="{{ route("admin.user.edit", $user->id) }}"><i
                            class="small material-icons">edit</i></a>
                @if(Illuminate\Support\Facades\Auth::user()->id == 1)
                    <a data-target="modal1" class="modal-trigger tooltipped" data-position="top" data-delay="50"
                       data-tooltip="Deletar" href="#modal1" data-id="{{$user->id}}"
                       data-name="{{$user->name}}" data-tipo="user"> <i
                                class="small material-icons">delete</i></a>
                @endif
                @if(!($user->id == 1))
                <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Resetar senha: 123456"
                       href="{{ route("admin.user.mudar-senha", $user->id) }}"> <i
                                class="small material-icons">lock</i></a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
        </tr>
    @endforelse
    </tbody>
</table>
{{ $users->appends(request()->input())->links() }}
