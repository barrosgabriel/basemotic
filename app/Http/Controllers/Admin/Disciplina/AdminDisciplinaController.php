<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 14/05/2018
 * Time: 09:49
 */

namespace App\Http\Controllers\Admin\Disciplina;

use App\Disciplina;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Disciplina\DisciplinaCreateFormRequest;
use App\Http\Requests\Admin\Disciplina\DisciplinaUpdateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminDisciplinaController extends Controller
{

    private $disciplinas;

    public function __construct(Disciplina $disciplina)
    {
        $this->disciplinas = $disciplina;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $disciplinas = Disciplina::orderBy('name', 'asc')->get();
            $countQuantidade = Disciplina::all();
            $quantidade = count($countQuantidade);
            return view('admin.disciplinas.home', compact('disciplinas', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '150');
        }
    }

    public function store(DisciplinaCreateFormRequest $request)
    {
        try {
            $dataForm = $request->all();
            $disciplinas = Disciplina::create($dataForm);
            Session::put('mensagem', "Disciplina " . $disciplinas->name . " adicionada com sucesso!");
            return redirect()
                ->route("admin.disciplina");
        } catch (\Exception $e) {
            return abort(100, '151');
        }
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = $request->all();
            if ($dataForm['tipo'] == 'id') {
                $disciplinas = Disciplina::all()->where('id', '=', $dataForm['search']);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $disciplinas = Disciplina::where('name', 'like', $filtro)->paginate(10);
            }
            $quantidade = $disciplinas->total();
            return view("admin.disciplinas.home", compact('disciplinas', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '152');
        }
    }

    public function edit($id)
    {
        try {
            $disciplina = disciplina::findOrFail($id);
            return view("admin.disciplinas.editar", compact('disciplina'));
        } catch (\Exception $e) {
            return abort(100, '153');
        }
    }

    public function update(DisciplinaUpdateFormRequest $request, $id)
    {
        try {
            $dataForm = $request->all();
            $disciplinas = Disciplina::findOrFail($id);
            $disciplinas->update($dataForm);
            Session::put('mensagem', 'A disciplina ' . $disciplinas->name . ' foi editada com sucesso!');
            $disciplinas = Disciplina::all();
            $quantidade = count($disciplinas);
            return view('admin.disciplinas.home', compact('disciplinas','quantidade'));
        } catch (\Exception $e) {
            return abort(100, '154');
        }
    }

    public function destroy($id)
    {
        try {
            $disciplina = Disciplina::findOrFail($id);
            $disciplina->delete($id);
            Session::put('mensagem', 'A disciplina ' . $disciplina->name . ' foi deletada com sucesso!');

        } catch (\Exception $e) {
            return abort(100, '155');
        }
    }

}