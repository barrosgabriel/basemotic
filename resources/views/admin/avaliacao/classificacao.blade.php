@extends('_layouts._app')

@section('titulo','Lista de classificação MOTIC ' . date('Y'))

@section('breadcrumb')
<a href="{{route ('admin')}}" class="breadcrumb">Home</a>
<a href="{{route ('admin.projeto')}}" class="breadcrumb">Projetos</a>
<a href="{{route ('admin.avaliacao.classificacao')}}" class="breadcrumb">Classificação</a>
@endsection

@section('content')

@section('titulo-header', 'Classificação')

@section('conteudo-header', 'Essa é a classificação dos projetos da MOTIC.')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
            @include('_layouts._mensagem-sucesso')
            @endif
        </div>
        @if(!isset($categoria))
        <blockquote>Selecione a categoria que você quer visualizar a classificação e em seguida clique na lupa de
            pesquisar.
        </blockquote>
        <form method="POST" enctype="multipart/form-data" action="{{route ('admin.avaliacao.retorna-classificacao')}}">
            <div class="row">
                <div class="input-field col s11 m11 l4">
                    <i class="material-icons prefix">people</i>
                    <select name="categoria_id" required>
                        <option value="" disabled selected>Selecione a categoria</option>
                        @forelse ($categorias as $c)
                        <option value="{{$c->id}}">{{$c->categoria}}</option>
                        @empty
                        <option value="">Nenhuma categoria cadastrada no sistema!
                        </option>
                        @endforelse
                    </select>
                    <label>Categoria *</label>
                </div>
                <div class="input-field col s11 m11 l4">
                    <i class="material-icons prefix">school</i>
                    <select required name="tipoEscola">
                        <option value="" disabled selected>Selecione o tipo de escola</option>
                        <option value="municipal">Escola Municipal</option>
                    </select>
                    <label>Tipo de escola *</label>
                </div>
                <div class="input-field col s11 m11 l3">
                    <i class="material-icons prefix">date_range</i>
                    <input required name="edicao" placeholder="Digite o ano da edição..." id="edicao" type="number"
                        class="validate">
                    <label for="edicao">Edição *</label>
                </div>
                {{csrf_field()}}
                <div class="input-field col s1 m1 l1">
                    <button type="submit" class="btn-floating tooltipped" data-position="top" data-delay="50"
                        data-tooltip="Pesquisar..."><i class="material-icons">search</i></button>
                </div>
            </div>
        </form>
        @else
        <blockquote>A classificação dos projetos da categoria <b>{{$categoria->categoria}}</b> e do tipo de escola
            <b>{{$tipoEscola}}</b> na edição de <b>{{$ano}}</b> é:</blockquote>
        @endif

        <div class="row">
            <table id="tabelaCategorias" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Projeto</th>
                        <th>Metodologia Científica</th>
                        <th>Relevância Científica</th>
                        <th>Registro da Pesquisa</th>
                        <th>Clareza e Habilidade</th>
                        <th>Capacidade Criativa</th>
                        <th>Nota Final</th>
                        <th>Escola</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($categoria))
                    @foreach($projetos as $projeto)
                    <tr>
                        <td>{{$projeto->titulo}}</td>

                        @php
                        $notaUm = 0;
                        $notaDois = 0;
                        $notaTres = 0;
                        $notaQuatro = 0;
                        $notaCinco = 0;
                        $notaFinal = 0;
                        foreach($projeto->nota as $nota){
                        $notaUm += $nota->notaUm;
                        $notaDois += $nota->notaDois;
                        $notaTres += ($nota->notaTres + $nota->notaQuatro);
                        $notaQuatro += ($nota->notaCinco + $nota->notaSeis);
                        $notaCinco += $nota->notaSete;
                        }
                        $notaFinal += $notaUm;
                        $notaFinal += $notaDois;
                        $notaFinal += $notaTres;
                        $notaFinal += $notaQuatro;
                        $notaFinal += $notaCinco;
                        @endphp
                        <td>{{$notaUm}} pontos</td>
                        <td>{{$notaDois}} pontos</td>
                        <td>{{$notaTres}} pontos</td>
                        <td>{{$notaQuatro}} pontos</td>
                        <td>{{$notaCinco}} pontos</td>
                        <td>{{$notaFinal}} pontos</td>
                        <td>{{$projeto->escola->name}}</td>

                        <td><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Visualizar"
                                href="{{ route('admin.projeto.show', $projeto->id) }}" target="_blank"> <i
                                    class="small material-icons">library_books</i></a>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>



@endsection