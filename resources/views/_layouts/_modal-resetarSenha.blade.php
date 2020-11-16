
<div id="modal" class="modal">
    <div class="modal-content">
        <h4 align="center">Aviso Usuario já cadastrado</h4>
        <h5 align="center">Seu usuário estará ativo na data de início do evento. </h5>
        <div class="row">
            <label for="userName">Usuário Login</label>
            <div class="input-field col s12">
                <input disabled class="validate" type="text" id="userName" value="{{$cpfCadastrado->user->username}}">
                <input disabled class="validate" hidden type="text" id="tipo">
            </div>
        </div>
        <div class="row">
            <label for="name_user">Nome:</label>
            <div class="input-field col s12">
                <input disabled class="validate" type="text" id="name_user" value="{{$cpfCadastrado->name}}">
            </div>
        </div>
      <div class="row">
            <label for="email">Email:</label>
            <div class="input-field col s12">
                <input disabled class="validate" type="text" id="emailModal" value="{{$cpfCadastrado->user->email}}">

            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a id="resetarSenha" class="btn blue" href="/password/reset">Não lembro minha Senha</a>
        <a class="btn blue" onclick="window.history.back();">Ok</a>
    </div>

</div>

<script>

        function OpenModal() { // chama o modal
            $('#modal').modal('open');
        }


        $(document).ready(function(){

            $('#modal').modal();//add referencia
            OpenModal()
        });

</script>
