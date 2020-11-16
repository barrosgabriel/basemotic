<?php

namespace App\Http\Controllers\Avaliador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avaliador;

class AvaliadorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $avaliador = Avaliador::find(Auth::user()->avaliador->id);
            $projetos = [];
            foreach ($avaliador->projeto as $projeto) {
                if ($projeto->ano == date('Y')) {
                    $projetos[] = $projeto;
                }
            }
            //retorno para a view avaliador.home
            foreach ($projetos as $projetoFilter) {
                if ((\App\Nota::where('projeto_id', '=', $projetoFilter->id)->where('avaliador_id', '=', \Illuminate\Support\Facades\Auth::user()->avaliador->id)->first()) != null) {
                    $liberaCertificado = 1;
                }
            }
            return view('avaliador.home', compact('liberaCertificado'));
        } catch (\Exception $e) {
            return abort(400, '400');
        }
    }
}
