<?php

namespace App\Http\Controllers\Escola\Projeto;

use App\Aluno;
use App\Disciplina;
use App\Escola;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjetoController;
use App\Http\Requests\Projeto\ProjetoUpdateFormRequest;
use App\Limite;
use App\Professor;
use App\Projeto;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class EscolaProjetoController extends Controller
{

    private $projetoController;

    public function __construct(ProjetoController $projetoController)
    {
        //No construtor da classe é carregado o controller projetoController. Lá é onde se encontra todos os códigos relacionados ao CRUD de projetos.
        $this->projetoController = $projetoController;
        //Logo abaixo são carregados os middleware's responsáveis por fazer a o filtro de quem pode
        //acessar este controller. Ou seja, somente quem está autenticado e quem é escola pode acessar este controller.
        $this->middleware('auth');
        $this->middleware('check.escola');
    }

    public function index()
    {
        try {
            /* os projetos que:
             *sejam de 2018
             *sejam da escola atual logada no sistema
             *sejam projetos normais
             *e retorno em ordem alfabética
            */
            $projetos = Projeto::where('ano', '=', intval(date("Y")))
                ->where('tipo', '=', 'normal')
                ->where('escola_id', '=', Auth::user()->escola->id)
                ->orderBy('titulo', 'asc')
                ->paginate(10);
            //retorno para a view escola.projeto.home com os projeos
            return view('escola.projeto.home', compact('projetos'));
        } catch (\Exception $e) {
            return abort(200, '250');
        }
    }

    public function create()
    {
        //verifico se está no período de inscrição
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //busco as disciplinas do sistema
            $disciplinas = Disciplina::all();
            //procuro a escola atual logada no sistema
            $escola = Escola::findOrFail(Auth::user()->escola->id);
            /* os projetos que:
             *sejam de 2018
             *sejam da escola atual logada no sistema
             *sejam projetos normais
             *e retorno em ordem alfabética
            */
            $projetos = DB::table('projetos')
                ->select('categoria_id')
                ->where('ano', '=', intval(date("Y")))
                ->where('escola_id', '=', $escola->id)
                ->where('tipo', '=', 'normal')
                ->get();
            //iniciando um array de categoria_id
            $categoria_id = [];
            //percorrendo os projetos do sistema
            foreach ($projetos as $projeto) {
                //salvando as categorias que já estão em uso por projetos desta escola no array categoria_id
                $categoria_id[] = $projeto->categoria_id;
            }
            //buscando as categorias da escola que não estejam no array de categoria_id
            $categorias = $escola->categoria->whereNotIn('id', $categoria_id);
            //procurando os professores da escola que não estejam ligados a um projeto
            $limite = Limite::latest()->first();
            $professores = [];
            $array = 0;
            foreach ($escola->professor as $professor) {
                foreach($professor->projeto as $p){
                    if($p->pivot->ano == date('Y')){
                        $array += 1;
                    }
                }
                if($array<$limite->limite){
                    $professores[] = $professor;
                }
                $array = 0;
            }
            //retornando para a view escola.projeto.cadastro com as informações acima
            return view("escola.projeto.cadastro", compact('disciplinas', 'escola', 'categorias', 'professores'));
        } catch (\Exception $e) {
            return abort(200, '251');
        }
    }

    public function store(Request $request)
    {
       
        //verifico se está no periodo de inscricao
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        
            //recebo os dados por request e insiro o escola_id artificialmente
            $dataForm = $request->all() + ['escola_id' => Auth::user()->escola->id] + ['tipoEscola' => Auth::user()->escola->tipo];

            $validator = Validator::make($dataForm, [
                'resumo' => 'required|between:50,3000',
                'disciplina_id' => 'required',

                'disciplina_id.required' => 'Selecione ao menos uma disciplina',
                'resumo.required' => 'Insira um resumo',
                'resumo.between' => 'O resumo deve ter entre 50 e 3000 caracteres',
            ]);
           
            if ($request['turno'] == 1) {
                $manha = 0;
            } else if ($request['turno']  == 2) {
                $tarde = 0;
            } else {
                $noite = 0;
            }
            
            $orientador = Professor::findOrFail($request['orientador']);

            //verifico se o campo coorientador não é nulo, ou seja, não foi preenchido no cadastro do projeto, e aí sim crio a variável
            if($request['coorientador'] != null) {
            $coorientador = Professor::find($request['coorientador']);
            }
            $limite = Limite::latest()->first();
            

                   if (isset($manha)) {

                    if (!($orientador->qtProjetos < $limite->limite && $orientador->manha == $manha)) {
                        Session::put('mensagem-erro', 'O orientador já possui um projeto nesse turno');

                        return Redirect::back()->withInput(Input::all());

                    }
                    //verifico se a variável existe. É necessário porque o campo coorientador não é obrigatório, então pode ser passado nulo
                    if (isset($coorientador)) {
                        if (!($coorientador->qtProjetos < $limite->limite && $coorientador->manha == $manha)) {
                            Session::put('mensagem-erro', 'O coorientador já possui um projeto nesse turno');

                            return Redirect::back()->withInput(Input::all());
                        }
                    }
                }
                else if (isset($tarde)) {

                    if (!($orientador->qtProjetos < $limite->limite && $orientador->tarde == $tarde)) {

                        Session::put('mensagem-erro', 'O orientador já possui um projeto nesse turno');

                        return Redirect::back()->withInput(Input::all());
                    }
                    //verifico se a variável existe. É necessário porque o campo coorientador não é obrigatório, então pode ser passado nulo
                    if (isset($coorientador)) {
                        if (!($coorientador->qtProjetos < $limite->limite && $coorientador->tarde == $tarde)) {

                            Session::put('mensagem-erro', 'O coorientador já possui um projeto nesse turno');

                            return Redirect::back()->withInput(Input::all());
                        }
                    }
                }
               else if (isset($noite)) {
                    if (!($orientador->qtProjetos < $limite->limite && $orientador->noite == $noite)) {

                        Session::put('mensagem-erro', 'O orientador já possui um projeto nesse turno');

                        return Redirect::back()->withInput(Input::all());
                    }
                    //verifico se a variável existe. É necessário porque o campo coorientador não é obrigatório, então pode ser passado nulo
                    if (isset($coorientador)) {
                        if (!($coorientador->qtProjetos < $limite->limite && $coorientador->noite == $noite)) {

                            Session::put('mensagem-erro', 'O coorientador já possui um projeto nesse turno');

                            return Redirect::back()->withInput(Input::all());
                        }
                    }
                }
                
            //se o validador falhar...
            if ($validator->fails()) {
                //retorna para a rota 'escola.config.alterar-senha'
                return redirect()->route('escola.projeto.create')
                    ->withErrors($validator)
                    ->withInput();
            }
            
            //passo o dataForm para o store de projetoController
            $this->projetoController->store($dataForm);
            //redireciono para a rota de escola.projeto
            return redirect()->route("escola.projeto");
        

    }

    public function show($id)
    {
        //verifico se o projeto pertence a escola logada no sistema
        $projeto = Projeto::findOrFail($id);
        $this->authorize('show', $projeto);
        try {
            //procuro os alunos que pertencam ao projeto recebido por parametro
            $alunos = Aluno::all()
                ->where('projeto_id', '=', $projeto->id);
            //procuro os professores que pertencam ao projeto recebido por parametro
            $professores = Professor::all()
                ->where('projeto_id', '=', $projeto->id);
            //retorno para a view escola.projeto.show
            return view("escola.projeto.show", compact('projeto', 'alunos', 'professores'));
        } catch (\Exception $e) {
            return abort(200, '253');
        }
    }

    public function edit($id)
    {
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o projeto informado pela URL pertence a escola.
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        $projeto = Projeto::findOrFail($id);
        $this->authorize('edit', $projeto);
        try {
            $disciplinas = Disciplina::all();
            // $alunos = Aluno::where('escola_id', '=', Auth::user()->escola->id)
            //     ->where('categoria_id', '=', $projeto->categoria->id)
            //     ->where('ultimoProjeto', '=', null)
            //     ->where('ultimoProjeto', '=', date('Y'))
            //     ->get();
            foreach ($projeto->aluno as $aluno) {
                $alunos[] = $aluno;
            }
            //dd($alunos);
            $professores = [];
            $limite = Limite::latest()->first();
            foreach (Auth::user()->escola->professor as $professor) {
                if (count($professor->projeto) < $limite->limite) {
                    $professores[] = $professor;
                }
            }
            $titulo = 'Editar projeto: ' . $projeto->titulo;
            return view("escola.projeto.editar", compact('projeto', 'titulo', 'disciplinas', 'escola', 'alunos', 'professores'));

        } catch (\Exception $e) {
            return abort(200, '254');
        }
    }

    public function update(Request $request, $id)
    {
        //verifica se está dentro do período de inscrição
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        //try {
            //recebo os dados por request
            $dataForm = $request->all();
            //dd($dataForm);
            $validator = Validator::make($dataForm, [
                'resumo' => 'required|between:50,3000',
                'disciplina_id' => 'required',

                'disciplina_id.required' => 'Selecione ao menos uma disciplina',
                'resumo.required' => 'Insira um resumo',
                'resumo.between' => 'O resumo deve ter entre 50 e 3000 caracteres',
            ]);

            //se o validador falhar...
            if ($validator->fails()) {
                //retorna para a rota 'escola.projeto.edit'
                return redirect()->route('escola.projeto.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            //passo o dataForm e o id por parametro
            $this->projetoController->update($dataForm, $id);
            //redireciono para o escola.projeto
            return redirect()->route("escola.projeto");
        //} catch (\Exception $e) {
            //return abort(200, '255');
        //}
    }

    public function filtrar(Request $request)
    {
        try {
            //recebendo os dados por request
            $dataForm = array_filter($request->all());
            //passando os dados por parametro
            $projetos = $this->projetoController->filtrar($dataForm);
            //retornando para a vire escola.projeto.home
            return view('escola.projeto.home', compact('projetos'));
        } catch (\Exception $e) {
            return abort(200, '256');
        }
    }

    public function destroy($id)
    {
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o projeto informado pela URL pertence a escola.
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        $projeto = Projeto::findOrFail($id);
        $this->authorize('delete', $projeto);
        try {
            //passo o ID do projeto recebido pro ID a ser apagado para o método destroy dentro de ProjetoController.
            $this->projetoController->destroy($id);
            //por ser uma requisição em AJAX, não preciso retornar para a tela. O JQuery irá atualizar a tela.
        } catch (\Exception $e) {
            return abort(200, '257');
        }
    }

    public function alunos()
    {
        try {
            $categoria_id = Input::get('categoria_id');
            $alunos = Aluno::where('escola_id', '=', Auth::user()->escola->id)
                ->where('categoria_id', '=', $categoria_id)
                ->get();
            return response()->json($alunos);
        } catch (\Exception $e) {
            return abort(100, '189.3');
        }
    }

    public function retornaListaAlunos()
    {
        try {
            $escola_id = Input::get('escola_id');
            $categoria_id = Input::get('categoria_id');


            $alunos = Aluno::where('escola_id', '=',$escola_id)->where('categoria_id', '=',$categoria_id)->orWhere('ultimoProjeto','=',null)->where('ultimoProjeto', '!=', date("Y"))->get();

            return response()->json($alunos);
        } catch (\Exception $e) {
            return abort(100, '189.3');
        }
    }


}
