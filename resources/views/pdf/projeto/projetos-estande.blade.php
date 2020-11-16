<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Todos projetos</title>

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

        .header {
            width: 100%;
            height: 320px;
            padding-bottom: 20px;
        }
    </style>

</head>

<body>
<div class="header">
    <img src="{{public_path('images/LOGO_PMSL (2).png')}}" class="pmsl">

    <img src="{{public_path('images/motic-logo (2).png')}}" class="motic">
</div>
<h2>Projetos do sistema</h2>
<table>
    <tr>
        <th>Estande</th>
        <th>Projeto</th>
        <th>Categoria</th>
        <th>Escola</th>
    </tr>
    @foreach ($projetos as $projeto)
        <tr>
            <td>{{$projeto->estande}}</td>
            <td>{{$projeto->titulo}}</td>
            <td>{{$projeto->categoria->categoria}}</td>
            <td>{{$projeto->escola->name}}</td>
        </tr>
    @endforeach
</table>

</body>
</html>