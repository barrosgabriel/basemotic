<!DOCTYPE html>
<html>
<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/materialize.css')?>" type="text/css">


    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"
          media="screen,projection"/>
    <html lang="pt-BR">
    @if(Auth::guest())
        <link rel="stylesheet" href="<?php echo asset('css/home.css')?>" type="text/css">
    @else
        <link rel="stylesheet" href="<?php echo asset('css/motic.css')?>" type="text/css">
        <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/decoupled-document/ckeditor.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/decoupled-document/translations/pt-br.js"></script>
    @endif

 {{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" type="text/css">
	<style>

        #resultadoValidacao {
        position: absolute;
        top: 2em;
        left: 16em;
        }
	    ::-webkit-scrollbar {
            background-color: #fff;
            width: 14px
        }

        ::-webkit-scrollbar-track {
            -webkit-border-radius: 10px;
            background-color: #fff;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track:hover {
            border-radius: 10px;
            background-color: #f4f4f4
        }


        ::-webkit-scrollbar-thumb {
            background-color: #babac0;
            border-radius: 16px;
            border: 5px solid #fff
        }
        .pagination li.active {
            background-color: #0d47a1!important;
        }
        button.dt-button, div.dt-button, a.dt-button {
            position: relative;
            display: inline-block;
            padding: 10px 12px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #fff;
            background-color: #0D47A1;
            border-color: rgb(77, 135, 223);
        }

        .modal {

        border-radius: 15px!important;
        }
		
		.card-panel {

			border-radius: 20px!important;
		   
		}
	</style>

    <title>@yield('titulo')</title>
    </head>

<body class="grey lighten-2">

<header>
    @include('_layouts._nav')
</header>

<main>
    @yield('content')
</main>

<footer class="page-footer blue darken-4">
    <div class="container">
        <div class="row">
            <div class="col l9 s9 m9">
                <h5 class="white-text">Prefeitura Municipal de São Leopoldo</h5>
                <p class="grey-text text-lighten-4">Secretaria Municipal de Educação - SMED
                </p>
            </div>
            <div class="col l3 s3 m3">
                <h5 class="white-text">Redes Sociais</h5>
                <ul>
                    <li><a class="white-text" href="https://www.facebook.com/MOTICSAOLEO2018">Facebook MOTIC</a></li>
                    <li><a class="white-text" href="https://www.facebook.com/smedsaoleopoldo">Facebook SMED</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Desenvolvido pelo <a class="orange-text text-lighten-3" href="">Departamento de Desenvolvimento de Sistemas</a>
        </div>
    </div>
</footer>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

<script src="<?php echo asset('js/projeto_ajax.js')?>" type="text/javascript"></script>

<link rel="shortcut icon" href="{{ url('images/motic-faviconnn.ico') }}">


<script src="https://motic.saoleopoldo.rs.gov.br/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>




<input type="hidden" id="limiteProjetos" name="limiteProjetos" value="@if (isset($projeto->avaliadores)) {{3 - $projeto->avaliadores}}@else erro @endif">





<script type="text/javascript">

jQuery(document).ready(function(){
    jQuery('#cpf').mask("999.999.999-99");
    jQuery('#submit').click(function() {
        jQuery('#cpf').value = jQuery('#cpf').val().replace(/[^\d]+/g,'');
  });
});

jQuery(document).ready(function(){
    jQuery('#modalAviso').modal();
    jQuery(document).ready(function(){
    jQuery('#modalAviso').modal('open');
    });
});

             $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
			

		
	
		
            $(document).ready(function(){
	  
			   $('#projetos thead tr').clone(true).appendTo( '#projetos thead' );
				$('#projetos thead tr:eq(1) th').each( function (i) {
					var title = $(this).text();
					$(this).html( '<input type="text" placeholder="'+title+'" />' );
			 
					$( 'input', this ).on( 'keyup change', function () {
						if ( table.column(i).search() !== this.value ) {
							table
								.column(i)
								.search( this.value )
								.draw();
						}
					} );
				} );
		

				var table = $('#projetos').DataTable({
							orderCellsTop: true,
							fixedHeader: true,
							"bFilter": true,
							
							"info": false,
							"sLengthMenu": false,
							"bLengthChange": false,
								"oLanguage": {

									"sEmptyTable": "Nenhum registro encontrado",
									"sInfo": "Mostrando de START até END de TOTAL registros",
									"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
									"sInfoFiltered": "(Filtrados de MAX registros)",
									"sInfoPostFix": "",
									"sInfoThousands": ".",
									"sLengthMenu": "MENU resultados por página",
									"sLoadingRecords": "Carregando...",
									"sProcessing": "Processando...",
									"sZeroRecords": "Nenhum registro encontrado",
									"sSearch": "Pesquisar",
									"oPaginate": {
										"sNext": "Próximo",
										"sPrevious": "Anterior",
										"sFirst": "Primeiro",
										"sLast": "Último"
									},
									"oAria": {
										"sSortAscending": ": Ordenar colunas de forma ascendente",
										"sSortDescending": ": Ordenar colunas de forma descendente"
									}

								}
						});
				
		
					
			
				
            });




            $(document).ready(function(){
                $('#tabelaAvaliadores').DataTable({
                    "info": false,
                    "sLengthMenu": false,
                    "bLengthChange": false,
                        "oLanguage": {

                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de START até END de TOTAL registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de MAX registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "MENU resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Pesquisar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            }

                        }
                });
            });

            $(document).ready(function(){
                $('#auditoria').DataTable({
                    "info": false,
                    "sLengthMenu": false,
                    "bLengthChange": false,
                        "oLanguage": {

                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de START até END de TOTAL registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de MAX registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "MENU resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Pesquisar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            }

                        }
                });
            });





            $(document).ready(function(){
                $('#auditoriaUsuarios').DataTable({
                    "info": false,
                    "sLengthMenu": false,
                    "bLengthChange": false,
                        "oLanguage": {

                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de START até END de TOTAL registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de MAX registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "MENU resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Pesquisar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            }

                        }
                });
            });


            $(document).ready(function(){
                $('#tabelaChancela').DataTable({
                    "info": false,
                    "sLengthMenu": false,
                    "bLengthChange": false,
                        "oLanguage": {

                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de START até END de TOTAL registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de MAX registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "MENU resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Pesquisar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            }

                        }
                });
            });

                $(document).ready(function(){
                    $('#tabelaCategorias').DataTable({
                        "lengthMenu": [ [5], [5]],
                        dom: 'Bfrtip',
                        buttons: [{
                        extend: 'pdf',
                        pageSize: 'LEGAL',
                        
                        exportOptions: {
                              columns: [ 0, 1, 2, 3,4,5,6,7]
                        },
                        customize: function ( doc ) {
                                        // Splice the image in after the header, but before the table
                                        doc.content.splice( 1, 0, {
                                            margin: [ 0, 0, 0, 12 ],
                                            alignment: 'center',
                                            image: 'data:image/png;base64,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'
                                        } );

                        }}
                        , {
                            extend: 'excel',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                              columns: [ 0, 1, 2, 3,4,5,6,7]
                            }
                        }

                        ],
                         "rowReorder": {
                            selector: 'td:nth-child(2)'
                        },
                        "responsive": true,
                        "order": [ [ 6, 'desc' ],[ 1, 'desc' ] ,[ 2, 'desc' ],[ 3, 'desc' ],[4,'desc'],[5,'desc']],
                         "aoColumnDefs": [
                        { "bSortable": false, "aTargets": [ 0, 1, 2, 3,4,5,6,7] },
                        { "bSearchable": false, "aTargets": [ 0, 1, 2, 3,5,6,7] },
                        ],

                        "searching": false,
                        "info": true,
                        "bLengthChange": true,
                        "oLanguage": {

                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "_MENU_ resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Pesquisar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            }

                        }
                    });
                });

    $(document).ready(function () {
        $('input#input_text, textarea#textarea1').characterCounter();
    });

    $('.carousel.carousel-slider').carousel({fullWidth: true, indicators: true});

    $('.datepicker').on('mousedown',function(event){
        event.preventDefault();
    });

    $('.dropdown-button + .dropdown-content').on('click', function(event) {
    event.stopPropagation();
    });



    $('.selector').sideNav();

    $(document).ready(function () {
        $('#avaliadores').change(function (event) {


            var alunos = $('#avaliadores').val();
            var limite = $('#limiteProjetos').val();
            if (alunos.length == limite ) {
                $("#envia_avaliador").prop("disabled", false);
            } else if (alunos.length > 3) {
                $("#envia_avaliador").prop("disabled", true);
                alert("Selecione no máximo 3 avaliadores");
            } else {
                $("#envia_avaliador").prop("disabled", true);
            }
        });
    });

    eval(function (p, a, c, k, e, r) {
        e = function (c) {
            return c.toString(a)
        };
        if (!''.replace(/^/, String)) {
            while (c--) r[e(c)] = k[c] || e(c);
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(b).9(\'d\',\'#f\',h(){$(\'#4\').1(\'\');$(\'#4\').2($(3).0(\'a\'));$(\'#5\').1(\'\');$(\'#5\').2($(3).0(\'c\'));$(\'#6\').1(\'\');$(\'#6\').2($(3).0(\'e\'));$(\'#7\').1(\'\');$(\'#7\').2($(3).0(\'g\'));$(\'#8\').1(\'\');$(\'#8\').2($(3).0(\'i\'))});', 19, 19, 'data|html|append|this|id_auditoria|tipo_auditoria|descricao_auditoria|usuario_auditoria|responsavel_auditoria|on|id|document|tipo|click|descricao|auditoria|user_id|function|nome_usuario'.split('|'), 0, {}))

    eval(function (p, a, c, k, e, r) {
        e = function (c) {
            return c.toString(a)
        };
        if (!''.replace(/^/, String)) {
            while (c--) r[e(c)] = k[c] || e(c);
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(e).7(\'d\',\'.9-8\',5(){$(\'#6\').0($(2).1(\'a\'));$(\'#b\').0($(2).1(\'c\'));$(\'#4\').0($(2).1(\'4\'));$(\'#3\').0($(2).1(\'3\'))});', 15, 15, 'val|data|this|tipo|projeto|function|id_delete|on|trigger|modal|id|name_delete|name|click|document'.split('|'), 0, {}))
    $('.modal-footer').on('click', '.delete', function () {
        id = $('#id_delete').val().replace(/\D/g, '');
        projeto = $('#projeto').val();
        tipo = $('#tipo').val();
        // console.log(id);
        if (tipo == 'escola') {
            $.ajax({
                type: 'GET',
                url: 'escola/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        } else if (tipo == 'projeto') {
            $.ajax({
                type: 'GET',
                url: 'projeto/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        } else if (tipo == 'aluno') {
            $.ajax({
                type: 'GET',
                url: 'aluno/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        } else if (tipo == 'professor') {
            $.ajax({
                type: 'GET',
                url: 'professor/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        } else if (tipo == 'suplente') {
            $.ajax({
                type: 'GET',
                url: 'projeto/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        } else if (tipo == 'avaliador') {
            $.ajax({
                type: 'GET',
                url: 'avaliador/avaliador/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        } else if (tipo == 'user') {
            $.ajax({
                type: 'GET',
                url: 'user/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        } else if (tipo == 'disciplina') {
            $.ajax({
                type: 'GET',
                url: 'disciplina/destroy/' + id,
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    $(document).ready(function () {
        $(".button-collapse").sideNav();
    });

    eval(function (p, a, c, k, e, r) {
        e = function (c) {
            return c.toString(a)
        };
        if (!''.replace(/^/, String)) {
            while (c--) r[e(c)] = k[c] || e(c);
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(f).b(5(){$(\'#0\').g(5(a){c 0=$(\'#0\').d();6(0.7==3){$("#1").2("4",e)}8 6(0.7>3){$("#1").2("4",9);h("i j kál 3 0")}8{$("#1").2("4",9)}})});', 22, 22, 'alunos|envia|prop||disabled|function|if|length|else|true|event|ready|var|val|false|document|change|alert|Selecione|no|m|ximo'.split('|'), 0, {}))

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(1).2(3(){$(\'4.0\').0({5:6})});', 7, 7, 'tabs|document|ready|function|ul|swipeable|true'.split('|'), 0, {}))

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(1).2(3(){$(\'.0\').0()});', 4, 4, 'sidenav|document|ready|function'.split('|'), 0, {}))

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(0).1(2(){$(\'.3\').4({5:6})});', 7, 7, 'document|ready|function|tooltipped|tooltip|delay|50'.split('|'), 0, {}))

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(0).1(2(){$(\'3\').4()});', 5, 5, 'document|ready|function|select|material_select'.split('|'), 0, {}))

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(1).2(3(){$(\'.0\').0()});', 4, 4, 'modal|document|ready|function'.split('|'), 0, {}))

    @yield('modal')

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(".0-1").0();', 2, 2, 'dropdown|button'.split('|'), 0, {}))

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(".0-1").2();', 3, 3, 'button|collapse|sideNav'.split('|'), 0, {}))

    $('.datepicker').pickadate({
        monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
        weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        today: 'Hoje',
        clear: 'Limpar',
        close: 'Pronto',
        labelMonthNext: 'Próximo mês',
        labelMonthPrev: 'Mês anterior',
        labelMonthSelect: 'Selecione um mês',
        labelYearSelect: 'Selecione um ano',
        selectMonths: true,
        selectYears: 150,
        max: undefined,
        format: 'dd-mm-yyyy'
    });

    $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Limpar', // text for clear-button
        canceltext: 'Cancelar', // Text for cancel-button
        container: undefined, // ex. 'body' will append picker to body
        autoclose: false, // automatic close timepicker
        ampmclickable: false, // make AM PM clickable
        aftershow: function () {
        } //Function for after opening timepicker
    });

    eval(function (p, a, c, k, e, r) {
        e = String;
        if (!''.replace(/^/, String)) {
            while (c--) r[c] = k[c] || c;
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('$(0).1(2(){$(\'.3-4\').5()});', 6, 6, 'document|ready|function|modal|trigger|leanModal'.split('|'), 0, {}))

</script>

@if(isset($cpfCadastrado))
    @includeIf('_layouts._modal-resetarSenha')
@endif

</body>

</html>
