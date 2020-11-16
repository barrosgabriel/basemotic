<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Projeto;

use App\Categoria;
use App\Http\Controllers\ProjetoController;
use App\Models\Aluno;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProjetoRelatorioController
{

    private $projetoController;

    public function __construct(ProjetoController $projetoController)
    {
        $this->projetoController = $projetoController;
    }

    public function index()
    {
        try {
            $categorias = Categoria::all();
            $projetos = Projeto::orderBy('titulo', 'asc')
                ->where('tipo', '=', 'normal')
                ->where('ano', '=', intval(date("Y")))
                ->paginate(10);
            return view('admin.projeto.relatorios', compact('projetos', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '189.5');
        }
    }

    public function todosProjetos(Request $request)
    {
        //possivelmente a biblioteca tem uma limitação no tamanho do pdf que é gerado, então essa função não consegue retornar todos os projetos
        //devido a quantidade de páginas
        $ano = $request->input('ano');
        // dd($ano);

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 9999999);

        try {
            $projetos = Projeto::where('tipo', '=', 'normal')
                ->where('ano', '=', $ano)
                ->orderBy('titulo', 'asc')
                ->get();
            //dd($projetos);
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.projeto.todos-projetos', compact('projetos'))
                ->stream('todos-projetos-motic' . $ano . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }

    public function categoriaProjetos(Request $request)
    {
        $ano = $request->input('ano');
        $id = $request->input('id');

        // dd($ano,$id);

        $categoria = Categoria::find($id);
        $projetos = Projeto::where('tipo', '=', 'normal')
            ->where('categoria_id', '=', $id)
            ->where('ano', '=', $ano)
            ->orderBy('titulo', 'asc')
            ->get();
        return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.projeto.categoria-projetos', compact('projetos', 'categoria'))
            ->stream('projetos-categoria-' . $categoria->categoria . '-motic' . $ano . '.pdf');

    }
    public function projetoIndividual($id)
    {
        try {
            $projeto = Projeto::find($id);
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.projeto.projeto-individual', compact('projeto'))
                ->stream('projeto-' . $projeto->titulo . '-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }
    public function estandeProjetos()
    {
        try {
            $projetos = Projeto::where('tipo', '=', 'normal')->where('ano', date('Y'))
                ->orderBy('estande', 'asc')
                ->get();

            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.projeto.projetos-estande', compact('projetos'))
                ->stream('projeto-por-estande-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }

    public function filtroProjetos(Request $request)
    {
        try {
            $dataForm = $request->all();
            $projetos = $this->projetoController->filtrar($dataForm);
            $modal = true;
            $categorias = Categoria::all();
            return view('admin.projeto.relatorios', compact('projetos', 'modal', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }

    public function informacoes(Request $request)
    {

        $ano = $request->input('ano');

        $alunoMasculinoPorCategoria = [];
        $alunoFemininoPorCategoria = [];
        $professoresPorCategoria = [];
        $numeroEscolas = [];
        $numeroProjetosl = [];
        $categorias = ['', 'Educação Infantil', 'EMEF 1', 'EMEF 2', 'EMEF 3', 'EJA'];

        for ($i = 1; $i <= 5; $i++) {
            //Faz pesquisa dos alunos femininos e masculinos
            $alunoMasculino = Aluno::where('categoria_id', $i)
                ->where('sexo', 'masculino')
                ->where('ultimoProjeto', $ano)
                ->count();

            $alunoFeminino = Aluno::where('categoria_id', $i)
                ->where('sexo', 'feminino')
                ->where('ultimoProjeto', $ano)
                ->count();

            $alunoMasculinoPorCategoria[$i] = $alunoMasculino;
            $alunoFemininoPorCategoria[$i] = $alunoFeminino;

            //Faz pesquisa dos professores por categorias
            $professores = DB::table('professores_projetos')
                ->join('professores', 'professores_projetos.professor_id', '=', 'professores.id')
                ->join('projetos', 'professores_projetos.projeto_id', '=', 'projetos.id')
                ->where('projetos.ano', $ano)
                ->where('projetos.categoria_id', $i)
                ->select('professor_id', 'projeto_id', 'categoria_id')
                ->orderBy('professor_id')
                ->distinct()
                ->get()
                ->count();

            $professoresPorCategoria[$i] = $professores;

            //Faz pesquisa numeros de escolas por categorias
            $escolas = Projeto::where('ano', $ano)
                ->where('categoria_id', $i)->distinct()->count('escola_id');

            $numeroEscolas[$i] = $escolas;

            //Faz pesquisa numero de projetos por categoria
            if ($i == 1) {
                $projetos = Projeto::where('categoria_id', $i)->where('ano', $ano)->count();
                $numeroProjetos[$i] = $projetos;
            } else {
                $projetos = DB::table('alunos_projetos')->join('projetos', 'alunos_projetos.projeto_id', '=', 'projetos.id')
                    ->where('categoria_id', $i)
                    ->where('ano', $ano)
                    ->select('id', 'categoria_id', 'aluno_id', 'projeto_id', 'etapa_projeto')
                    ->select(DB::raw('count(projeto_id) as numero_alunos, id, categoria_id'))
                    ->where('aluno_id', '!=', 'null')
                    ->groupBy('id')
                    ->get()->count();
                $numeroProjetos[$i] = $projetos;
            }
        }

        // dd($alunoMasculinoPorCategoria, $alunoFemininoPorCategoria, $professoresPorCategoria, $numeroEscolas, $numeroProjetos);

        return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.projeto.informacoes', compact('alunoMasculinoPorCategoria', 'alunoFemininoPorCategoria', 'professoresPorCategoria', 'numeroEscolas', 'numeroProjetos', 'categorias', 'ano'))
            ->stream('informacoes-projeto' . $ano . '.pdf');
    }

}
