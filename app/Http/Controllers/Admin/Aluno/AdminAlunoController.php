<?php

namespace App\Http\Controllers\Admin\Aluno;

use App\Aluno;
use App\Dado;
use App\Escola;
use App\Etapa;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Aluno\AlunoCreateFormRequest;
use App\Http\Requests\Aluno\AlunoUpdateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminAlunoController extends Controller
{

    private $alunoController;

    public function __construct(AlunoController $alunoController)
    {
        $this->alunoController = $alunoController;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $alunos = Aluno::orderBy('name', 'asc')->paginate(10);
            $quantidade = count(Aluno::all());
            return view('admin.aluno.home', compact('alunos', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '110');
        }
    }
    public function indexCertificados()
    {
        
       
            $alunosAll = Aluno::orderBy('name', 'asc')->get();
            $alunos = [];
            
            

            for ($i = 0; $i < count($alunosAll); $i++) {               
                if ($alunosAll[$i]->ultimoProjeto == date('Y')) {   
                    if(isset($alunosAll[$i]->projeto[count($alunosAll[$i]->projeto) - 1]))  {          
                    if ($alunosAll[$i]->projeto[count($alunosAll[$i]->projeto) - 1]->ano == date('Y')) {
                        $alunos[$i] = $alunosAll[$i];
                    }
                }
                }
            }
            
            
            $quantidade = count($alunos);
            return view('admin.aluno.homeCertificados', compact('alunos', 'quantidade'));
        
    }
    public function create()
    {
        try {
            $escolas = Escola::all();
            return view('admin.aluno.cadastro', compact('escolas'));
        } catch (\Exception $e) {
            return abort(100, '111');
        }
    }

    public function store(AlunoCreateFormRequest $request)
    {
        try {
            $request['cpf'] = str_replace("-", "",  $request['cpf']);
            $request['cpf'] = str_replace(".", "",  $request['cpf']);
            $dataForm = $request->all();
            $this->alunoController->store($dataForm);
            return redirect()->route("admin.aluno");
        } catch (\Exception $e) {
            return abort(100, '112');
        }
    }

    public function show($id)
    {
        try {
            $aluno = Aluno::findOrFail($id);
            return view('admin.aluno.show', compact('aluno'));
        } catch (\Exception $e) {
            return abort(100, '113');
        }
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = $request->all();
            $alunos = $this->alunoController->filtro($dataForm);
            $quantidade = $alunos->total();
            return view('admin.aluno.home', compact('alunos', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '114');
        }
    }

    public function edit($id)
    {
        try {
            $aluno = Aluno::findOrFail($id);
            $titulo = "Editar aluno: " . $aluno->name;
            $escolas = Escola::all();
            $idEtapa =   Etapa::where('etapa','=', $aluno->etapa)->first();
            return view("admin.aluno.cadastro", compact('aluno', 'titulo', 'escolas','idEtapa'));
        } catch (\Exception $e) {
            return abort(100, '115');
        }
    }

    public function update(AlunoUpdateFormRequest $request, $id)
    {
        try {
            $request['cpf'] = str_replace("-", "",  $request['cpf']);
            $request['cpf'] = str_replace(".", "",  $request['cpf']);
            $dataForm = $request->all() + ['tipoUser' => 'aluno'];
            $alunos = $this->alunoController->update($dataForm, $id);
            return redirect()->route("admin.aluno");
        } catch (\Exception $e) {
            return abort(100, '116');
        }
    }

    public function destroy($id)
    {
        try {
            $this->alunoController->destroy($id);
        } catch (\Exception $e) {
            return abort(100, '117');
        }
    }

    public function escolaCategoria()
    {
        try {
            $escola_id = Input::get('escola_id');
            $escola = Escola::findOrFail($escola_id);
            $ano = [];
            foreach ($escola->categoria as $categoria) {
                foreach ($categoria->etapa as $etapa) {
                    $ano[] = $etapa;
                }
            }
            return response()->json($ano);
        } catch (\Exception $e) {
            return abort(100, '118');
        }
    }
}
