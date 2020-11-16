<table class="centered responsive-table highlight bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Evento</th>
        <th>Descricao</th>
        <th>Tipo</th>
        <th>Responsável</th>
        <th>Data/hora</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($auditorias as $auditoria)
        <tr>
            <td>{{$auditoria->id}}</td>
            <td>{{$auditoria->event}}</td>
            <td>
                @if($auditoria->new_values == '[]')
                    @if(starts_with($auditoria->old_values, '{"password"') || starts_with($auditoria->old_values, '{"remember_token"'))
                        {{ str_limit(str_replace(',',', ', $auditoria->old_values), 30) }}
                    @else{{ str_limit(str_replace(',',', ', $auditoria->old_values), 125) }}
                    @endif
                @else
                    @if(starts_with($auditoria->new_values, '{"password"') || starts_with($auditoria->old_values, '{"remember_token"'))
                        {{str_limit(str_replace(',',', ', $auditoria->new_values), 30)}}
                    @else{{ str_limit(str_replace(',',', ', $auditoria->new_values), 125) }}
                    @endif
                @endif</td>
            <td>{{$auditoria->auditable_type}}</td>
            <td>@if($auditoria->user_id == null) @else 
                @if (isset(\App\User::find($auditoria->user_id)->username)) 
                {{\App\User::find($auditoria->user_id)->username}} 
                @endif @endif</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($auditoria->created_at)) }}</td>
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
{{ $auditorias->appends(request()->input())->links() }}

