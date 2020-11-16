@if(Auth::guest())

    <nav class="blue darken-4">
        <div class="nav-wrapper blue darken-4 container">
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <a href="{{route ('home')}}" class="brand-logo center">@if(isset($edicao->edicao)){{$edicao->edicao}} °@endif MOTIC</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="{{route('sobre') }}">Sobre</a></li>
                <li><a href="{{route('contato') }}">Contato</a></li>
                <li><a href="{{route('certificado.chancela.view') }}">Chancela Certificado</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
            @if(isset($nova_data) && isset($de) && isset($ate))
                @if(($nova_data >= $de)  && ($nova_data <= $ate))
                <li><a href='{{route ('cadastro.avaliadores.externo')}}'>Cadastro Avaliador</a></li>
                @endif
            @endif

                <li><a href="{{route ('regulamento')}}">Regulamento</a></li>
                <li><a href="{{route('login') }}">Login</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="{{route ('home')}}">Home</a></li>
                <li><a href="{{route('sobre') }}">Sobre</a></li>
                <li><a href="{{route('contato') }}">Contato</a></li>
                <li><a href="{{route ('regulamento')}}">Regulamento</a></li>
                <li><a href="{{route('certificado.chancela.view') }}">Chancela Certificado</a></li>
                @if(isset($nova_data) && isset($de) && isset($ate))
                    @if(($nova_data >= $de)  && ($nova_data <= $ate))
                    <li><a href='{{route ('cadastro.avaliadores.externo')}}'>Cadastro Avaliador</a></li>
                    @endif
                @endif
                <li><a href="{{route('login') }}">Login</a></li>
            </ul>
        </div>
    </nav>

@else
    <div class="navbar-fixed">
        <nav>
            <div class="blue darken-4">
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i
                                    class="material-icons">menu</i></a>
                        <div class="col s12">
                            @yield('breadcrumb')
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <ul class="side-nav fixed" id="mobile-demo">
        <li>
            <div class="user-view blue darken-4">
                <span class="white-text name">{{ Auth::user()->name }}</span>
                <span class="white-text email">{{ Auth::user()->email }}</span>
            </div>
            <img class='margem' src="{{url('images/motic-logo.png')}}" alt="motic" height="65" width="275">
        </li>
        @if(Auth::user()->tipoUser == 'admin')
            @include('admin.nav.nav')
        @elseif(Auth::user()->tipoUser == 'escola')
            @include('escola.nav.nav')
        @elseif(Auth::user()->tipoUser == 'professor')
            @include('professor.nav.nav')
        @elseif(Auth::user()->tipoUser == 'avaliador')
            @include('avaliador.nav.nav')
        @elseif(Auth::user()->tipoUser == 'votacaoPopular')
            @include('votacaoPopular.nav.nav')
        @elseif(Auth::user()->tipoUser == 'projetoSustentavel')
            @include('projetoSustentavel.nav.nav')
        @endif
    </ul>
@endif

