<?php

namespace App\Http\Controllers\Professor\Conta;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;

class ProfessorContaController extends Controller
{

    public function __construct()
    {
        //Logo abaixo são carregados os middleware's responsáveis por fazer a o filtro de quem pode
        //acessar este controller. Ou seja, somente quem está autenticado e quem é professor pode acessar este controller.
        $this->middleware('auth');
        $this->middleware('check.professor');
    }

    public function index()
    {
        try {
            //retorna para a vire professor.conta.home
            return view('professor.conta.home');
        } catch (\Exception $e) {
            return abort(300, '310');
        }
    }

    public function alterarSenha()
    {
        try {
            //retorna para a view professor.config.mudar-senha
            return view('professor.conta.mudar-senha');
        } catch (\Exception $e) {
            return abort(300, '311');
        }
    }

    public function alteraSenha(Request $request)
    {
        //método para alterar senha
     
            //recebe os dados por request
            $dataForm = $request->all();
            //o próximo trecho de código é um validador.
            //ele chama um método chamado "Validator" e esse método fica responsável por verificar se
            //os dados chegaram de forma correta.
            $validator = Validator::make($request->all(), [

                'password' => 'required|alpha_num|min:6',
                'password_confirmed' => 'equired|alpha_num|min:6|same:password',

                'password_confirmed.required'  => 'O campo senha é de preenchimento obrigatório!',
                'password_confirmed.min'       => 'A senha deve ter no mínimo 6 caractéres',
                'password_confirmed.confirmed' => 'As senhas devem ser iguais!',
                'password_confirmed.alpha_num' => 'Insira uma senha sem caracteres especiais!',

                'password.required'     => 'O campo senha é de preenchimento obrigatório!',
                'password.min'          => 'A senha deve ter no mínimo 6 caractéres',
                'password.confirmed'    => 'As senhas devem ser iguais!',
                'password.alpha_num'    => 'Insira uma senha sem caracteres especiais!',

                'password_confirmed.required'   => 'O campo senha é de preenchimento obrigatório!',
                'password_confirmed.min'        => 'A senha deve ter no mínimo 6 caractéres',
                'password_confirmed.alpha_num'  => 'Insira uma senha sem caracteres especiais',
                'password_confirmed.confirmed'  => 'As senhas devem ser iguais',

            ]);
            //se o validador falhar...
            if ($validator->fails()) {
                //retorna para a rota 'escola.config.alterar-senha'
                return redirect()->route('professor.config.alterar-senha')
                    ->withErrors($validator)
                    ->withInput();
            }
            //se passar do validador, verifica se a não senha é válida
            if (!(Hash::check($dataForm['senha_atual'], Auth::user()->password))) {
                Session::put('mensagem', "Senha incorreta!");
                return redirect()->route('professor.config.alterar-senha')->withErrors(['password' => 'Senha atual está incorreta'])->withInput();
            }
            //se a senha for valida, ele vai procurar o usuario que vai ter a senha alterada
            $user = User::findOrFail(Auth::user()->id);
            //passa a nova senha pra dentro do campo password com a bcrypt
            $user->password = (bcrypt($dataForm['password']));
            //salva
            $user->update();
            Session::put('mensagem', "Senha atualizada!");
            //retorna pra rota 'escola.config.alterar-senha
            return redirect()->route('professor.config.alterar-senha');
        
    }

}