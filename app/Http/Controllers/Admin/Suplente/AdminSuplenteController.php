<?php

namespace App\Http\Controllers\Admin\Suplente;

use App\Aluno;
use App\Disciplina;
use App\Escola;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SuplenteController;
use App\Http\Requests\Projeto\ProjetoUpdateFormRequest;
use App\Limite;
use App\Professor;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AdminSuplenteController extends Controller
{

    private $suplenteController;
    private $escola;
    private $professor;

    public function __construct(SuplenteController $suplenteController, Professor $professor, Escola $escola)
    {
        $this->suplenteController = $suplenteController;
        $this->professor = $professor;
        $this->escola = $escola;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $projetos = Projeto::where('ano', '=', intval(date("Y")))
                ->where('tipo', '=', 'suplente')
                ->orderBy('titulo', 'asc')
                ->paginate(10);
            $QTprojetos = Projeto::where('ano', '=', intval(date("Y")))->where('tipo', '=', 'suplente')->get();
            $quantidade = count($QTprojetos);
            return view('admin.suplente.home', compact('projetos', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '190');
        }
    }

    public function create()
    {
        try {
            $disciplinas = Disciplina::all();
            $escolas = Escola::orderBy('name', 'asc')->get();
            return view("admin.suplente.cadastro", compact('disciplinas', 'escolas', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '191');
        }
    }

    public function store(Request $request)
    {
        try {
            if (!(isset($request['disciplina_id[]']))) {
                return redirect()->route('escola.suplente.cadastro');
            }

            $dataForm = $request->all() + ['tipo' => 'suplente'];
            if (!(isset($dataForm['orientador']))) {
                return redirect()->route('escola.suplente.cadastro');
            }
            $escola = Escola::findOrFail($dataForm['escola_id']);
            $dataForm = $dataForm + ['tipoEscola' => $escola->tipo];
            $this->suplenteController->store($dataForm);
            return redirect()->route("admin.suplente");
        } catch (\Exception $e) {
            return abort(100, '192');
        }
    }

    public function filtrar(Request $request)
    {
        $dataForm = $request->all();
        try {
            $projetos = $this->suplenteController->filtrar($dataForm);
            $quantidade = $projetos->total();
            return view('admin.suplente.home', compact('projetos', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '193');
        }
    }

    public function show($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $alunos = Aluno::all()
                ->where('projeto_id', '=', $projeto->id);
            $professores = Professor::all()
                ->where('projeto_id', '=', $projeto->id);
            return view("admin.suplente.show", compact('projeto', 'alunos', 'professores'));
        } catch (\Exception $e) {
            return abort(100, '194');
        }
    }

    public function edit($id)
    {
        try {
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
            return view("escola.suplente.editar", compact('projeto', 'titulo', 'disciplinas', 'escola', 'alunos', 'professores'));
        } catch (\Exception $e) {
            return abort(100, '195');
        }
    }

    public function update(Request $request, $id)
    {
		
		
        $dataForm = $request->all() + ['tipo' => 'suplente'];
        try {
            $this->suplenteController->update($dataForm, $id);
            return redirect()->route("admin.suplente");
        } catch (\Exception $e) {
            return abort(100, '196');
        }
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

            $this->suplenteController->destroy($id);
        } catch (\Exception $e) {
            return abort(100, '197');
        }
    }

    public function promoveSuplente($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $projeto->update(['tipo' => 'normal']);
            Session::put('mensagem', 'O projeto ' . $projeto->titulo . ' foi promovido para titular com sucesso!');
            return redirect()->route("admin.suplente");
        } catch (\Exception $e) {
            return abort(100, '198');
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
            $categoria_id = Input::get('categoria_id');
            $alunos = Aluno::where('escola_id', '=', Session::get('escola_id'))
                ->where('categoria_id', '=', $categoria_id)
                ->where('ultimoProjeto', '!=', date('Y'))
                ->get();
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

                    if ($professor->qtProjetos < $limite->limite && $professor->manha === $manha) {

                        $professores[] = $professor;
                    }
                }
                else if (isset($tarde)) {

                    if ($professor->qtProjetos < $limite->limite && $professor->tarde === $tarde) {

                        $professores[] = $professor;
                    }
                }
               else if (isset($noite)) {
                    if ($professor->qtProjetos < $limite->limite && $professor->noite === $noite) {

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
