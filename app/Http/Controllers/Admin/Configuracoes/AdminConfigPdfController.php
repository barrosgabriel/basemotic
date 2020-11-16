<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminConfigPdfController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            return view('admin.config.pdf');
        } catch (\Exception $e) {
            return abort(100, '148');
        }
    }

    public function termos()
    {
        try {
            return view('admin.config.termos-escola');
        } catch (\Exception $e) {
            return abort(100, '148.1');
        }
    }

    public function regras()
    {
        try {
            return view('admin.config.regras-regulamentos');
        } catch (\Exception $e) {
            return abort(100, '148.2');
        }
    }

    public function carregaRegrasDeAutorizacao(Request $request)
    {
        try {
            if ($request->file('pdf')) {

                $extensao = $request->pdf->extension();
                $nameFile = "regras-motic.$extensao";
                $destinationPath = "regras";

                $request->file('pdf')->move($destinationPath, $nameFile);

                $texto = 'O usuário '.Auth::user()->username.' fez o upload do pdf regras-motic.';
                return redirect()->back();
            }

        } catch (\Exception $e) {
            return abort(100, '148.3');
        }
    }

    public function carregaRegulamento(Request $request)
    {
        try {
            if ($request->file('pdf')) {
                $extensao = $request->pdf->extension();

                $nameFile = "regulamento-motic.$extensao";

                $destinationPath = "regulamentos";

                $request->file('pdf')->move($destinationPath, $nameFile);


                $texto = 'O usuário '.Auth::user()->username.' fez o upload do pdf regulamento-motic.';
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return abort(100, '148.4');
        }
    }

    public function carregaTermoMenor(Request $request)
    {
        try {
            if ($request->file('pdf')) {
                $extensao = $request->pdf->extension();
                $nameFile = "termo-menor-motic.$extensao";

                $destinationPath = "termos";
                $request->file('pdf')->move($destinationPath, $nameFile);

                $texto = 'O usuário '.Auth::user()->username.' fez o upload do pdf termo-menor-motic.';
                return redirect()->back();
            }

        } catch (\Exception $e) {
            return abort(100, '148.5');
        }
    }

    public function carregaTermoMaior(Request $request)
    {
        try {
            if ($request->file('pdf')) {
                $extensao = $request->pdf->extension();
                $nameFile = "termo-maior-motic.$extensao";

                $destinationPath = "termos";
                $request->file('pdf')->move($destinationPath, $nameFile);

                $texto = 'O usuário '.Auth::user()->username.' fez o upload do pdf termo-maior-motic.';
                return redirect()->back();
            }

        } catch (\Exception $e) {
            return abort(100, '148.6');
        }
    }

    public function carregaContratoConvivencia(Request $request)
    {
        try {
            if ($request->file('pdf')) {
                $extensao = $request->pdf->extension();
                $nameFile = "contrato-convivencia-motic.$extensao";
                $destinationPath = "termos";
                $request->file('pdf')->move($destinationPath, $nameFile);

                $texto = 'O usuário '.Auth::user()->username.' fez o upload do pdf contrato-convivencia-motic.';
                return redirect()->back();
            }

        } catch (\Exception $e) {
            return abort(100, '148.7');
        }
    }

    public function carregaFichaDeAvaliacao(Request $request)
    {
        try {
            if ($request->file('pdf')) {
                $extensao = $request->pdf->extension();
                $nameFile = "ficha-de-avaliacao-motic.$extensao";
                $destinationPath = "termos";
                $request->file('pdf')->move($destinationPath, $nameFile);
                $texto = 'O usuário '.Auth::user()->username.' fez o upload do pdf ficha-de-avaliacao-motic.';
                return redirect()->back();
            }

        } catch (\Exception $e) {
            return abort(100, '148.8');
        }
    }
}
