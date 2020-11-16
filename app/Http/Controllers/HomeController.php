<?php

namespace App\Http\Controllers;

use URL;
use App\Chancela;
use App\Categoria;
use App\Conteudo;
use App\Professor;
use App\Aluno;
use App\InformacoesMotic;
use App\Projeto;
use App\Avaliador;
use App\InscricaoAvaliadores;
use App\Dado;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Endereco;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Avaliador\AvaliadorCreateFormRequest;
use App\Http\Requests\Admin\Avaliador\AvaliadorUpdateFormRequest;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Helper\Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avaliacao = InscricaoAvaliadores::orderBy('id', 'desc')->first();
        if (isset($avaliacao)) {
            $data = new \DateTime();
            $nova_data = date('Y-m-d', strtotime($data->format('Y-m-d')));
            $de = date('Y-m-d', strtotime($avaliacao->data_inicio));
            $ate = date('Y-m-d', strtotime($avaliacao->data_fim));
            $edicao = InformacoesMotic::latest()->first();
            return view('welcome', compact('nova_data', 'de', 'ate','edicao'));
        } else {
            return view('welcome');
        }
    }

    public function regulamento()
    {
        return view('regulamento');
    }

    public function contato()
    {
        $conteudo = Conteudo::latest()->first();
        return view('contato', compact('conteudo'));
    }

    public function sobre()
    {
        $conteudo = Conteudo::latest()->first();
        return view('sobre', compact('conteudo'));
    }

    public function votacaoPopular()
    {
        $projetos = Projeto::where('ano', '=', date('Y'))
            ->orderBy('titulo', 'asc')->get();

        return view('votacao-popular', compact('projetos'));
    }

    public function indexUserVotacaoPopular()
    {

        try {
            $projetos = Projeto::where('ano', '=', date('Y'))
                ->orderBy('titulo', 'asc')->get();

            return view("admin.votacaoPopular.home", compact('projetos'));
        } catch (\Exception $e) {
            return abort(100, '170');
        }
    }



    public function avaliacaoPopular(\Illuminate\Http\Request $request)
    {
        $dataForm = $request->all();
        $projeto = Projeto::find($dataForm['projetos']);
        $votacao_popular = $projeto->votacao_popular + 1;
        $projeto->votacao_popular = $votacao_popular;
        $projeto->save();
        Session::put('mensagem', "O seu voto para o projeto " . $projeto->titulo . " foi computado!");
        $projetos = Projeto::where('ano', '=', date('Y'))
            ->orderBy('titulo', 'asc')->get();

        return view("admin.votacaoPopular.home", compact('projetos'));
    }



    public function votacaoPopularCadastroUser()
    {
        try {
            return view("admin.votacaoPopular.cadastrar");
        } catch (\Exception $e) {
            return abort(100, '121');
        }
    }
    public function votacaoPopularCadastroUser_salvar(\Illuminate\Http\Request $request)
    {
        $dados = $request->all();

        try {
            $user = User::create([
                'name' => 'votacaoPopular',
                'username' => strtolower($dados['username']),
                'email' => strtolower($dados['email']),
                'password' => bcrypt($dados['password']),
                'tipoUser' => 'votacaoPopular',
                'ativo' => 1,
            ]);

            Session::put('mensagem', "Usuário cadastrado com sucesso.");
            return redirect()->route('votacaoPopular.cadastro');
        } catch (\Exception $e) {

            return abort(100, '121');
        }
    }

    public function cadastroAvaliadoresExter()
    {
        try {

            $avaliacao = InscricaoAvaliadores::orderBy('id', 'desc')->first();
            $data = new \DateTime();
            $nova_data = date('Y-m-d', strtotime($data->format('Y-m-d')));
            $de = date('Y-m-d', strtotime($avaliacao->data_inicio));
            $ate = date('Y-m-d', strtotime($avaliacao->data_fim));


            if (($nova_data >= $de)  && ($nova_data <= $ate)) {

                $titulo = 'Cadastrar avaliador Externo';
                return view('admin.avaliador.cadastroExterno', compact('titulo'));
            } else {

                Session::put('mensagem', "Você está fora do período de inscrição");
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return abort(100, '121');
        }
    }

    public function storeCadastroAvaliadoresExter(AvaliadorCreateFormRequest $request)
    {
        try {
            $request['cpf'] = str_replace("-", "",  $request['cpf']);
            $request['cpf'] = str_replace(".", "",  $request['cpf']);
            
            $dataForm = $request->all() + ['tipoUser' => 'avaliador', 'ativo' => 0];

            $cpfCadastrado = Avaliador::where('cpf', $dataForm['cpf'])->first();

				
            if (isset($cpfCadastrado)) {

                return view('admin.avaliador.cadastroExterno', compact('cpfCadastrado'));
            } else {
                //valida se username é unico.
                $user = User::create([
                    'name' => $dataForm['name'],
                    'username' => $dataForm['username'],
                    'email' => $dataForm['email'],
                    'password' => bcrypt($dataForm['password']),
                    'tipoUser' => $dataForm['tipoUser'],
                    'ativo'    => $dataForm['ativo']
                    //cria avaliador desativado como default, pois tera uma tabela para adm ativa-lo após validação
                ]);

                $avaliador = Avaliador::create($dataForm + ['user_id' => $user->id]);

                $endereco = Endereco::create($dataForm + ['user_id' => $user->id]);

                Session::put('mensagem', "O avaliador " . $avaliador->name . " foi salvo com sucesso!");

                return redirect()->route("cadastro.avaliadores.externo");
            }
        } catch (\Exception $e) {
            return abort(100, '122');
        }
    }


    public function certificadoAluno($id)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 9999999);
        try {
            $verificaCertificadosGerados = Aluno::where('id','=',$id)->first();

            if($verificaCertificadosGerados->nCertificadosGerados < 1){

                $verificaCertificadosGerados->nCertificadosGerados += 1;
                $verificaCertificadosGerados->update();
				
				
                $base64_chancela1 = substr(base64_encode(md5(mt_rand())), 0, 15);

                $base64_chancela2 = substr(base64_encode(md5(mt_rand())), 0, 15);

                $base64_chancela3 = substr(base64_encode(md5(mt_rand())), 0, 15);

                $base64_chancela4 = substr(base64_encode(md5(mt_rand())), 0, 15);

                $chancela = 'Aluno-' . '-' . $base64_chancela2 . '-' . $base64_chancela3 . '-' . $base64_chancela4;


                $aluno = Aluno::where('id', '=', $id)->first();
                $edicao = InformacoesMotic::latest()->first();
                $nome = $aluno->name;
				$titulo = "Certificado Motic ". date('Y') .' -'. $nome;
                $emailEscola = $aluno->escola->user->email;
				$emailAluno = $aluno->email;
				


                $pdf = \PDF::setOptions(['dpi' => 325, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('pdf.aluno.alunoCertificado', compact('aluno', 'chancela', 'edicao'))->setPaper('letter', 'landscape')->stream();

                file_put_contents('certificado/alunos/' . $chancela . '.pdf', $pdf);
				
				$exce = shell_exec('cd certificado/alunos && ghostscript -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook  \-dNOPAUSE -dQUIET -dBATCH -dDetectDuplicateImages \-dCompressFonts=true -r150 -sOutputFile="'. $chancela . 'S.pdf"  '  . $chancela . '.pdf');
				
					
				unlink('certificado/alunos/' . $chancela . '.pdf');

                Chancela::create([
                    'name' => $aluno->name,
                    'chancela' =>  $chancela,
                    'tipo' => 'aluno',
                    'escola' => $aluno->escola->name,
                    'escola_id' => $aluno->escola_id,
                    'avaliador_id' => null,
                    'ano' => date('Y'),
                 ]);
				
				 Mail::send('mail.chancela', ['chancela' => $chancela, 'nome' => $nome], function ($message) use ($nome, $emailEscola,$emailAluno,$titulo,$chancela){

					$message->from('sistemas.saoleo@saoleopoldo.rs.gov.br','Motic São Leopoldo'.date('Y') );
					$message->to($emailEscola);
					if(isset($emailAluno)){ //verifica se o aluno preencheu o  email
					$message->cc($emailAluno);				
					}
					$message->subject($titulo);
					$message->attach(public_path('certificado/alunos/' . $chancela . 'S.pdf'));

				});

                return $pdf;

            }else{

                Session::put('mensagem', "Limite de geração de certificados atingido.");

                return redirect()->back();

            }


        } catch (\Exception $e) {
            return abort(100, '122');
        }
    }


    public function certificadoAvaliador($id)
    {
        

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 9999999);

        $verificaCertificadosGerados = Avaliador::where('id','=',$id)->first();

        if($verificaCertificadosGerados->nCertificadosGerados < 1){


            $verificaCertificadosGerados->nCertificadosGerados += 1;
            $verificaCertificadosGerados->update();

            $base64_chancela1 = substr(base64_encode(md5(mt_rand())), 0, 15);

            $base64_chancela2 = substr(base64_encode(md5(mt_rand())), 0, 15);

            $base64_chancela3 = substr(base64_encode(md5(mt_rand())), 0, 15);

            $base64_chancela4 = substr(base64_encode(md5(mt_rand())), 0, 15);

            $chancela = 'Avaliador-' . $base64_chancela1 . '-' . $base64_chancela2 . '-' . $base64_chancela3;


            $avaliador = Avaliador::where('id', '=', $id)->first();
            $edicao = InformacoesMotic::latest()->first();
			$nome = $avaliador->name;
			$titulo = "Certificado Motic ". date('Y') .' -'. $nome;
            $emailAvaliador = $avaliador->user->email;
            $avaliador_id = Auth::user()->avaliador['id'];
            
            $pdf = \PDF::setOptions(['dpi' => 325, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('pdf.avaliador.avaliadorCertificado', compact('avaliador', 'chancela','edicao'))->setPaper('a4', 'landscape')->stream();



            file_put_contents('certificado/avaliadores/' . $chancela . '.pdf', $pdf);
			
			$exce = shell_exec('cd certificado/avaliadores && ghostscript -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook  \-dNOPAUSE -dQUIET -dBATCH -dDetectDuplicateImages \-dCompressFonts=true -r150 -sOutputFile="'. $chancela . 'S.pdf"  '  . $chancela . '.pdf');
		
			
			unlink('certificado/avaliadores/' . $chancela . '.pdf');
            

			Chancela::create([
                    'name' => $avaliador->name,
                    'chancela' =>  $chancela,
                    'tipo' => 'avaliador',
                    'escola' => null,
                    'escola_id' => null,
                    'avaliador_id' => $avaliador_id,
                    'ano' => date('Y'),
                    
             ]);
				
			 Mail::send('mail.chancela', ['chancela' => $chancela, 'nome' => $nome], function ($message) use ($nome, $emailAvaliador,$titulo,$chancela){

					$message->from('sistemas.saoleo@saoleopoldo.rs.gov.br','Motic São Leopoldo'.date('Y') );
					$message->to($emailAvaliador);
					$message->subject($titulo);
					$message->attach(public_path('/certificado/avaliadores/' . $chancela . 'S.pdf'));

			 });

			
            return $pdf;
        }else{

            Session::put('mensagem', "Limite de geração de certificados atingido.");

            return redirect()->back();

        }

    }



    public function certificadoProfessorOrientador($id)
    {

        $verificaCertificadosGerados = Professor::where('id','=',$id)->first();

        if($verificaCertificadosGerados->nCertificadosGeradosOrientador < 1){
        
        $verificaCertificadosGerados->nCertificadosGeradosOrientador += 1;
        $verificaCertificadosGerados->update();
    
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 9999999);
        $base64_chancela1 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $base64_chancela2 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $base64_chancela3 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $base64_chancela4 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $chancela = 'ProfessorOrientador-' . $base64_chancela1 . '-' . $base64_chancela2 . '-' . $base64_chancela3;

        
        $professor = Professor::where('id', '=', $id)->first();
        $edicao = InformacoesMotic::latest()->first();
		$nome = $professor->name;
        $titulo = "Certificado Motic ". date('Y') .' -'. $nome;
        //Chancela::where('tipo', '=', 'orientador')->where('escola_id', '=', $id)->orderBy('name', 'asc')->get();
        $emailOrientador = $professor->user->email;
        
        
        $pdf = \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'compress' => 1])
            ->loadView('pdf.professor.orientadorCertificado', compact('professor', 'chancela', 'edicao'))->setPaper('a4', 'landscape')->stream();


     

        file_put_contents('certificado/professoresOrientadores/' . $chancela . '.pdf', $pdf);
		
		$exce = shell_exec('cd certificado/professoresOrientadores && ghostscript -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook  \-dNOPAUSE -dQUIET -dBATCH -dDetectDuplicateImages \-dCompressFonts=true -r150 -sOutputFile="'. $chancela . 'S.pdf"  '  . $chancela . '.pdf');
		
        unlink('certificado/professoresOrientadores/' . $chancela . '.pdf');
        
        
        Chancela::create([
            'name' => $nome,
            'chancela' =>  $chancela,
            'tipo' => 'orientador',
            'escola' => null,
            'escola_id' => Auth::user()->escola['id'],
            'avaliador_id' => null,
            'ano' => date('Y'),
         ]);
        
	
		Mail::send('mail.chancela', ['chancela' => $chancela, 'nome' => $nome], function ($message) use ($nome, $emailOrientador,$titulo,$chancela){

				$message->from('sistemas.saoleo@saoleopoldo.rs.gov.br','Motic São Leopoldo'.date('Y') );
				if(isset($emailOrientador)){ //verifica se o orientador preencheu o  email
				 	$message->cc($emailOrientador);				
				 }
				$message->subject($titulo);
				$message->attach(public_path('certificado/professoresOrientadores/' . $chancela . 'S.pdf'));

		});
	
        return $pdf;

        } else {

            Session::put('mensagem', "Limite de geração de certificados atingido.");

            return redirect()->back();

        }

        
    }


    public function certificadoProfessorCoorientador($id)
    {

        $verificaCertificadosGerados = Professor::where('id','=',$id)->first();

        if($verificaCertificadosGerados->nCertificadosGeradosCoorientador < 1){
        
        $verificaCertificadosGerados->nCertificadosGeradosCoorientador += 1;
        $verificaCertificadosGerados->update();

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 9999999);

        $base64_chancela1 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $base64_chancela2 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $base64_chancela3 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $base64_chancela4 = substr(base64_encode(md5(mt_rand())), 0, 15);

        $chancela = 'ProfessorCoorientador-' . $base64_chancela1 . '-' . $base64_chancela2 . '-' . $base64_chancela3;


        $professor = Professor::where('id', '=', $id)->first();
        $edicao = InformacoesMotic::latest()->first();
		$nome = $professor->name;
		$titulo = "Certificado Motic ". date('Y') .' -'. $nome;
		$emailCoorientador = $professor->user->email;
        

        $pdf = \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'compress' => 0])
            ->loadView('pdf.professor.coorientadorCertificado', compact('professor', 'chancela', 'edicao'))->setPaper('a4', 'landscape')->stream();

        file_put_contents('certificado/professoresCoorientadores/' . $chancela . '.pdf', $pdf);

		$exce = shell_exec('cd certificado/professoresCoorientadores && ghostscript -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook  \-dNOPAUSE -dQUIET -dBATCH -dDetectDuplicateImages \-dCompressFonts=true -r150 -sOutputFile="'. $chancela . 'S.pdf"  '  . $chancela . '.pdf');
	
		
        unlink('certificado/professoresCoorientadores/' . $chancela . '.pdf');

        Chancela::create([
            'name' => $professor->name,
            'chancela' =>  $chancela,
            'tipo' => 'coorientador',
            'escola' => null,
            'escola_id' => Auth::user()->escola['id'],
            'avaliador_id' => null,
            'ano' => date('Y'),
         ]);
        
		
		Mail::send('mail.chancela', ['chancela' => $chancela, 'nome' => $nome], function ($message) use ($nome, $emailCoorientador,$titulo,$chancela){

				$message->from('sistemas.saoleo@saoleopoldo.rs.gov.br','Motic São Leopoldo'.date('Y') );
				if(isset($emailCoorientador)){ //verifica se o orientador preencheu o  email
				 	$message->cc($emailCoorientador);				
				 }
				$message->subject($titulo);
				$message->attach(public_path('certificado/professoresCoorientadores/' . $chancela . 'S.pdf'));

		});
	

        return $pdf;

        }else{

            Session::put('mensagem', "Limite de geração de certificados atingido.");

            return redirect()->back();

        }
    }


    public function chancelaView()
    {
        try {
            return view('_layouts.chancela');
        } catch (\Exception $e) { }
    }



    public function procuraChancela(Request $request)
    {
        $chancela = $request['chancela'];

        if (strpos($chancela, 'Professor') !== false) {
            if (file_exists(public_path() . '/certificado/professoresOrientadores/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/professoresOrientadores/' . $chancela . 'S.pdf'));
            } else if (file_exists(public_path() . '/certificado/professoresCoorientadores/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/professoresCoorientadores/' . $chancela . 'S.pdf'));
            } else {
                Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
                return redirect()->route('certificado.chancela.view');
            }
        } else if (strpos($chancela, 'Avaliador') !== false) {
            if (file_exists(public_path() . '/certificado/avaliadores/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/avaliadores/' . $chancela . 'S.pdf'));
            } else {
                Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
                return redirect()->route('certificado.chancela.view');
            }
        } else if (strpos($chancela, 'Aluno') !== false) {
            if (file_exists(public_path() . '/certificado/alunos/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/alunos/' . $chancela . 'S.pdf'));
            } else {
                Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
                return redirect()->route('certificado.chancela.view');
            }
        }
        else{
            Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
            return redirect()->route('certificado.chancela.view');
        }
    }

    public function procuraChancelaInterno($chancela)
    {
        if (strpos($chancela, 'Professor') !== false) {
            if (file_exists(public_path() . '/certificado/professoresOrientadores/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/professoresOrientadores/' . $chancela . 'S.pdf'));
            } else if (file_exists(public_path() . '/certificado/professoresCoorientadores/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/professoresCoorientadores/' . $chancela . 'S.pdf'));
            } else {
                Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
                return redirect()->route('certificado.chancela.view');
            }
        } else if (strpos($chancela, 'Avaliador') !== false) {
            if (file_exists(public_path() . '/certificado/avaliadores/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/avaliadores/' . $chancela . 'S.pdf'));
            } else {
                Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
                return redirect()->route('certificado.chancela.view');
            }
        } else if (strpos($chancela, 'Aluno') !== false) {
            if (file_exists(public_path() . '/certificado/alunos/' . $chancela . 'S.pdf')) {
                return redirect(URL::asset('/certificado/alunos/' . $chancela . 'S.pdf'));
            } else {
                Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
                return redirect()->route('certificado.chancela.view');
            }
        }
        else{
            Session::put('mensagem', "A chancela informada não consta em nosso servidor!");
            return redirect()->route('certificado.chancela.view');
        }
    }

    


    public function projetoSustentavel()
    {
        $projetoSustentavel = DB::select(DB::raw("SELECT * FROM projetos WHERE categoria_id in (4,5) and ano = " . date('Y') . " and tipo = 'normal' order by titulo"));
        return view('projetoSustentavel.home', compact('projetoSustentavel'));
    }


    public function projetoSustentavelExibe()
    {
        $projetos = Projeto::where('tipo', '=', 'normal')
                            ->where('ano', '=', date('Y'))
                            ->where('votacao_sustentavel', '!=', NULL)
                            ->orderBy('votacao_sustentavel', 'desc')
                            ->get();


        //$projetoSustentavel = DB::select(DB::raw("SELECT * FROM projetos WHERE categoria_id in (4,5) and ano = " . date('Y') . " and tipo = 'normal' order by votacao_sustentavel"));
        return view('admin.avaliacao.classificacao-sustentavel', compact('projetos'));
    }


    public function projetoSustentavelExibeAno(Request $request)
    {
        $dataForm = $request->all();
        $projetos = Projeto::where('tipo', '=', 'normal')
                            ->where('ano', '=', $dataForm['edicao'])
                            ->where('votacao_sustentavel', '!=', NULL)
                            ->orderBy('votacao_sustentavel', 'desc')
                            ->get();

        return view('admin.avaliacao.classificacao-sustentavel', compact('projetos'));
    }
