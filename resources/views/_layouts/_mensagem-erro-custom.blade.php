<div class="center-align">
        <div class="chip red">
            {{Session::get('mensagem-erro')}}
            <i class="close material-icons">close</i>
        </div>
    </div>
    {{Session::forget('mensagem-erro')}}
    