<?php

namespace App\Http\Controllers\Admin\Projeto;

use App\Aluno;
use App\Avaliador;
use App\Disciplina;
use App\Escola;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjetoController;
use App\Http\Requests\Projeto\ProjetoUpdateFormRequest;
use App\Limite;
use App\Professor;
use App\Projeto;
use App\Suplente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AdminProjetoController extends Controller
{

    private $projetoController;
    private $escola;
    private $professor;

    public function __construct(ProjetoController $projetoController, Professor $professor, Escola $escola)
    {
        $this->projetoController = $projetoController;
        $this->professor = $professor;
        $this->escola = $escola;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $projetos = Projeto::where('ano', '=', intval(date("Y")))
                ->where('tipo', '=', 'normal')
                ->with('escola')
                ->orderBy('titulo', 'asc')
                ->get();
            $QTprojetos = Projeto::where('ano', '=', intval(date("Y")))->where('tipo', '=', 'normal')->get();
            $quantidade = count($QTprojetos);
            return view('admin.projeto.home', compact('projetos', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '180');
        }
    }

    public function create()
    {
        try {
            $disciplinas = Disciplina::all();
            $escolas = Escola::orderBy('name', 'asc')->get();
            return view("admin.projeto.cadastro", compact('disciplinas', 'escolas'));
        } catch (\Exception $e) {
            return abort(100, '181');
        }
    }

    public function store(Request $request)
    {

            $request->validate([
                'titulo' => 'required',
                'area' => 'required',
                'resumo' => 'required',
                'metodologia' => 'required',
                'recurso' => 'required',
                'avaliacao' => 'required',
                'escola_id' => 'required',
                'orientador' => 'required',

            ]);


            $dataForm = $request->all();

            $escola = Escola::findOrFail($dataForm['escola_id']);


            $dataForm = $dataForm + ['tipoEscola' => $escola->tipo];

            $this->projetoController->store($dataForm);
            return redirect()->route("admin.projeto");

    }

    public function show($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            return view("admin.projeto.show", compact('projeto'));
        } catch (\Exception $e) {
            return abort(100, '183');
        }
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = array_filter($request->all());
            $projetos = $this->projetoController->filtrar($dataForm);
            $quantidade = $projetos->total();
            return view('admin.projeto.home', compact('projetos', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '184');
        }
    }

    public function edit($id)
    {
        // try {
            $projeto = Projeto::findOrFail($id);
            $disciplinas = Disciplina::all();
            $escola = Escola::find($projeto->escola->id);
            $alunos = Aluno::where('escola_id', '=', $escola->id)
                ->where('categoria_id', '=', $projeto->categoria->id)
                ->where('ultimoProjeto', '=', null)
                ->get();
            foreach ($projeto->aluno as $aluno){
                $alunos[] = $aluno;
            }
            $professores = [];
            foreach($escola->professor as $professor){
                $professores[] = $professor;
            }
            $titulo = 'Editar projeto: ' . $projeto->titulo;
            return view("admin.projeto.editar", compact('projeto', 'titulo', 'disciplinas', 'escola', 'alunos', 'professores'));
        // } catch (\Exception $e) {
        //     return abort(100, '185');
        // }
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        //dd($dataForm);
        // try {
            $this->projetoController->update($dataForm, $id);
            return redirect()->route("admin.projeto");
        // } catch (\Exception $e) {
        //     return abort(100, '186');
        // }
    }

    public function destroy($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);

            $countProfessorNoProjeto = count($projeto->professor);

            if ($projeto->turno == 1) {

                for ($i = 0; $i < $countProfessorNoProjeto; $i++) {
                    $professor = $projeto->professor[$i];
                    $professor->manha = 0;
                    $professor->qtProjetos -=1;
                    $professor->update();
                }
            } else if ($projeto->turno == 2) {

                for ($i = 0; $i < $countProfessorNoProjeto; $i++) {
                    $professor = $projeto->professor[$i];
                    $professor->tarde = 0;
                    $professor->qtProjetos -=1;
                    $professor->update();
                }
            } else {

                for ($i = 0; $i < $countProfessorNoProjeto; $i++) {
                    $professor = $projeto->professor[$i];
                    $professor->noite = 0;
                    $professor->qtProjetos -=1;
                    $professor->update();
                }
            }


            $avaliadores = $projeto->avaliador;

            foreach ($avaliadores as $avaliador) {
                $avaliador = Avaliador::findOrFail($avaliador->id);
                $avaliador->projetos -= 1;
                $avaliador->update();
            }
               
            


            $this->projetoController->destroy($id);
        } catch (\Exception $e) {
            return abort(100, '187');
        }
    }

    public function rebaixaSuplente($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $projeto->update(['tipo' => 'suplente']);
            Session::put('mensagem', 'O projeto ' . $projeto->titulo . ' foi rebaixado para suplente com sucesso!');
            return redirect()->route("admin.projeto");
        } catch (\Exception $e) {
            return abort(100, '188');
        }
    }

    public function vincularAvaliador($id)
    {
        try {
         $avaliadoresAll = Avaliador::orderBy('name', 'asc')
                            ->where('projetos', '<', '5')->
                            whereHas('user', function($q){
                                $q->where('ativo', '=', 1);
                            })
                            ->get();


            $projeto = Projeto::findOrFail($id);
            $contador = 0;
            $contadorArray = 0;
			
            for ($i=0; $i < count($avaliadoresAll) ; $i++) {
                $contador = 0;
                for ($j=0; $j < count($projeto->avaliador); $j++) {
                    if($projeto->avaliador[$j]['name'] == $avaliadoresAll[$i]['name']){
                        $contador++;
                    }
                }
                if($contador == 0){

                    $avaliadores[$contadorArray++] =  $avaliadoresAll[$i];
                 }

            }
            return view('admin.projeto.vincular-avaliador', compact('avaliadores', 'projeto'));
        } catch (\Exception $e) {
            return abort(100, '189');
        }
    }

    public function vincula(Request $request)
    {
        try {
            
            $dataForm = $request->all();
            //dd($dataForm['avaliadores']);
            foreach ($dataForm['avaliadores'] as $id) {
                $avaliador = Avaliador::findOrFail($id);
                $avaliador->projeto()->attach(Session::get('id'));
                $tamanho = $avaliador->projetos;
                $avaliador->projetos += 1;
                $avaliador->update();
            }
            $tamanho = count($dataForm['avaliadores']);
            $projeto = Projeto::findOrFail(Session::get('id'));
            $projeto->avaliadores += $tamanho;
            $projeto->update();
            return redirect()->route("admin.projeto");
        } catch (\Exception $e) {
            return abort(100, '189.1');
        }
    }

    public function categorias()
    {
        try {
            $escola_id = Input::get('escola_id');
            Session::put('escola_id', $escola_id);
            $escola = $this->escola->findOrFail($escola_id);
            $projetos = DB::table('projetos')
                ->select('categoria_id')
                ->where('escola_id', '=', $escola->id)
                ->where('tipo', '=', 'normal')
                ->where('ano', '=', '' . date('Y'))
                ->get();
            $categoria_id = [];
            foreach ($projetos as $projeto) {
                $categoria_id[] = $projeto->categoria_id;
            }
            $categoria = $escola->categoria->whereNotIn('id', $categoria_id);
            return response()->json($categoria);
        } catch (\Exception $e) {
            return abort(100, '189.2');
        }
    }

    public function alunos()
    {
        try {
            $escola_id = Input::get('escola_id');
            $categoria_id = Input::get('categoria_id');


            $alunos = Aluno::where('escola_id', '=',$escola_id)->where('categoria_id', '=',$categoria_id)->orWhere('ultimoProjeto','=',null)->where('ultimoProjeto', '!=', date("Y"))->get();

            return response()->json($alunos);
        } catch (\Exception $e) {
            return abort(100, '189.3');
        }
    }

    public function professores()
    {
        try {
            $escola_id = Input::get('escola_id');
            $projeto_turno = Input::get('turno');


            if ($projeto_turno  == 1) {
                $manha = 0;
            } else if ($projeto_turno  == 2) {
                $tarde = 0;
            } else {
                $noite = 0;
            }

            $escola = Escola::find($escola_id);

            $limite = Limite::latest()->first();
			
            $professores = [];


            foreach ($escola->professor as $professor) {

                if (isset($manha)) {
					
                    if ($professor->qtProjetos < $limite->limite && $professor->manha == $manha) {

                        $professores[] = $professor;
                    }
                }
                else if (isset($tarde)) {

                    if ($professor->qtProjetos < $limite->limite && $professor->tarde == $tarde) {

                        $professores[] = $professor;
                    }
                }
               else if (isset($noite)) {
                    if ($professor->qtProjetos < $limite->limite && $professor->noite == $noite) {

                        $professores[] = $professor;
                    }
                }
            }

            return response()->json($professores);
         } catch (\Exception $e) {
            return abort(100, '189.4');
        }
    }

}
