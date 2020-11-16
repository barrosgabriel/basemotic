<!DOCTYPE html>
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Informações sobre os projetos de {{$ano}}</title>

	<style>
		html {
			font-size: 62.5%;
		}

		h2 {
			font-size: 2.5rem;
			margin-top: 0.5rem;
		}

		h3 {
			font-size: 2.2rem;
		}

		li {
			list-style: none;
			font-size: 1.8rem;
		}

		li+li {
			margin-top: 0.8rem;
		}

		.motic {
			float: right;
		}

		.pmsl {
			float: left;
		}

		.page-break {
			page-break-after: avoid;
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

		<img src="{{public_path('images/motic-logo.png')}}" class="motic">
	</div>

	<h2>Informações sobre os projetos de {{$ano}}</h2>
	<hr>

	@for($i = 1; $i < 6; $i++) <ul>

		<h3>Categoria: {{$categorias[$i]}} </h3>

		<li>Total de alunos masculino: {{$alunoMasculinoPorCategoria[$i]}}</li>
		<li>Total de alunos feminino: {{$alunoFemininoPorCategoria[$i]}}</li>
		<li>Total de professores: {{$professoresPorCategoria[$i]}}</li>
		<li>Número de escolas: {{$numeroEscolas[$i]}}</li>
		<li>Número de projetos: {{$numeroProjetos[$i]}}</li>
		</ul>
		@endfor
		<div class="page-break"></div>
</body>

</html>