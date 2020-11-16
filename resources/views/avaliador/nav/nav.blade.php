<li class="white">
    <a class="collapsible-header" href="{{route ('avaliador')}}"><i class="small material-icons">home</i>Home</a>
</li>
@can('view', $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first())
<li class="white">
    <a class="collapsible-header" href="{{route ('avaliador.projeto')}}"><i class="small material-icons">library_add</i>Projetos</a>
</li>
@endcan
<?php
$verifica = App\InformacoesMotic::latest()->first();
$usuario = App\Chancela::where('avaliador_id', '=', Auth::user()->avaliador['id'])->first();
?>

    <li class="white">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">assignment</i>Certificados <i
                            class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul class="collapsible" data-collapsible="accordion">
                        @if(($verifica['libera_certificado'] == 1))                                 
                        <li><a class="waves-effect waves-blue" target="_blank" href="{{ route ('certificado.avaliador', Auth::user()->avaliador['id']) }}"><i class="material-icons">school</i>Gerar</a></li>
                        @endif
                        <li><a class="waves-effect waves-blue" href="{{ route ('tabela.certificado.avaliador', Auth::user()->avaliador['id']) }}"><i class="material-icons">library_books</i>Visualizar</a></li>                       
                        <li>
                            <div class="divider"></div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>

<li class="white">
    <a class="collapsible-header" href="{{route ('avaliador.config.alterar-senha')}}"><i class="small material-icons">lock</i>Alterar senha</a>
</li>
<li class="white">
    <a class="collapsible-header" href="{{route ('avaliador.edit')}}"><i class="small material-icons">people_outline</i>Dados Pessoais</a>
</li>
<li class="white">
    <a class="collapsible-header" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"> <i
                class="small material-icons">exit_to_app</i>Sair
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>
