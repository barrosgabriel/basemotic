
<li class="white">
    <a class="collapsible-header" href="{{route ('votacaoPopular.home')}}"><i class="small material-icons">library_add</i>Votação Popular</a>
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