public function projetoSustentavelEscolha(Request $request)
    {
        $dataForm = $request->all();
        $projetoSustentavel = Projeto::find($dataForm['projetos']);
        $votacao_sustentavel = $projetoSustentavel->votacao_sustentavel + 1;
        $projetoSustentavel->votacao_sustentavel = $votacao_sustentavel;
        $projetoSustentavel->save();
        $desativaUser = Auth::user();
        $desativaUser->ativo = 0;
        $desativaUser->update();


        Session::put('mensagem', "O seu voto para o projeto " . $projetoSustentavel->titulo . " foi computado!");
        Auth::logout();
        return redirect()->route('home');

    }

    public function projetoSustentavelCadastroUsuario(){
        try {
        return view("projetoSustentavel.cadastrar");
        } catch (\Exception $e) {
            return abort(100, '121');
        }
    }

    public function projetoSustentavelCadastroUsuarioSalvar(Request $request)
    {
        $dados = $request->all();


            $user = User::create([
                'name' => strtolower($dados['name']),
                'username' => strtolower($dados['username']),
                'email' => strtolower($dados['email']),
                'password' => bcrypt($dados['password']),
                'tipoUser' => 'projetoSustentavel',
                'ativo' => 1,
            ]);

            Session::put('mensagem', "Usuário cadastrado com sucesso.");
            return redirect()->route('projetoSustentavel.cadastroUsuario');


    }


    public function tabelaChancelaVisualizarAluno($id = null)
    {
        if (isset($id)) {
            $usuarios = Chancela::where('tipo', '=', 'aluno')->where('escola_id', '=', $id)->orderBy('name', 'asc')->get();
        } else {
            $usuarios = Chancela::where('tipo', '=', 'aluno')->orderBy('name', 'asc')->get();
        }
       
        $temEscola = 'sim'; 

        return view ("_layouts.homeChancela", compact('usuarios', 'temEscola'));
    }

    public function tabelaChancelaVisualizarOrientador($id = null)
    {

        if (isset($id)) {
            $usuarios = Chancela::where('tipo', '=', 'orientador')->where('escola_id', '=', $id)->orderBy('name', 'asc')->get();
        } else {
            $usuarios = Chancela::where('tipo', '=', 'orientador')->orderBy('name', 'asc')->get();
        }
       
        $temEscola = null; 

        return view ("_layouts.homeChancela", compact('usuarios', 'temEscola'));
    }

    public function tabelaChancelaVisualizarCoorientador($id = null)
    {

        if (isset($id)) {
            $usuarios = Chancela::where('tipo', '=', 'coorientador')->where('escola_id', '=', $id)->orderBy('name', 'asc')->get();
        } else {
            $usuarios = Chancela::where('tipo', '=', 'coorientador')->orderBy('name', 'asc')->get();
        }
       
        $temEscola = null; 
        
        return view ("_layouts.homeChancela", compact('usuarios', 'temEscola'));
    }

    public function tabelaChancelaVisualizarAvaliador($id = null)
    {
     
        if (isset($id)) {
            $usuarios = Chancela::where('tipo', '=', 'avaliador')->where('avaliador_id', '=', $id)->get();
        } else {
            $usuarios = Chancela::where('tipo', '=', 'avaliador')->orderBy('name', 'asc')->get();
        }

        $temEscola = null; 

        return view ("_layouts.homeChancela", compact('usuarios', 'temEscola'));
    }

}
