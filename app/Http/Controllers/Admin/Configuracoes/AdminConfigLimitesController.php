<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Limite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminConfigLimitesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $limite = Limite::latest()->first();
            return view('admin.config.limites', compact('limite'));
        } catch (\Exception $e) {
            return abort(100,  '140');
        }
    }

    public function store(Request $request)
    {
        try {
            $dataForm = $request->all();
            $limite = Limite::create($dataForm);
            Session::put('mensagem', "O limite de projetos por professor foi salvo com sucesso!");
            return redirect()->route("admin.config.limites");
        } catch (\Exception $e) {
            return abort(100,  '141');
        }
    }

}