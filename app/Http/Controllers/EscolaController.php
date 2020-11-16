<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Escola;
use App\Projeto;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EscolaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');
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
                $escolas = Escola::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escolas = Escola::where('name', 'like', $filtro)->paginate(10);
            }
            return $escolas;
        } catch (\Exception $e) {
            return abort(600, '1200');
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
            $escola = Escola::create($dataForm + ['user_id' => $user->id]);
            foreach ($dataForm['categoria_id'] as $categoria) {
                $escola->categoria()->attach($categoria);
            }
            Endereco::create($dataForm + ['user_id' => $user->id]);
            Session::put('mensagem', "A escola " . $escola->name . " foi cadastrada com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1210');
        }
    }

    public function update($dataForm, $id)
    {
        try {
            $qntProjetos = $dataForm['categoria_id'];
            $user = User::findOrFail($id);
            $escola = $user->escola;
            $escola->update($dataForm + ['projetos' => count($qntProjetos)]);
            $escola->categoria()->detach();
            foreach ($dataForm['categoria_id'] as $categoria) {
                $escola->categoria()->attach($categoria);
            }
            $endereco = $user->endereco;
            $endereco->update($dataForm);
            Session::put('mensagem', "A escola " . $escola->name . " foi editada com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1220');
        }
    }

    public function destroy($id)
    {
        try {
            $escola = Escola::findOrFail($id);
            $escola->user()->delete($id);
            $escola->delete($id);
            Session::put('mensagem', "A escola " . $escola->name . " foi deletada com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1230');
        }
    }

}
