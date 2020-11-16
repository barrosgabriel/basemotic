<table class="centered responsive-table highlight bordered" id="tabelaAvaliadores">

    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Última Participação</th>
        <th>Tipo</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
        @forelse ($professores as $professor)
        <?php
            $count = count($professor->projeto);
        ?>
        @foreach ($professor->projeto as $projeto)
        @if ($projeto->pivot->tipo == 'coorientador')
            <tr>
                <td>{{$professor->id}}</td>
                <td>{{$professor->name}}</td>
                <td>{{$professor->user->username}}</td>
                <td>{{$professor->projeto[$count-1]->ano}}</td>
                <td>{{$projeto->pivot->tipo}}</td>
                <td>

                @if ($professor ->nCertificadosGeradosCoorientador == 0)
                <a class="tooltipped" target="_blank" data-position="top" data-delay="50" data-tooltip="Certificado"
                href=@if(Auth::user()->tipoUser == 'escola') "{{ route('certificado.professor.coorientador', $professor->id) }}">
                 @elseif(Auth::user()->tipoUser == 'admin') "{{ route('certificado.professor.coorientador', $professor->id) }}">@endif
                 <i class="small material-icons">school</i></a>
                 @else
                 <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Certificado já gerado">
                    <i class="small material-icons">block</i></a>
                @endif
                </tr>
               @php  break; @endphp
               @endif
            @endforeach
        @endforeach

    </tbody>
</table>

