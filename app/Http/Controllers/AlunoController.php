<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Escola;
use App\Etapa;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{

    public function filtro($dataForm)
    {
        try {
            if ($dataForm['tipo'] == 'id') {
                $alunos = Aluno::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $alunos = Aluno::where('name', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'etapa') {
                $filtro = '%' . $dataForm['search'] . '%';
                $alunos = Aluno::where('etapa', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'escola') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escola = Escola::where('name', 'like', $filtro)->get();
                $array[] = null;
                foreach ($escola as $id) {
                    $array[] = $id->id;
                }
                $alunos = Aluno::whereIn('escola_id', $array)->paginate(10);
            }
            return $alunos;
        } catch (\Exception $e) {
            return abort(600, '1100');
        }
    }

    public function store($dataForm)
    {
        try {
            $etapa = Etapa::find($dataForm['categoria_id']);
            $dataForm += ['etapa' => $etapa->etapa];
            unset($dataForm['categoria_id']);
            $dataForm += ['categoria_id' => $etapa->categoria->id];
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome))];
            $aluno = Aluno::create($dataForm);
            Session::put('mensagem', "O aluno " . $aluno->name . " foi cadastrado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1110');
        }
    }

    public function update($dataForm, $id)
    {
        try {
         
            $etapa = Etapa::find($dataForm['categoria_id']);
            $dataForm += ['etapa' => $etapa->etapa];
            unset($dataForm['categoria_id']);
            $dataForm += ['categoria_id' => $etapa->categoria->id];
            $aluno = Aluno::findOrFail($id);
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome))];
            $aluno->update($dataForm);
            Session::put('mensagem', "O aluno " . $aluno->name . " foi editado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1120');
        }
    }

    public function destroy($id)
    {
        try {
            $aluno = Aluno::findOrFail($id);
            $aluno->delete($id);
            Session::put('mensagem', "O aluno " . $aluno->name . " foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1130');
        }
    }

}
