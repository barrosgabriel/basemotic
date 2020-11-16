<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 14/05/2018
 * Time: 09:49
 */

namespace App\Http\Controllers\Professor\Projeto;

use App\Http\Controllers\Controller;
use App\Professor;
use App\Projeto;
use Illuminate\Support\Facades\Auth;

class ProfessorProjetoController extends Controller
{

    public function index()
    {
        try {
            $professor = Professor::where('id', '=', Auth::user()->professor->id)->with('projeto')->first();
            //encaminho para a view professor.projeto.home com o projeto encontrado
            return view('professor.projeto.home', compact('professor'));
        } catch (\Exception $e) {
            return abort(300, '320');
        }
    }

}