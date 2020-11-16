<table class="centered responsive-table highlight bordered" id="tabelaChancela">

        <thead>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            @if(isset($temEscola))
                <th>Escola</th>
            @endif
            <th>Ano</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
    
            @foreach ($usuarios as $usuario)
                
    
            <tr>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->tipo}}</td>
                @if(isset($temEscola))
                    <td>{{$usuario->escola}}</td>
                @endif
                <td>{{$usuario->ano}}</td>
                <td width="20%">
      
                    <a class="tooltipped" target="_blank" data-position="top" data-delay="50" data-tooltip="Visualizar certificado"
                       href="{{ route('certificado.chancela.validarInterno', $usuario->chancela) }}">
                        <i class="small material-icons">library_books</i></a>
    
                </td>
            </tr>
    
    
    
            
            @endforeach

        </tbody>
    </table>
    