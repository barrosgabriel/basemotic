<div class="row">
    <div class="input-field col s6 m4 l3">
        <input id="coletor" class="tooltipped" data-position="top" data-delay="50"
               data-tooltip="Digite um título de projeto..." type="text" name="titulo">
        <label for="coletor">Título</label>
    </div>
    @if(Auth::user()->tipoUser == 'admin')
        <div class="input-field col s6 m4 l3">
            <input id="coletor" class="tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Digite o nome de uma escola..." type="text" name="escola">
            <label for="coletor">Escola</label>
        </div>
    @endif
    <div class="input-field col s6 m4 l3">
        <input id="coletor" class="tooltipped" data-position="top" data-delay="50"
               data-tooltip="Digite uma categoria..." type="text" name="categoria">
        <label for="coletor">Categoria</label>
    </div>
    <div class="input-field col s6 m4 l3">
        <input id="coletor" class="tooltipped" data-position="top" data-delay="50"
               data-tooltip="Digite o ano de uma edição..." type="text" name="edicao">
        <label for="coletor">Edição</label>
    </div>
    <div class="input-field col s1 m1 l1">
        <button type="submit" class="btn-floating tooltipped" data-position="top" data-delay="50"
                data-tooltip="Clique aqui para pesquisar"><i class="material-icons">search</i>
        </button>
    </div>
    {{csrf_field()}}
</div>