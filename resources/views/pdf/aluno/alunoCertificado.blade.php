<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{$aluno->name}}</title>

    <style>


        div.page_break + div.page_break{
            page-break-before: always;

        }
        .page { width: 100%; height: 100%; }
        .signature,
        .title {
            float: left;
            border-top: 1px solid #000;
            width: 200px;
            text-align: center;
        }

        .motic {
            float: left;
            width: 30%;
        }

        .page-break {
            page-break-after: always;
        }

        .header {
            width: 100%;
            height: 150px;
        }

        .certificado {
            margin: 50px;
            width: 100%;
            height: 10%;
            text-align: center;
            font-style: normal;
            padding-top: 150px!important;
        }

        .secretario {
            float: left;
            padding-left: 300px;
        }
        .footerLeft{
            float: left;
        }
        .footerRight{
            float: right;
        }
        .prefeito {
            float: right;
            padding-right: 300px;
        }


        body, html {
        height: 100%!important;
        width: 100%!important;
        margin: 0;
        font: 400 15px/1.8 "Lato", sans-serif;
        background-image: url('/img/backgroundCertificado.jpg');

        background-repeat: repeat-y!important;
	    background-repeat: repeat-x!important;
        }

        footer {
            width: 100%!important;
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            padding-left: 0px!important;
            padding-right: 0px!important;
            /** Extra personal styles **/
            background-color: white;
            color: white;
            line-height: 1.5cm;
            }


    </style>

</head>

<body>

<div class="page_break">

    <div class="header">

             <div style="width:1700px;height:450px;float: left; padding-top: 50px;">
    </div>


        <div class="certificado">
            <span style="font-size:420px;color:#3b4fa5; font-weight:900;">CERTIFICADO</span>
            <br/>
            <p style="font-size:90px;text-align: center;">A<strong> Prefeitura De São Leopoldo</strong>, por meio da Secretaria Municipal de Educação,</p>
            <p style="font-size:90px;text-align: left;">certifica que<strong style="font-size:100px;text-decoration: underline;">  {{$aluno->name}} </strong></p>
            <p style="font-size:90px;text-align: left;">participou da<strong style="font-size:100px;text-decoration: underline;">  {{$edicao->edicao}}° </strong> Mostra de Tecnologia e Inovação com Ciência - MOTIC São Leo,</p>
            <p style="font-size:90px;text-align: left;">realizada nos dias<strong style="font-size:100px;text-decoration: underline;"> {{substr($edicao->data_inicio, 0, 2)}} </strong>e<strong style="font-size:100px;text-decoration: underline;"> {{substr($edicao->data_fim, 0, 2)}} </strong> de setembro de <strong style="font-size:100px;text-decoration: underline;">{{date('Y')}}</strong>, como
                <Strong>ALUNO(A) EXPOSITOR(A).</Strong>
            </p>

            <div class="secretario">
                    <img width="150"   src="{{public_path($edicao->assinatura_secretario)}}" style="width:1000px;height:450px;float: left;z-index:10000" />
                <span style="font-size:60px;">
                            <br> <br><br><br>
                            _____________________________________
                            <br>
                            {{$edicao->secretario}}
                            </span>
                <br>
                <span style="font-size:60px;">
                            Secretário Municipal de Educação - SMED
                            </span>
            </div>

           <div class="prefeito">

                <img width="150" height="500" src="{{public_path($edicao->assinatura_prefeito)}}" style="width:1000px;height:450px;float: left;z-index:10000" />

                        <span style="font-size:60px;">
                            <br> <br><br><br>
                            ________________________
                            <br>
                            {{$edicao->prefeito}}
                            </span>
                <br>
                <span style="font-size:60px;">
                            Prefeito de São Leopoldo
                            </span>
            </div>
            <br>



        </div>
        <br><br><br><br><br><br>
        <p style="font-size:70px;text-align:center!important;padding-left: 100px;color:#000;">Chancela: {{$chancela}}</p>
    </div>

</div>


    <!-- segunda pagina -->


<div class="page_break">


              <div style="width:1700px;height:400px; padding-top: 400px;"> </div>

              <p style="font-size:140px;text-align: center!important;"><strong>Programação</strong></p>

                <p style="font-size:90px;text-align: left!important;padding-left: 100px;"><strong>  {{substr($edicao->data_inicio, 0, 2)}} DE SETEMBRO DE {{date('Y')}}</strong></p>
                <p style="font-size:90px;text-align: left!important;padding-left: 100px;">  Exposição, visitação e avaliação de projetos científicos</p>
                <br>
                <p style="font-size:90px;text-align: left!important;padding-left: 100px;"><strong>  {{substr($edicao->data_fim, 0, 2)}} DE SETEMBRO DE {{date('Y')}}</strong></p>
                <p style="font-size:90px;text-align: left!important;padding-left: 100px;">  Exposição, visitação e avaliação de projetos científicos. Cerimônia de premiação</p>
                <p style="font-size:90px;text-align: left!important;padding-left: 100px;">  Carga horária: 12h</p>




</div>

</body>

<footer>
    <img width="100%" height="100%" src="{{public_path('images/rodapecertificadoMotic.jpg')}}" style="width:100%;height:100%;z-index:10000" />
</footer>
</html>
