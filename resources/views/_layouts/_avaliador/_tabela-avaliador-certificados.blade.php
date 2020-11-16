<table class="centered responsive-table highlight bordered" id="tabelaAvaliadores">

    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($avaliadores as $avaliador)
        <tr>

         @if($avaliador->user->ativo == 1)

            <td>{{$avaliador->id}}</td>
            <td>{{$avaliador->user->name}}</td>
            <td>{{$avaliador->user->username}}</td>
            <td>
		@if($avaliador->nCertificadosGerados == "1")
			<a class="tooltipped" target="_blank" data-position="top" data-delay="50" data-tooltip="Certificado Gerado"><i class="small material-icons">block</i></a>
		@else
                  	<a class="tooltipped" target="_blank" data-position="top" data-delay="50" data-tooltip="Certificado"
                   		href=@if(Auth::user()->tipoUser == 'escola') "{{ route('certificado.avaliador', $avaliador->id) }}">
                @elseif(Auth::user()->tipoUser == 'admin') "{{ route('certificado.avaliador', $avaliador->id) }}">@endif
                	<i class="small material-icons">school</i></a>
		@endif
            </td>
        </tr>

        @endif
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
{{--  {{ $avaliadores->appends(request()->input())->links() }}  --}}



