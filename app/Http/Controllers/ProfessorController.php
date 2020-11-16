<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Escola;
use App\Professor;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

class ProfessorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function filtro($dataForm)
    {
        try {
            if ($dataForm['tipo'] == 'id') {
                $professores = Professor::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $professores = Professor::where('name', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'escola') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escola = Escola::where('name', 'like', $filtro)->get();
                $array[] = null;
                foreach ($escola as $id) {
                    $array[] = $id->id;
                }
                $professores = Professor::whereIn('escola_id', $array)->paginate(10);
            } else if ($dataForm['tipo'] == 'cpf') {
                $professores = Professor::where('cpf', '=', $dataForm['search'])->paginate(10);
            }

            return $professores;
        } catch (\Exception $e) {
            return abort(600, '1300');
        }
    }


    public function store($dataForm)
    {
        try {
            $user = User::create([
                'name' => $dataForm['name'],
                'username' => strtolower($dataForm['username']),
                'email' => strtolower($dataForm['email']),
                'password' => bcrypt($dataForm['password']),
                'tipoUser' => $dataForm['tipoUser'],
            ]);
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome)), 'user_id' => $user->id];
            $professor = Professor::create($dataForm);
            $professor->escola()->sync($dataForm['escola_id']);
            Endereco::create($dataForm);
            Session::put('mensagem', "O professor " . $user->name . " foi criado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1310');
        }
    }
    
    // public function store($dataForm)
    // {
    //     try {
    //         $user = User::create([
    //             'name' => $dataForm['name'],
    //             'username' => strtolower($dataForm['username']),
    //             'email' => strtolower($dataForm['email']),
    //             'password' => bcrypt($dataForm['password']),
    //             'tipoUser' => $dataForm['tipoUser'],
    //         ]);
    //         $nome = $dataForm['name'];
    //         unset($dataForm['name']);
    //         $dataForm += ['name' => ucwords(strtolower($nome)), 'user_id' => $user->id];
    //         $professor = Professor::create($dataForm);
    //         $professor->escola()->sync($dataForm['escola_id']);
    //         Endereco::create($dataForm);
    //         Session::put('mensagem', "O professor " . $user->name . " foi criado com sucesso!");
    //     } catch (\Exception $e) {
    //         return abort(600, '1310');
    //     }
    // }


    public function update($dataForm, $id)
    {
        try {
            $user = User::findOrFail($id);
            $professor = $user->professor;
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome))];
            $professor->update($dataForm);
            $professor->escola()->sync($dataForm['escola_id']);
            $endereco = $user->endereco;
            $endereco->update($dataForm);
            Session::put('mensagem', "O professor " . $user->name . " foi editado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1320');
        }
    }


    public function destroy($id)
    {
        try {
            $professor = Professor::findOrFail($id);
            $professor->user()->delete($id);
            $professor->delete();
            Session::put('mensagem', "O professor " . $professor->name . " foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1330');
        }
    }


}
