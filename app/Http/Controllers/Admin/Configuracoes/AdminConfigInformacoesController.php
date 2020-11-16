<?php

namespace App\Http\Controllers\admin\configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InformacoesMotic;
use Illuminate\Support\Facades\Session;

class AdminConfigInformacoesController extends Controller 
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function configuraEdicao(){
        $informacoesMotic = InformacoesMotic::latest()->first();
        //dd($configuracoes);
        return view("admin.config.gerenciarEdicao", compact('informacoesMotic'));
    }

    public function configuraEdicaoStore(Request $request){
        $dataForm = $request->all();

        $configuracoes = InformacoesMotic::latest()->first();
        $configuracoes->update($request->all());
        
        $configuracoes->edicao = $dataForm['edicao'];
        $configuracoes->data_inicio = $dataForm['data_inicio'];
        $configuracoes->data_fim = $dataForm['data_fim'];
        $configuracoes->secretario = $dataForm['secretario'];
        $configuracoes->prefeito = $dataForm['prefeito'];
       
        if($request->hasFile('assinatura_secretario')){
            $imagem = $request->file('assinatura_secretario');
            $dir = "img/assinaturas/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "assinatura_secretario_".date('Y').".".$ex;
            $imagem->move($dir,$nomeImagem);
            $configuracoes->assinatura_secretario = $dir."/".$nomeImagem;
          }

          if($request->hasFile('assinatura_prefeito')){
            $imagem = $request->file('assinatura_prefeito');
            $dir = "img/assinaturas/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "assinatura_prefeito_".date('Y').".".$ex;
            $imagem->move($dir,$nomeImagem);
            $configuracoes->assinatura_prefeito = $dir."/".$nomeImagem;
          }
    
        $configuracoes->update();
        Session::put('mensagem', "Informações da edição ".date('Y'). " configuradas com sucesso.");
        return redirect()->route('admin.config.edicao');

    }
}
