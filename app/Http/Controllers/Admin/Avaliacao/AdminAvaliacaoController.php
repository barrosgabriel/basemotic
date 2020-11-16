<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Categoria;
use App\Dado;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Controller;
use App\Nota;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAvaliacaoController extends Controller
{

    private $alunoController;

    public function __construct(AlunoController $alunoController)
    {
        $this->alunoController = $alunoController;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function calcularNotas()
    {
        $projetos = Projeto::where('tipo', '=', 'normal')
                            ->where('ano', '=', date('Y'))->get();
        foreach ($projetos as $projeto) {
            $notaFinal = 0;
            $notas = Nota::where('projeto_id', '=', $projeto->id)->get();
            foreach ($notas as $nota) {
                $notaFinal += $nota->notaFinal;
            }
            if (count($notas) == count($projeto->avaliador)) {
                $projeto->notafinal = $notaFinal;
                $projeto->avaliado = 'sim';
                $projeto->save();
            }
        }
        Session::put('mensagem', "As notas foram calculadas!");
        return redirect()->route('admin.avaliacao.classificacao');
    }

    public function projetosAvaliados()
    {
        $n = Nota::all();
        $notas = [];
        foreach ($n as $nota) {
            $notas[] = intval($nota->projeto_id);
        }
        $count = 0;
        foreach ($notas as $n) {
            foreach ($notas as $nota) {
                if ($nota == $n) {
                    $count++;
                }
            }
            if ($count < 3) {
                $key = array_keys($notas, $n);
                foreach ($key as $k) {
                    unset($notas[$k]);
                }
            }
            $count = 0;
        }
        $projetos = Projeto::where('tipo', '=', 'normal')
            ->where('ano', '=', date('Y'))
            ->whereIn('id', array_unique($notas))
            ->orderBy('titulo', 'asc')
            ->get();
        $quantidade = count($projetos);
        return view('admin.avaliacao.projetos-avaliados', compact('projetos', 'quantidade'));
    }

    public function projetosNaoAvaliados()
    {
        $n = Nota::all();
        $notas = [];
        foreach ($n as $nota) {
            $notas[] = intval($nota->projeto_id);
        }
        $count = 0;
        foreach ($notas as $n) {
            foreach ($notas as $nota) {
                if ($nota == $n) {
                    $count++;
                }
            }
            if ($count < 3) {
                $key = array_keys($notas, $n);
                foreach ($key as $k) {
                    unset($notas[$k]);
                }
            }
            $count = 0;
        }
        $projetos = Projeto::where('tipo', '=', 'normal')
            ->where('ano', '=', date('Y'))
            ->whereNotIn('id', array_unique($notas))
            ->orderBy('categoria_id', 'asc')
            ->get();
        $quantidade = count($projetos);
        return view('admin.avaliacao.projetos-nao-avaliados', compact('projetos', 'quantidade'));
    }

    public function classificacao()
    {
        $categorias = Categoria::all();
        return view('admin.avaliacao.classificacao', compact('categorias'));
    }

    public function retornaClassificacao(Request $request)
    {
        $dataForm = $request->all();
        $projetos = Projeto::orderBy('notafinal', 'desc')
            ->where('avaliado', '=', 'sim')
            ->where('tipo', '=', 'normal')
            ->where('categoria_id', '=', $dataForm['categoria_id'])
            ->where('ano', '=', $dataForm['edicao'])
            ->where('tipoEscola', '=', $dataForm['tipoEscola'])
            ->orderBy('titulo', 'asc')->get();
        $categoria = Categoria::find($dataForm['categoria_id']);
        $tipoEscola = $dataForm['tipoEscola'];
        $ano = $dataForm['edicao'];
        return view('admin.avaliacao.classificacao', compact('categoria' , 'projetos', 'tipoEscola', 'ano'));
    }

    public function classificacaoPopular(){
        $projetos = Projeto::where('tipo', '=', 'normal')
                            ->where('ano', '=', date('Y'))
                            ->orderBy('votacao_popular', 'desc')
                            ->get();
        return view('admin.avaliacao.classificacao-popular', compact('projetos'));
    }

    //lucas
    public function classificacaoPrioridade($id,$ano){

        $projeto = Projeto::where('tipo', '=', 'normal')
        ->where('ano', '=', $ano)->where('id',$id)->first();
     
        $notas = Nota::where('projeto_id', '=', $projeto->id)->get();

        foreach ($notas as $nota) {
            $nota->prioridade = 0;
            $nota->update();
        }
    
        
        return redirect()->route('admin.avaliacao.classificacao');

    }
    //lucas
    
    public function classificacaoPopularExibe(Request $request){
        $dataForm = $request->all();
        $projetos = Projeto::where('tipo', '=', 'normal')
                            ->where('ano', '=', $dataForm['edicao'])
                            ->orderBy('votacao_popular', 'desc')
                            ->get();
        return view('admin.avaliacao.classificacao-popular', compact('projetos'));
    }

}