<?php

namespace App\Http\Controllers\Admin\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categorias = Categoria::all();
            return view('admin.categoria.categoria', compact('categorias'));
        } catch (\Exception $e) {
            return abort(100,  '130');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $dataForm = $request->all();
            $categoria = Categoria::create($dataForm);
            Session::put('mensagem', "A categoria " . $categoria->categoria . " foi criada com sucesso!");
            return redirect()->route('admin.categoria');
        } catch (\Exception $e) {
            return abort(100,  '131');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

        } catch (\Exception $e) {
            return abort(100,  '132');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $categoria = Categoria::find($id);
            return view('admin.categoria.editar', compact('categoria'));
        } catch (\Exception $e) {
            return abort(100,  '133');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $dataForm = $request->all();
            $categoria = Categoria::find($id);
            $categoria->categoria = $dataForm['categoria'];
            $categoria->descricao = $dataForm['descricao'];
            $categoria->save();
            Session::put('mensagem', "A categoria " . $categoria->categoria . " foi editada com sucesso!");
            return redirect()->route('admin.categoria');
        } catch (\Exception $e) {
            return abort(100,  '134');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $categoria = Categoria::find($id);
            $categoria->delete($id);
            Session::put('mensagem', "A categoria " . $categoria->categoria . " foi deletada com sucesso!");
            return route('admin.categoria');
        } catch (\Exception $e) {
            return abort(100,  '135');
        }
    }
}
