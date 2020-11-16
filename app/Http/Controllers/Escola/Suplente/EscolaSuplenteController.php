<?php


namespace App\Http\Controllers\Escola\Suplente;

use App\Aluno;
use App\Disciplina;
use App\Escola;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SuplenteController;
use App\Limite;
use App\Professor;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EscolaSuplenteController extends Controller
{

    private $suplenteController;

    public function __construct(SuplenteController $suplenteController)
    {
        //No construtor da classe é carregado o controller projetoController. Lá é onde se encontra todos os códigos relacionados ao CRUD de projetos.
        $this->suplenteController = $suplenteController;
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
             *sejam projetos suplentes
             *e retorno em ordem alfabética
            */
            $projetos = Projeto::where('ano', '=', intval(date("Y")))
                ->where('tipo', '=', 'suplente')
                ->where('escola_id', '=', Auth::user()->escola->id)
                ->orderBy('titulo', 'asc')
                ->paginate(10);

            return view('escola.suplente.home', compact('projetos'));
        } catch (\Exception $e) {
            return abort(200, '260');
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
             *sejam projetos suplentes
             *e retorno em ordem alfabética
            */
            $projetos = DB::table('projetos')
                ->select('categoria_id')
                ->where('ano', '=', intval(date("Y")))
                ->where('escola_id', '=', $escola->id)
                ->where('tipo', '=', 'suplente')
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
            //retornando para a view escola.suplente.cadastro com as informações acima
            return view("escola.suplente.cadastro", compact('disciplinas', 'escola', 'categorias', 'professores'));
        } catch (\Exception $e) {
            return abort(200, '261');
        }
    }


    public function store(Request $request)
    {
        //verifico se está no periodo de inscricao
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //recebo os dados por request e insiro o escola_id artificialmente
            $dataForm = $request->all() + ['escola_id' => Auth::user()->escola->id]
                + ['tipo' => 'suplente']
                + ['tipoEscola' => Auth::user()->escola->tipo];

            $validator = Validator::make($dataForm, [
                'resumo'            => 'required|between:50,3000',
                'disciplina_id'     => 'required',

                'disciplina_id.required'=> 'Selecione ao menos uma disciplina',
                'resumo.required'       => 'Insira um resumo',
                'resumo.between'        => 'O resumo deve ter entre 50 e 3000 caracteres',
            ]);

            //se o validador falhar...
            if ($validator->fails()) {
                //retorna para a rota 'escola.config.alterar-senha'
                return redirect()->route('escola.suplente.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            //passo o dataForm para o store de projetoController
            $this->suplenteController->store($dataForm);
            //redireciono para a rota de escola.projeto
            return redirect()->route("escola.suplente");
        } catch (\Exception $e) {
            return abort(200, '262');
        }
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
            return view("escola.suplente.show", compact('projeto', 'alunos', 'professores'));
        } catch (\Exception $e) {
            return abort(200, '263');
        }
    }


    public function edit($id)
    {
		
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o projeto informado pela URL pertence a escola.
        // $inscricao = \App\Inscricao::all()->last();
        // $this->authorize('view', $inscricao);
        // $projeto = Projeto::findOrFail($id);
        // $this->authorize('edit', $projeto);
		// dd('teste');
        // try {
            // $disciplinas = Disciplina::all();
            // $alunos = Aluno::where('escola_id', '=', Auth::user()->escola->id)
                // ->where('categoria_id', '=', $projeto->categoria->id)
                // ->where('ultimoProjeto', '=', null)
                // ->get();
            // foreach ($projeto->aluno as $aluno){
                // $alunos[] = $aluno;
            // }
            // $professores = [];
            // $limite = Limite::latest()->first();
            // foreach(Auth::user()->escola->professor as $professor){
                // if(count($professor->projeto)<$limite->limite) {
                    // $professores[] = $professor;
                // }
            // }
            // $titulo = 'Editar projeto: ' . $projeto->titulo;
            // return view("escola.suplente.editar", compact('projeto', 'titulo', 'disciplinas', 'escola', 'alunos', 'professores'));
        // } catch (\Exception $e) {
            // return abort(200, '264');
        // }
		
		      try {
            $projeto = Projeto::findOrFail($id);
            $disciplinas = Disciplina::all();
            $escola = Escola::find($projeto->escola->id);
            $alunos = Aluno::where('escola_id', '=', $escola->id)
                ->where('categoria_id', '=', $projeto->categoria->id)
                ->where('ultimoProjeto', '=', null)
                ->get();
            foreach ($projeto->aluno as $aluno){
                $alunos[] = $aluno;
            }
			
            $professores = [];
            foreach($escola->professor as $professor){
                $professores[] = $professor;
            }
			
            $titulo = 'Editar projeto: ' . $projeto->titulo;
			
            return view("escola.suplente.editar", compact('projeto', 'titulo', 'disciplinas', 'escola', 'alunos', 'professores'));
        } catch (\Exception $e) {
            return abort(100, '195');
        }
		
    }


    public function filtrar(Request $request)
    {
        try {
            //recebendo os dados por request
            $dataForm = array_filter($request->all());
            //passando os dados por parametro
            $projetos = $this->suplenteController->filtrar($dataForm);
            //retornando para a vire escola.projeto.home
            return view('escola.suplente.home', compact('projetos'));
        } catch (\Exception $e) {
            return abort(200, '265');
        }
    }


    public function update(Request $request, $id)
    {
		
        $dataForm = $request->all() + ['tipo' => 'suplente'];
        // try {
            $this->suplenteController->update($dataForm, $id);
            return redirect()->route("escola.suplente");
        // } catch (\Exception $e) {
            // return abort(100, '196');
        // }
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
            return abort(200, '267');
        }
    }

    public function alunos()
    {
        try {
            $categoria_id = Input::get('categoria_id');
            $alunos = Aluno::where('escola_id', '=', Auth::user()->escola->id)
                ->where('categoria_id', '=', $categoria_id)
                ->where('ultimoProjeto', '!=', date('Y'))
                ->get();
            return response()->json($alunos);
        } catch (\Exception $e) {
            return abort(100, '189.3');
        }
    }


}