
<div id="modalAvaliador" class="modal">
    <div class="modal-content">
        <h4 align="center">Aviso</h4>
    <h5 align="center">Confirmação de liberação do avaliador para edição {{date('Y')}}</h5>



        <div class="row">
            <label for="name_delete">Nome:</label>
            <div class="input-field col s12">
                    <input disabled class="validate" type="text" id="name_delete">
            </div>
        </div>

    </div>

    <div class="modal-footer">

        <a class="btn blue" onclick="$('.modal').modal('close');">Não</a>
        <a id="liberarAvaliador" class="btn blue" href="@if(isset($avaliador->avaliador->id)) {{route("admin.valida.avaliadores.liberar", $avaliador->avaliador->id)}} @else {{route("admin.valida.avaliadores.liberar", $avaliador->id)}} @endif">Liberar</a>
    </div>

</div>


