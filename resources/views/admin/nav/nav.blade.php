<li class="white">
    <a class="collapsible-header" href="{{route ('admin')}}"><i class="small material-icons">home</i>Home</a>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">book
                </i>Avaliação <i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliacao.classificacao')}}"><i
                                    class="material-icons">list</i>Classificação</a>
                    </li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliacao.classificacao-popular')}}"><i
                                    class="material-icons">list</i>Classificação popular</a>
                    </li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.projetoSustentavel.classificacao')}}"><i
                        class="material-icons">list</i>Classif. projeto sustentável</a>
                    </li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliacao.projetos-avaliados')}}"><i
                                    class="material-icons">bookmark</i>Projetos avaliados</a></li>
                    <li><a class="waves-effect waves-blue"
                           href="{{route ('admin.avaliacao.projetos-nao-avaliados')}}"><i
                                    class="material-icons">bookmark_border</i>Projetos não avaliados</a></li>
                    <li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliacao.calcular-notas')}}"><i
                                    class="material-icons">stars</i>Calcular notas</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">person</i>Alunos <i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.aluno')}}"><i class="material-icons">list</i>Listar
                            alunos</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.aluno.create')}}"><i
                                    class="material-icons">add</i>Cadastrar aluno</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.aluno.relatorios')}}"><i
                                    class="material-icons">chrome_reader_mode</i>Relatórios</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i
                        class="small material-icons">format_list_bulleted</i>Auditoria <i class="material-icons right"
                                                                                          style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.auditoria')}}"><i
                                    class="material-icons">list</i>Listar auditorias</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.auditoria.usuarios')}}"><i
                                    class="material-icons">list</i>Login de Usuários</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.auditoria.usuarios-nao-logados')}}"><i
                                    class="material-icons">list</i>Usuários não logados</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.auditoria.relatorios')}}"><i
                                    class="material-icons">chrome_reader_mode</i>Relatórios</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">contacts</i>Avaliadores
                <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliador')}}"><i
                        class="material-icons">list</i>Listar avaliadores ativos</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.valida.avaliadores')}}"><i
                                    class="material-icons">list</i>Validar avaliadores</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliador.create')}}"><i
                                    class="material-icons">add</i>Cadastrar avaliador</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliador.relatorios')}}"><i
                                    class="material-icons">chrome_reader_mode</i>Relatórios</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<?php
$verifica = App\InformacoesMotic::latest()->first();
?>

<li class="white">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">assignment</i>Certificados <i
                            class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li><a class="collapsible-header waves-effect waves-blue"><i class="material-icons">person</i>Alunos<i
                            class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a class="waves-effect waves-blue" href="{{route ('admin.aluno.tabelaCertificado') }}"><i class="material-icons">school</i>Gerar</a></li>
                                    <li><a class="waves-effect waves-blue" href="{{ route ('tabela.certificado.aluno') }}"><i class="material-icons">library_books</i>Visualizar</a></li>
                                </ul>              
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect waves-blue"><i
                                        class="material-icons">person</i>Orientadores<i
                                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a class="waves-effect waves-blue" href="{{route ('admin.professor.tabelaCertificadoOrientadores')}}"><i class="material-icons">school</i>Gerar</a></li>
                                    <li><a class="waves-effect waves-blue" href="{{route ('tabela.certificado.orientador')}}"><i class="material-icons">library_books</i>Visualizar</a></li>
                                </ul>                               
                            </div>                                   
                        </li>
                        <li><a class="collapsible-header waves-effect waves-blue"><i
                                        class="material-icons">person</i>Coorientadores<i
                                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a class="waves-effect waves-blue" href="{{route ('admin.professor.tabelaCertificadoCoorientadores')}}"><i class="material-icons">school</i>Gerar</a></li>
                                    <li><a class="waves-effect waves-blue" href="{{route ('tabela.certificado.coorientador')}}"><i class="material-icons">library_books</i>Visualizar</a></li>
                                </ul>                               
                            </div>                                  
                        </li>
                        <li><a class="collapsible-header waves-effect waves-blue"><i
                                        class="material-icons">person</i>Avaliadores<i
                                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a class="waves-effect waves-blue" href="{{route ('admin.avaliador.tabelaCertificado')}}"><i class="material-icons">school</i>Gerar</a></li>
                                    <li><a class="waves-effect waves-blue" href="{{route ('tabela.certificado.avaliador') }}"><i class="material-icons">library_books</i>Visualizar</a></li>
                                </ul>                               
                            </div>    
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>

