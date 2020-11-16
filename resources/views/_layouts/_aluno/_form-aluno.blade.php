{{csrf_field()}}

{{-- <h5>Dados básicos</h5>

<div class="row">
    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">perm_identity</i>
        <input minlength="2" id="name" class="validate" type="text" name="name"
               value="{{$professor->name or old('name')}}" required>
        <label data-error="Insira um nome válido!" data-success="Ok" for="name">Nome do professor
            *</label>
    </div>

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">today</i>
        <input type="text" class="datepicker" name="nascimento"
               value="{{$professor->nascimento or old('nascimento')}}" required>
        <label for="nascimento">Nascimento *</label>
    </div>

</div>
<div class="row">
    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">people</i>
        <select name="sexo">
            <option value="" disabled>Sexo</option>
            <option value="feminino"
                    @if(isset($professor))@if($professor->sexo == 'feminino') selected @endif @endif
            >Feminino
            </option>
            <option value="masculino"
                    @if (isset($professor)) @if($professor->sexo == 'masculino') selected @endif @endif
            >Masculino
            </option>
        </select>
        <label>Sexo *</label>
    </div>

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">book</i>
        <select name="grauDeInstrucao">
            <option value="" disabled selected>Grau de Instrução</option>
            <option value="Ensino Médio"
                    @if (isset($professor) && $professor->grauDeInstrucao == 'Ensino Médio') selected @endif
            >Ensino Médio
            </option>
            <option value="Ensino Superior"
                    @if (isset($professor) && $professor->grauDeInstrucao == 'Ensino Superior') selected @endif
            >Ensino Superior
            </option>
        </select>
        <label>Grau de Instrição *</label>
    </div>

</div>

<div class="row">

    @yield('campo-escola')

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">confirmation_number</i>
        <select name="camisa">
            <option value="" disabled selected>Tamanho...</option>
            <option value="PP" @if(isset($professor)) @if($professor->camisa == 'PP'))
                    required selected @endif @endif>PP
            </option>
            <option value="P" @if(isset($professor)) @if($professor->camisa == 'P'))
                    required selected @endif @endif>P
            </option>
            <option value="M" @if(isset($professor)) @if($professor->camisa == 'M'))
                    required selected @endif @endif>M
            </option>
            <option value="G" @if(isset($professor)) @if($professor->camisa == 'G'))
                    required selected @endif @endif>G
            </option>
            <option value="GG" @if(isset($professor)) @if($professor->camisa == 'GG'))
                    required selected @endif @endif>GG
            </option>
        </select>
        <label>Tamanho da camisa *</label>
    </div>

</div>

<div class="row">

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">perm_identity</i>
        <input minlength="2" id="matricula" class="validate" type="text" name="matricula"
               value="{{$professor->matricula or old('matricula')}}" required>
        <label data-error="Insira uma matricula válida!" data-success="Ok"
               for="matricula">Matrícula *</label>
    </div>

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">email</i>
        <input minlength="10" class='validate' id='email' type="email" name="email"
               value="{{$professor->user->email or old('email')}}" required>
        <label data-error="Insira um e-mail válido!" data-success="Ok"
               for="email">Email *</label>
    </div>

</div>

<div class="row">

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">local_phone</i>
        <label for="telefone">Telefone *</label>
        <input type="text" name="telefone" data-length="16"
               value="{{$professor->telefone or old('telefone')}}" required>
    </div>

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">perm_identity</i>
        <label for="cpf">CPF *</label>

        <input required type="text" placeholder="Ex. 123.456.789-01" id="cpf"  name="cpf" data-length="14" maxlength="14"  value="{{$professor->cpf or old('cpf')}}">
    </div>
</div>

<h5>Endereço</h5>

