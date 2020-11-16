<?php

namespace App\Http\Controllers\Admin\Professor;

use App\Dado;
use App\Escola;
use App\Http\Controllers\ProfessorController;
use App\Http\Requests\Professor\ProfessorCreateFormRequest;
use App\Http\Requests\Professor\ProfessorUpdateFormRequest;
use App\Projeto;
use Illuminate\Support\Facades\Input;
use App\Professor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProfessorController extends Controller
{

    private $professorController;

    public function __construct(ProfessorController $professorController)
    {
        $this->professorController = $professorController;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $professores = Professor::orderBy('name', 'asc')->paginate(10);
            $quantidade = count(Professor::all());
            return view("admin.professor.home", compact('professores', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '170');
        }
    }


    public function indexCertificadosOrientadores()
    {
        try {
            $professoresAll = Professor::orderBy('name', 'asc')->get();
            $professores = [];

            $countProfessor = count($professoresAll);

            for ($i = 0; $i < count($professoresAll); $i++) {
                if (isset($professoresAll[$i]->projeto[count($professoresAll[$i]->projeto) - 1])) {
                    if ($professoresAll[$i]->projeto[count($professoresAll[$i]->projeto) - 1]->ano == date('Y')) {


                        $verifica = DB::select(DB::raw("SELECT * FROM professores_projetos WHERE professor_id =" . $professoresAll[$i]->id . "  and ano =" . date('Y') . ""));

                        for ($j = 0; $j < count($verifica); $j++) {
                            if ($verifica[$j]->tipo == 'orientador') {

                                $professores[$i] = $professoresAll[$i];
                            }
                        }
                    }
                }
            }

            $countProfessorFiltrados = count($professores);

            return view("escola.professor.homeCertificadosOrientadores", compact('professores', 'countProfessorFiltrados'));
        } catch (\Exception $e) {
            return abort(200, '240');
        }
    }


    public function indexCertificadosCoorientadores()
    {

        try {
            $professoresAll = Professor::orderBy('name', 'asc')->get();

            $professores = [];
            /* $escola_id = Auth::user()->id; */
            $arrayProfessorFiltro = [];



            for ($i = 0; $i < count($professoresAll); $i++) {
                if (isset($professoresAll[$i]->projeto[count($professoresAll[$i]->projeto) - 1])) {
                    if ($professoresAll[$i]->projeto[count($professoresAll[$i]->projeto) - 1]->ano == date('Y')) {
                        $verifica = DB::select(DB::raw("SELECT * FROM professores_projetos WHERE professor_id =" . $professoresAll[$i]->id . "  and ano =" . date('Y') . ""));

                        for ($j = 0; $j < count($verifica); $j++) {
                            if ($verifica[$j]->tipo == 'coorientador') {

                                $professores[$i] = $professoresAll[$i];
                            }
                        }
                    }
                }
            }


            $countProfessorFiltrados = count($professores);

            return view("escola.professor.homeCertificadosCoorientadores", compact('professores', 'countProfessorFiltrados'));
        } catch (\Exception $e) {
            return abort(200, '240');
        }
    }


    public function create()
    {
        try {
            $escolas = Escola::all();
            $titulo = 'Cadastrar professor';
            return view('admin.professor.cadastro', compact('escolas', 'titulo'));
        } catch (\Exception $e) {
            return abort(100, '171');
        }
    }

    public function store(ProfessorCreateFormRequest $request)
    {
        // try {
            $dataForm = $request->all() + ['tipoUser' => 'professor'];
            $this->professorController->store($dataForm);
            return redirect()->route("admin.professor");
        // } catch (\Exception $e) {
            // return abort(100, '172');
        // }
    }

    public function show($id)
    {
        try {
            $professor = Professor::findOrFail($id);
            return view("admin.professor.show", compact('professor'));
        } catch (\Exception $e) {
            return abort(100, '173');
        }
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = $request->all();
            $professores = $this->professorController->filtro($dataForm);
            $quantidade = $professores->total();
            return view('admin.professor.home', compact('professores', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '174');
        }
    }

    public function edit($id)
    {
        try {
            $professor = Professor::with('escola')->where('id', '=', $id)->first();
            $escolas = Escola::all();
            $titulo = 'Editar professor: ' . $professor->name;
            return view("admin.professor.cadastro", compact('professor', 'titulo', 'escolas'));
        } catch (\Exception $e) {
            return abort(100, '175');
        }
    }

    public function update(ProfessorUpdateFormRequest $request, $id)
    {
        try {
            $dataForm = $request->all() + ['tipoUser' => 'professor'];
            $this->professorController->update($dataForm, $id);
            return redirect()->route("admin.professor");
        } catch (\Exception $e) {
            return abort(100, '176');
        }
    }

    public function destroy($id)
    {
        try {
            $this->professorController->destroy($id);
        } catch (\Exception $e) {
            return abort(100, '177');
        }
    }

}