<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">note</i>Disciplinas <i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.disciplina')}}"><i
                                    class="material-icons">list</i>Listar disciplinas</a></li>
                    <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">school</i>Escolas <i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.escola')}}"><i class="material-icons">list</i>Listar
                            escolas</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.escola.create')}}"><i
                                    class="material-icons">add</i>Cadastrar escola</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.escola.relatorios')}}"><i
                                    class="material-icons">chrome_reader_mode</i>Relatórios</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">person</i>Professores
                <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.professor')}}"><i
                                    class="material-icons">list</i>Listar professores</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.professor.create')}}"><i
                                    class="material-icons">add</i>Cadastrar professor</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.professor.relatorios')}}"><i
                                    class="material-icons">chrome_reader_mode</i>Relatórios</a>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">library_add</i>Projetos
                <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.projeto')}}"><i class="material-icons">list</i>Listar
                            projetos</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.projeto.create')}}"><i
                                    class="material-icons">add</i>Cadastrar projetos</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.projeto.relatorios')}}"><i
                                    class="material-icons">chrome_reader_mode</i>Relatórios</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">library_add</i>Suplentes<i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.suplente')}}"><i
                                    class="material-icons">list</i>Listar suplentes</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.suplente.create')}}"><i
                                    class="material-icons">add</i>Cadastrar suplentes</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.suplente.relatorios')}}"><i
                                    class="material-icons">chrome_reader_mode</i>Relatórios</a>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>



<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">settings</i>Configurações<i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                     <li><a class="waves-effect waves-blue" href="{{route ('admin.config.inscricoesAvaliadores')}}"><i
                                    class="material-icons">access_time</i>Período de cad. avaliadores </a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.inscricoes')}}"><i
                                    class="material-icons">access_time</i>Período de inscrições</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.avaliacoes')}}"><i
                                    class="material-icons">access_time</i>Período de avaliações</a></li>
                    <li>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.desativarAvaliadores')}}"><i
                                class="material-icons">block</i>Desativar avaliadores</a></li>

                    {{-- novo --}}
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.liberarCertificados')}}"><i
                                class="material-icons">card_membership</i>Gerenciar certificados</a></li>

                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.limites')}}"><i
                                    class="material-icons">confirmation_number</i>Limite de projetos</a></li>

                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.pdf')}}"><i
                                    class="material-icons">insert_drive_file</i>PDF's</a></li>

                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.gerencia.pagina-inicial')}}"><i
                                    class="material-icons">perm_media</i>Gerenciar home-page</a></li>

                    <li><a class="waves-effect waves-blue" href="{{route ('admin.config.edicao')}}"><i
                                class="material-icons">build</i>Gerenciar edição</a></li>
                    <li><a class="waves-effect waves-blue" href="{{route ('criaAviso.view')}}"><i
                        class="material-icons">chrome_reader_mode
                    </i>Criar aviso</a></li>

                    <li><a class="waves-effect waves-blue" href="{{url ('admin/config/alterar-senha')}}"><i
                                    class="material-icons">lock_outline</i>Mudar senha</a></li>
                    <div class="divider"></div>
                    </li>
                    <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">note</i>Categorias <i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.categoria')}}"><i
                                    class="material-icons">list</i>Listar categorias</a></li>
                    <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">note</i>Etapas <i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route ('admin.etapa')}}"><i
                                    class="material-icons">list</i>Listar etapas</a></li>
                    <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">people</i>Usuários<i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="waves-effect waves-blue" href="{{route('admin.user')}}"><i
                                    class="material-icons">people_outline</i>Gerenciar usuários</a></li>
                    <div class="divider"></div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li class="white">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">info</i>Votação Popular<i
                            class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a class="waves-effect waves-blue" href="{{url('/votacaoPopular/cadastro')}}"><i
                                        class="material-icons">plus_one
                                </i>Cadastrar Usuário</a></li>

                    </ul>
                </div>
            </li>
        </ul>
</li>
<li class="white">
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">info</i>Projeto Sustentável<i
                        class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                  <li><a class="waves-effect waves-blue" href="{{route('projetoSustentavel.cadastroUsuario')}}"><i
                                    class="material-icons">plus_one
                            </i>Cadastrar Usuário</a></li>


                </ul>
            </div>
        </li>
    </ul>
</li>


@if(Illuminate\Support\Facades\Auth::user()->id == 1)
    <li class="white">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header waves-effect waves-blue"><i class="small material-icons">info</i>Info. do
                    Sistema<i
                            class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a class="waves-effect waves-blue" target="_blank" href="{{url('admin/logs')}}"><i
                                        class="material-icons">info_outline
                                </i>Logs</a></li>
                        <li><a class="waves-effect waves-blue" target="_blank" href="{{url('admin/decomposer')}}"><i
                                        class="material-icons">info_outline
                                </i>Decomposer</a></li>
                        <div class="divider"></div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
@endif
<li class="white">
    <a class="collapsible-header" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"> <i
                class="small material-icons">exit_to_app</i>Sair
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>