<div class="row">
    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">explore</i>
        <input id="cep" class="validate tooltipped" data-position="top" data-delay="50"
               data-tooltip="Somente números e no máximo 8 números" type="number" name="cep"
               data-length="8"
               value="{{$professor->cep or old('cep')}}">
        <label data-error="Insira um cep válido!" data-success="Ok"
               for="cep">CEP</label>
    </div>

    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">business</i>
        <input id="bairro" class="validate" type="text" name="bairro"
               value="{{$professor->bairro or old('bairro')}}">
        <label data-error="Insira um bairro válido!" data-success="Ok"
               for="bairro">Bairro</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s12 m12 l4">
        <i class="material-icons prefix">home</i>
        <input class="validate" id="rua" type="text" name="rua"
               value="{{$professor->rua or old('rua')}}">
        <label data-error="Insira uma rua válida!" data-success="Ok"
               for="rua">Rua</label>
    </div>

    <div class="input-field col s12 m6 l4">
        <i class="material-icons prefix">filter_1</i>
        <input class="validate" id="numero" type="number" name="numero"
               value="{{$professor->numero or old('numero')}}">
        <label data-error="Insir a um número válido!" data-success="Ok"
               for="numero">N°</label>
    </div>

    <div class="input-field col s12 m6 l4">
        <i class="material-icons prefix">home</i>
        <input type="text" name="complemento"
               value="{{$professor->complemento or old('complemento')}}">
        <label for="complemento">Complemento</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s12 m12 l4">
        <i class="material-icons prefix">location_city</i>
        <input id="cidade" class="validate" type="text" name="cidade"
               value="São Leopoldo"
               value="{{$professor->cidade or old('cidade')}}">
        <label data-error="Insira uma cidade válida!" data-success="Ok"
               for="cidade">Cidade</label>
    </div>

    <div class="input-field col s12 m6 l4">
        <i class="material-icons prefix">location_city</i>
        <input id="estado" class="validate" type="text" name="estado"
               value="Rio Grande do Sul"
               value="{{$professor->estado or old('estado')}}">
        <label data-error="Insira um estado válido!" data-success="Ok"
               for="estado">Estado</label>
    </div>

    <div class="input-field col s12 m6 l4">
        <i class="material-icons prefix">location_city</i>
        <input class="validate" id="pais" type="text" name="pais" value="Brasil"
               value="{{$professor->pais or old('pais')}}">
        <label data-error="Insira um país válido!" data-success="Ok"
               for="pais">País</label>
    </div>
</div>
@if(!isset($professor))
    <h5>Usuário</h5>
    <div class="row">
        <blockquote>
            Ao escolher um usuário, se atente aos seguintes padrões:
            <br>-Digite um usuário em letras minúsculas.
            <br>-Digite um usuário sem caracteres especiais.
            <br>-Preferencialmente digite o seu usuário com o seu nome.sobrenome, exemplo:
            <br>Nome: João da Silva
            <br>Usuário: joao.silva
        </blockquote>
        <div class="input-field col s12 m12 l12">
            <i class="material-icons prefix">person</i>
            <label for="username">Usuário *</label>
            <input type="text" name="username" value="{{$professor->user->username or old('username')}}"
                   required>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">lock</i>
            <label for="password">Senha *</label>
            <input type="password" name="password" value="{{old('password')}}" required>
        </div>

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">lock</i>
            <label for="password_confirmation">Confirmar senha *</label>
            <input type="password" name="password_confirmation" value="{{old('password')}}" required>
        </div>
    </div>

@endif
<div class="fixed-action-btn">
    <button type="submit"
            class="btn-floating btn-large waves-effect waves-light red tooltipped  modal-trigger"
            data-position="top" id="submit" data-delay="50" data-tooltip="Cadastrar"><i
                class="material-icons">add_circle_outline</i>
    </button>
</div> --}}


 <div class="section">
    <h5>Dados básicos</h5>
    <div class="row">

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">perm_identity</i>
            <input minlength="2" id="name" class="validate" type="text" name="name"
                   value="{{$aluno->name or old('name')}}" required>
            <label data-error="Insira um nome válido!" data-success="Ok" for="name">Nome do aluno
                *</label>
        </div>

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">today</i>
            <input type="text" class="datepicker" name="nascimento"
                   value="{{$aluno->nascimento or old('nascimento')}}" required>
            <label for="nascimento">Nascimento *</label>
        </div>

    </div>
    <div class="row">
        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">people</i>
            <select name="sexo">
                <option value="" disabled selected>Sexo</option>
                <option value="feminino"
                        @if(isset($aluno)) @if($aluno->sexo=='feminino') selected @endif @endif
                >Feminino
                </option>
                <option value="masculino"
                        @if(isset($aluno)) @if($aluno->sexo=='masculino') selected @endif @endif
                >Masculino
                </option>
            </select>
            <label>Sexo *</label>
        </div>
        @yield('campo-escola')

    </div>

    <div class="row">

        @yield('campo-etapa')

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">perm_identity</i>
            <input minlength="2" id="turma" class="validate" type="text" name="turma"
                   value="{{$aluno->turma or old('turma')}}" required>
            <label data-error="Insira uma turma válida!" data-success="Ok" for="name">Turma *</label>
        </div>

    </div>
    <div class="row">

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">confirmation_number</i>
            <select name="camisa">
                <option value="" disabled selected>Tamanho...</option>
                <option value="PP" @if(isset($aluno)) @if($aluno->camisa == 'PP'))
                        required selected @endif @endif
                >PP
                </option>
                <option value="P" @if(isset($aluno)) @if($aluno->camisa == 'P')) required selected @endif @endif
                >P
                </option>
                <option value="M" @if(isset($aluno)) @if($aluno->camisa == 'M')) required selected @endif @endif
                >M
                </option>
                <option value="G" @if(isset($aluno)) @if($aluno->camisa == 'G')) required selected @endif @endif
                >G
                </option>
                <option value="GG" @if(isset($aluno)) @if($aluno->camisa == 'GG'))
                        required selected @endif @endif
                >GG
                </option>
            </select>
            <label>Tamanho da camisa *</label>
        </div>

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">email</i>
            <input minlength="10" class='validate' id='email' type="email" name="email"
                   value="{{$aluno->user->email or old('email')}}">
            <label data-error="Insira um e-mail válido!" data-success="Ok"
                   for="email">Email</label>
        </div>

    </div>

    <div class="row">
        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">local_phone</i>
            <input id="telefone" class="validate tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Somente números e no mínimo 8 números" type="number" name="telefone"
                   data-length="16" value="{{$aluno->telefone or old('telefone')}}">
            <label data-error="Insira um telefone válido!" data-success="Ok"
                   for="telefone">Telefone</label>
        </div>

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">perm_identity</i>
            <input type="text" placeholder="Ex. 123.456.789-01" id="cpf"   data-length="14" maxlength="14" required  class="validate tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Somente números" type="text" name="cpf"
                    value="{{$aluno->cpf or old('cpf')}}">
            <label data-error="Insira um cpf válido!" data-success="Ok"
                   for="cpf">CPF*</label>
        </div>

    </div>
