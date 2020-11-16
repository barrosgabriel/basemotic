
<table class="centered responsive-table highlight bordered">

    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Usuário</th>
        <th>CPF</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($avaliadores as $avaliador)
        <tr>
            <td>{{$avaliador->id}}</td>
            <td>{{$avaliador->name}}</td>
            <td>@if(isset($avaliador->username)) {{$avaliador->username}} @else {{$avaliador->user->username}} @endif</td>
            <td>@if(isset($avaliador->avaliador->cpf)) {{$avaliador->avaliador->cpf}} @else {{$avaliador->cpf}}@endif</td>
            <td>

            <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Liberar Avaliador"
            href="{{route ('admin.valida.avaliadores.liberar', $avaliador->id)}}"> <i
                     class="small material-icons">stars</i></a>
         {{--   modal libera Avalaidor   --}}
           {{--  <a data-target="modal1" class="modal-trigger tooltipped" data-position="top" data-delay="50" data-position="top" data-delay="50" data-tooltip="Liberar Avaliador"
                   href="#modalAvaliador"  data-name="@if(isset($avaliador->avaliador->name)){{$avaliador->avaliador->name}}@else {{$avaliador->name}} @endif"> <i class="small material-icons">stars</i></a>

                   <div id="modalAvaliador" class="modal">
                        <div class="modal-content">
                            <h4 align="center">Aviso</h4>
                        <h5 align="center">Confirmação de liberação do avaliador para edição {{date('Y')}}</h5>
                            <div class="row">
                                <label for="name_delete">Nome:</label>
                                <div class="input-field col s12">
                                        <input disabled class="validate" type="text" id="name_delete">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <a class="btn blue" onclick="$('.modal').modal('close');">Não</a>
                            <a id="liberarAvaliador" class="btn blue" href="{{route ('admin.valida.avaliadores.liberar', $avaliador->id)}}">Liberar</a>
                        </div>

                    </div>  --}}

            {{--   modal libera Avalaidor   --}}

                <a data-target="modal1" class="modal-trigger tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Deletar" href="#modal1" data-id="@if(isset($avaliador->avaliador->id)) {{$avaliador->avaliador->id}} @else {{$avaliador->id}} @endif"
                   data-name="@if(isset($avaliador->avaliador->name)){{$avaliador->avaliador->name}}@else {{$avaliador->name}} @endif" data-tipo="avaliador"> <i
                            class="small material-icons">delete</i></a>

                  <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Visualizar"
                   href="@if(isset($avaliador->avaliador->id)) {{route("admin.avaliador.show", $avaliador->avaliador->id)}} @else {{route("admin.avaliador.show", $avaliador->id)}} @endif"> <i
                            class="small material-icons">library_books</i></a>


            </td>
        </tr>
    @empty
        <tr>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
            <td>Nenhum registro encontrado</td>
        </tr>
    @endforelse
    </tbody>
</table>
 {{ $avaliadores->appends(request()->input())->links() }}

