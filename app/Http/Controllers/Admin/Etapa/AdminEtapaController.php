<?php

namespace App\Http\Controllers\Admin\Etapa;

use App\Categoria;
use App\Etapa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminEtapaController extends Controller
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
            $etapas = Etapa::all();
            return view('admin.etapa.etapa', compact('categorias', 'etapas'));
        } catch (\Exception $e) {
            return abort(100, '156');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $etapa = Etapa::create($dataForm);
            Session::put('mensagem', "A etapa " . $etapa->etapa . " foi criada com sucesso!");
            return redirect()->route('admin.etapa');
        } catch (\Exception $e) {
            return abort(100, '157');
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
            $etapa = Etapa::find($id);
            return view('admin.etapa.editar', compact('etapa'));
        } catch (\Exception $e) {
            return abort(100, '158');
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
            $etapa = Etapa::find($id);
            $etapa->etapa = $dataForm['etapa'];
            $etapa->save();
            Session::put('mensagem', "A etapa " . $etapa->etapa . " foi editada com sucesso!");
            return redirect()->route('admin.etapa');
        } catch (\Exception $e) {
            return abort(100, '159');
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
            $etapa = Etapa::find($id);
            $etapa->delete($id);
            Session::put('mensagem', "A etapa " . $etapa->etapa . " foi deletada com sucesso!");
            return redirect()->route('admin.etapa');
        } catch (\Exception $e) {
            return abort(100, '159.1');
        }
    }
}
