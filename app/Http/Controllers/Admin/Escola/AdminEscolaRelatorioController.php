<?php

namespace App\Http\Controllers\Admin\Escola;

use App\Escola;
use App\Aluno;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\AlunoController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminEscolaRelatorioController extends Controller
{

    private $escolaController;
    private $alunoController;

    public function __construct(EscolaController $escolaController, AlunoController $alunoController)
    {
        $this->escolaController = $escolaController;
        $this->alunoController = $alunoController;
    }

    public function index()
    {
        try {
            $escolas = Escola::orderBy('name', 'asc')->paginate(10);
            return view('admin.escola.relatorios', compact('escolas'));
        } catch (\Exception $e) {
            return abort(100, '168');
        }
    }

    public function alunoCertificado($id)
    {   
        try {

            $aluno = Aluno::where('id','=',$id)->first();
            
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.aluno.alunoCertificado', compact('aluno'))->setPaper('a4', 'landscape')
                 ->stream('CertificadoAluno'. $aluno->id . date('Y') . '.pdf'); 
        } catch (\Exception $e) {
            return abort(100,  '119.3');
        }
    }


    public function todasEscolas()
    {
        // try {
            $escolas = Escola::orderBy('name', 'asc')->get();
			
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.escola.todas-escolas', compact('escolas'))
                ->stream('todas-escolas-motic' . date('Y') . '.pdf');
        // } catch (\Exception $e) {
            // return abort(100, '169');
        // }
    }

    public function escolaIndividual($id)
    {
        try {
            $escola = Escola::find($id);
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.escola.escola-individual', compact('escola'))
                ->stream($escola->name . '-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '169');
        }
    }

    public function escolaAvaliadores()
    {
        try {
            $escolas = Escola::orderBy('name', 'asc')->get();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.escola.escola-avaliadores', compact('escolas'))
                ->stream('avalaidores-escolas-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '169');
        }
    }

    public function filtro(Request $request)
    {
        try {
            $dataForm = $request->all();
            $escolas = $this->escolaController->filtro($dataForm);
            return view('admin.escola.relatorios', compact('escolas'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}