</div>
<div class="divider"></div>
<div class="section">
    <h5>Endereço</h5>

    <div class="row">
        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">explore</i>
            <input id="cep" class="validate tooltipped" data-position="top" data-delay="50"
                   data-tooltip="Somente números e no máximo 8 números" type="number" name="cep"
                   data-length="8"
                   value="{{$aluno->cep or old('cep')}}">
            <label data-error="Insira um cep válido!" data-success="Ok"
                   for="cep">CEP</label>
        </div>

        <div class="input-field col s12 m6 l6">
            <i class="material-icons prefix">business</i>
            <input id="bairro" class="validate" type="text" name="bairro"
                   value="{{$aluno->bairro or old('bairro')}}">
            <label data-error="Insira um bairro válido!" data-success="Ok"
                   for="bairro">Bairro</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12 m6 l4">
            <i class="material-icons prefix">home</i>
            <input class="validate" id="rua" type="text" name="rua"
                   value="{{$aluno->rua or old('rua')}}">
            <label data-error="Insira uma rua válida!" data-success="Ok"
                   for="rua">Rua</label>
        </div>

        <div class="input-field col s12 m6 l4">
            <i class="material-icons prefix">filter_1</i>
            <input class="validate" id="numero" type="number" name="numero"
                   value="{{$aluno->numero or old('numero')}}">
            <label data-error="Insir a um número válido!" data-success="Ok"
                   for="numero">N°</label>
        </div>

        <div class="input-field col s12 m12 l4">
            <i class="material-icons prefix">home</i>
            <input type="text" name="complemento"
                   value="{{$aluno->complemento or old('complemento')}}">
            <label for="complemento">Complemento</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12 m12 l4">
            <i class="material-icons prefix">location_city</i>
            <input id="cidade" class="validate" type="text" name="cidade"
                   value="São Leopoldo"
                   value="{{$aluno->cidade or old('cidade')}}">
            <label data-error="Insira uma cidade válida!" data-success="Ok"
                   for="cidade">Cidade</label>
        </div>

        <div class="input-field col s12 m6 l4">
            <i class="material-icons prefix">location_city</i>
            <input id="estado" class="validate" type="text" name="estado"
                   value="Rio Grande do Sul"
                   value="{{$aluno->estado or old('estado')}}">
            <label data-error="Insira um estado válido!" data-success="Ok"
                   for="estado">Estado</label>
        </div>

        <div class="input-field col s12 m6 l4">
            <i class="material-icons prefix">location_city</i>
            <input class="validate" id="pais" type="text" name="pais" value="Brasil"
                   value="{{$aluno->pais or old('pais')}}">
            <label data-error="Insira um país válido!" data-success="Ok"
                   for="pais">País</label>
        </div>
    </div>
</div>
<div class="fixed-action-btn">
    <button type="submit"
            class="btn-floating btn-large waves-effect waves-light red tooltipped  modal-trigger"
            data-position="top" id="submit" data-delay="50" data-tooltip="Cadastrar"><i
                class="material-icons">add_circle_outline</i>
    </button>
</div>

{{-- <script>
    function valida() {
    value = $('#cpf').val();
    if (document.cadastro.cpf.validity.patternMismatch) {
    if(value != ''){
        value = value.replace('.', '');
        value = value.replace('.', '');
        cpf = value.replace('-', '');
        while (cpf.length < 11) cpf = "0" + cpf;
        var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
        var a = [];
        var b = new Number;
        var c = 11;
        for (i = 0; i < 11; i++) {
            a[i] = cpf.charAt(i);
            if (i < 9) b += (a[i] * --c);
        }
        if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11 - x }
        b = 0;
        c = 11;
        for (y = 0; y < 10; y++) b += (a[y] * c--);
        if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11 - x; }
        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return true;
        return false;
    }
    }
    return false;
    }
 </script> --}}
