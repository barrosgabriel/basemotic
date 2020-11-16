<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Categoria;
use App\Escola;
use App\Professor;
use App\Projeto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Redirect;

class SuplenteController extends Controller
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
    public function store($dataForm)
    {
        try {

            $ano = date('Y');
            $dataForm = $dataForm + ['tipo' => 'suplente'];
            $dataForm   += ['ano' => $ano];
            $projeto = Projeto::create($dataForm);
            $projeto->disciplina()->sync($dataForm['disciplina_id']);
			
            foreach ($dataForm['aluno_id'] as $aluno_id) {
                $aluno = Aluno::find($aluno_id);
                $aluno->ultimoProjeto = "".date('Y');
                $aluno->save();
                DB::table('alunos_projetos')->insert(
                    ['aluno_id' => $aluno->id, 'projeto_id' => $projeto->id, 'etapa_projeto' => $aluno->etapa]
                );
            }
            $projeto->aluno()->sync($dataForm['aluno_id']);


            $orientador = Professor::findOrFail($dataForm['orientador']);
            DB::table('professores_projetos')->insert(
                ['professor_id' => $orientador->id, 'projeto_id' => $projeto->id, 'tipo' => 'orientador', 'ano' => $ano]
            );

            if (isset($dataForm['coorientador'])) {
                $coorientador = Professor::findOrFail($dataForm['coorientador']);

                $coorientador->qtProjetos += 1;
                if($dataForm['turno'] == 1 && $coorientador->manha != 1 ){      //manha
                    $coorientador->manha = 1;
                }else if($dataForm['turno'] == 2 && $coorientador->tarde != 1){ //tarde
                    $coorientador->tarde = 1;
                }else if($dataForm['turno'] == 3 && $coorientador->noite != 1){ //noite
                    $coorientador->noite = 1;
                }

                $coorientador->update();
                DB::table('professores_projetos')->insert(
                    ['professor_id' => $coorientador->id, 'projeto_id' => $projeto->id, 'tipo' => 'coorientador', 'ano' => $ano]
                );
            }

            //lucas
            $orientador->qtProjetos += 1;
            if($dataForm['turno'] == 1 && $orientador->manha != 1 ){      //manha
                $orientador->manha = 1;
            }else if($dataForm['turno'] == 2 && $orientador->tarde != 1){ //tarde
                $orientador->tarde = 1;
            }else if($dataForm['turno'] == 3 && $orientador->noite != 1){ //noite
                $orientador->noite = 1;
            }
            $orientador->update();

            //lucas
            Session::put('mensagem', "O projeto " . $projeto->titulo . " foi salvo com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1400');
        }
    }

    public function filtrar($dataForm)
    {
        try {
            $projetos = Projeto::where(function ($query) use ($dataForm) {
                if (array_key_exists('titulo', $dataForm)) {
                    $filtro = $dataForm['titulo'];
                    $query->where('titulo', "like", "%{$filtro}%");
                }
                if (array_key_exists('escola', $dataForm)) {
                    $filtro = $dataForm['escola'];
                    $p = Escola::where('name', 'like', "%{$filtro}%")->get();
                    $query->whereIn('escola_id', $this->percorrerArray($p));
                }
                if (array_key_exists('categoria', $dataForm)) {
                    $filtro = $dataForm['categoria'];
                    $p = Categoria::where('categoria', 'like', "%{$filtro}%")->get();
                    $query->whereIn('categoria_id', $this->percorrerArray($p));
                }
                if (array_key_exists('edicao', $dataForm)) {
                    $filtro = $dataForm['edicao'];
                    $query->where('ano', "=", $filtro);
                }
            })
                ->where('tipo', '=', 'suplente')
                ->paginate(10);
            return $projetos;
        } catch (\Exception $e) {
            return abort(600, '1510');
        }
    }

    public function update($dataForm, $id)
    {
		
        try {
            $projeto = Projeto::findOrFail($id);
			
            $projeto->disciplina()->sync($dataForm['disciplina_id']);
            foreach ($projeto->aluno as $aluno) {
                $aluno->ultimoProjeto = "";
                $aluno->save();
            }
            foreach ($dataForm['aluno_id'] as $aluno_id) {
                $aluno = Aluno::find($aluno_id);
                $aluno->ultimoProjeto = "".date('Y');
                $aluno->save();
            }
            $projeto->aluno()->sync($dataForm['aluno_id']);
            $orientador = Professor::findOrFail($dataForm['orientador']);

			
            if ($projeto->turno == 1) {
                if ($orientador->manha != 1) {
                    $orientador->manha = 1;
                    $orientador->qtProjetos += 1;
                    $orientador->update();
                } else {
				
                    Session::put('mensagem', "O orientador já está cadastrado em um projeto no turno da manhã.");
					return Redirect::back();
                }
            } else if ($projeto->turno == 2) {

                if ($orientador->tarde != 1) {
                    $orientador->tarde = 1;
                    $orientador->qtProjetos += 1;
                    $orientador->update();
                } else {
                    Session::put('mensagem', "O orientador já está cadastrado em um projeto no turno da tarde.");
					return Redirect::back();
                }
            } else {

                if ($orientador->noite != 1) {
                    $orientador->noite = 1;
                    $orientador->qtProjetos += 1;
                    $orientador->update();
                } else {
                    Session::put('mensagem', "O orientador já está cadastrado em um projeto no turno da noite.");
					return Redirect::back();
                }
            }

			

            $countProfessorNoProjeto = count($projeto->professor);

            if ($projeto->turno == 1) {

                for ($i = 0; $i < $countProfessorNoProjeto; $i++) {
                    $professor = $projeto->professor[$i];
                    $professor->manha = 0;
                    $professor->qtProjetos -= 1;
                    $professor->update();
                }
            } else if ($projeto->turno == 2) {

                for ($i = 0; $i < $countProfessorNoProjeto; $i++) {
                    $professor = $projeto->professor[$i];
                    $professor->tarde = 0;
                    $professor->qtProjetos -= 1;
                    $professor->update();
                }
            } else {

                for ($i = 0; $i < $countProfessorNoProjeto; $i++) {
                    $professor = $projeto->professor[$i];
                    $professor->noite = 0;
                    $professor->qtProjetos -= 1;
                    $professor->update();
                }
            }

            DB::table('professores_projetos')->where(
                ['projeto_id' => $projeto->id, 'tipo' => 'orientador']
            )->delete();

            DB::table('professores_projetos')->insert(
                ['professor_id' => $orientador->id, 'projeto_id' => $projeto->id, 'tipo' => 'orientador', 'ano' => date('Y')]
            );
            if (isset($dataForm['coorientador'])) {
                $coorientador = Professor::findOrFail($dataForm['coorientador']);

                if ($projeto->turno == 1) {
                    if ($coorientador->manha != 1) {
                        $coorientador->manha = 1;
                        $coorientador->qtProjetos += 1;
                        $coorientador->update();
                    } else {
                        Session::put('mensagem', "O coorientador já está cadastrado em um projeto no turno da manhã.");
                        return redirect()->route("admin.suplente");
                    }
                } else if ($projeto->turno == 2) {

                    if ($coorientador->tarde != 1) {
                        $coorientador->tarde = 1;
                        $coorientador->qtProjetos += 1;
                        $coorientador->update();
                    } else {
                        Session::put('mensagem', "O coorientador já está cadastrado em um projeto no turno da tarde.");
                        return redirect()->route("admin.suplente");
                    }
                } else {

                    if ($coorientador->noite != 1) {
                        $coorientador->noite = 1;
                        $coorientador->qtProjetos += 1;
                        $coorientador->update();
                    } else {
                        Session::put('mensagem', "O coorientador já está cadastrado em um projeto no turno da noite.");
                        return redirect()->route("admin.suplente");
                    }
                }


                DB::table('professores_projetos')->where(
                    ['projeto_id' => $projeto->id, 'tipo' => 'coorientador']
                )->delete();
                DB::table('professores_projetos')->insert(
                    ['professor_id' => $coorientador->id, 'projeto_id' => $projeto->id, 'tipo' => 'coorientador', 'ano' => date('Y')]
                );
            }
            $projeto->update($dataForm);

            Session::put('mensagem', "O projeto " . $projeto->titulo . " foi editado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1520');
        }
    }

    public function destroy($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $projeto->delete($id);
            Session::put('mensagem', "O projeto " . $projeto->titulo . " foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1530');
        }
    }

    private function percorrerArray($data)
    {
        $array[] = null;
        foreach ($data as $id) {
            $array[] = $id->id;
        }
        return $array;
    }

}
