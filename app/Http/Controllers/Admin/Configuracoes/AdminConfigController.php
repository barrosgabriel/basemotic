<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Dado;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\InformacoesMotic;
use Validator;
use App\AvisosMotic;
use App\Aluno;
use App\Avaliador;
use App\Professor;

class AdminConfigController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function alterarSenha()
    {
        try {
            return view('admin.config.mudar-senha');
        } catch (\Exception $e) {
            return abort(100, '145');
        }
    }

    public function alteraSenha(Request $request){
        try {
            $dataForm = $request->all();
            $validator = Validator::make($request->all(), [
                'senha_atual.required'  => 'O campo senha é de preenchimento obrigatório!',
                'senha_atual.min'       => 'A senha deve ter no mínimo 6 caractéres',
                'senha_atual.confirmed' => 'As senhas devem ser iguais!',
                'senha_atual.alpha_num' => 'Insira uma senha sem caracteres especiais!',

                'password.required'     => 'O campo senha é de preenchimento obrigatório!',
                'password.min'          => 'A senha deve ter no mínimo 6 caractéres',
                'password.confirmed'    => 'As senhas devem ser iguais!',
                'password.alpha_num'    => 'Insira uma senha sem caracteres especiais!',

                'password_confirmed.required'   => 'O campo senha é de preenchimento obrigatório!',
                'password_confirmed.min'        => 'A senha deve ter no mínimo 6 caractéres',
                'password_confirmed.alpha_num'  => 'Insira uma senha sem caracteres especiais',
                'password_confirmed.confirmed'  => 'As senhas devem ser iguais',

            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.config.alterarr-senha')
                    ->withErrors($validator)
                    ->withInput();
            }
            if(!(Hash::check($dataForm['senha_atual'], Auth::user()->password))){
                Session::put('mensagem', "Senha incorreta!");
                return redirect()->route('admin.config.alterarr-senha')->withErrors(['password' => 'Senha atual está incorreta'])->withInput();
            }
            $user = User::findOrFail(Auth::user()->id);
            $user->password = (bcrypt($dataForm['password']));
            $user->save();
            Session::put('mensagem', "Senha atualizada!");
            return redirect()->route('admin.config.alterarr-senha');
        } catch (\Exception $e) {
            return abort(100, '146');
        }
    }

    public function desativarAvaliadores()
    {
        return view('admin.config.desativarAvaliadores');
    }

    public function desativarAvaliadoresStore()
    {
        $desativarAvaliadores = User::where('tipoUser', '=', 'avaliador')->get();
        $desativarAvaliadores->each->update(['ativo'=>0]);
        Session::put('mensagem', "Avaliadores desativados.");
        return redirect()->route('admin.config.desativarAvaliadores');
    }


    public function ativarCertificados()
    {
        $verificaCertificados = InformacoesMotic::latest()->first();
        return view('admin.config.liberarCertificados', compact('verificaCertificados'));
    }

    public function ativarCertificadosStore()
    {
        $ativarCertificados = InformacoesMotic::latest()->first();
        $ativarCertificados['libera_certificado'] = 1;
        $ativarCertificados->update();
        Session::put('mensagem', "Certificados liberados.");
        return redirect()->route('admin.config.liberarCertificados');
    }

    public function desativarCertificadosStore()
    {
        $desativarCertificados = InformacoesMotic::latest()->first();
        $desativarCertificados['libera_certificado'] = 0;
        $desativarCertificados->update();
        Session::put('mensagem', "Certificados bloqueados.");
        return redirect()->route('admin.config.liberarCertificados');
    }


    public function criaAvisoView()
    {
        $informacao = AvisosMotic::latest()->first();
        return view('admin.config.criarAvisospop', compact('informacao'));

    }

    public function criaAvisosalvar(Request $request)
    {
        $dados = $request->all();
        $informacao = AvisosMotic::latest()->first();
        $informacao->update($dados);
  /*       $informacao->titulo = $dados['titulo'];
        $informacao->corpo_aviso = $dados['corpo_aviso'];
        $informacao->ativo = $dados['ativo']; */

        Session::put('mensagem', "Aviso cadastrado com sucesso.");
        return redirect()->route('criaAviso.view');
    }

    public function resetarNumCertificados() {
        
        $resetarAluno = Aluno::where('nCertificadosGerados', '=', 1)->get();
        $resetarAluno->each->update(['nCertificadosGerados' => 0]);

        $resetarAvaliador = Avaliador::where('nCertificadosGerados', '=', 1)->get();
        $resetarAvaliador->each->update(['nCertificadosGerados' => 0]);

        $resetarOrientador = Professor::where('nCertificadosGeradosOrientador', '=', 1)->get();
        $resetarOrientador->each->update(['nCertificadosGeradosOrientador' => 0]);

        $resetarCoorientador = Professor::where('nCertificadosGeradosCoorientador', '=', 1)->get();
        $resetarCoorientador->each->update(['nCertificadosGeradosCoorientador' => 0]);

        Session::put('mensagem', "Número de certificados gerados resetados.");
        return redirect()->route('admin.config.liberarCertificados');
    }


}
