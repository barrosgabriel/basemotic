<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Todos alunos</title>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .motic {
            float: right;
            padding-bottom: 20px;
        }

        .pmsl {
            float: left;
        }

        .page-break {
            page-break-after: always;
        }

        .header {
            width: 100%;
            height: 320px;
            padding-bottom: 20px;
        }
    </style>

</head>

<body>
    <div class="header">
           PREFEITURA MUNICIPAL DE SÃO LEOPOLDO
           Estado do Rio Grande do Sul
           SECRETARIA MUNICIPAL DE EDUCAÇÃO
           Praça Tiradentes, 119 – Centro São Leopoldo - RS – Cep: 93010-020
           Fone: (0xx51) 22000800 E-mail: smed@saoleopoldo.rs.gov.br
    </div>
@foreach($alunos as $aluno)

    <h1>{{$aluno->name}}</h1>

    <h2>Dados pessoais</h2>

    <table>
        <tr>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Sexo</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone</th>
        </tr>
        <tr>
            <td>{{$aluno->name}}</td>
        </tr>
    </table>
    <div class="page-break"></div>

@endforeach

</body>
</html>