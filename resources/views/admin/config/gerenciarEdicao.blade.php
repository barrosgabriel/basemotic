@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.config.edicao')}}" class="breadcrumb">Configurar edição</a>
@endsection

@section('content')

@section('titulo-header', 'Configurar edição')

@section('conteudo-header', "Aqui você pode configurar os dados da edição da MOTIC ".date('Y'))

@includeIf('_layouts._sub-titulo')

<div class="section container">
        <div class="card-panel">
            <div class="col s12 m4 l8">
                @if(Session::get('mensagem'))
                    @include('_layouts._mensagem-sucesso')
                @endif
                <blockquote>Atenção! Neste formulário será possível editar as informações da edição vigente da MOTIC.
                </blockquote>
    
                <form method="POST" enctype="multipart/form-data"
                      action="{{ route("admin.config.edicao.store") }}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <input type="number" name="edicao" id="edicao"
                                   value="@if(isset($informacoesMotic->edicao)){{$informacoesMotic->edicao or old('edicao')}}@endif">
                            <label for="edicao">Edição (exemplo: 7)</label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">access_time</i>
                            <input type="text" class="datepicker" id="data_inicio" name="data_inicio"
                                    value="@if(isset($informacoesMotic->data_inicio)){{$informacoesMotic->data_inicio or old('data_inicio')}}@endif">
                            <label for="data_inicio">Data de Início</label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">access_time</i>
                            <input type="text" class="datepicker" id="data_fim" name="data_fim"
                                    value="@if(isset($informacoesMotic->data_fim)){{$informacoesMotic->data_fim or old('data_fim')}}@endif">
                            <label for="data_fim">Data do Fim</label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">person</i>
                                <input type="text" name="secretario" id="secretario"
                                        value="@if(isset($informacoesMotic->secretario)){{$informacoesMotic->secretario or old('secretario')}}@endif">
                                <label for="secretario">Nome do secretário</label>
                        <div class="row">
                            <div class="file-field col s12 m12 l12">
                                <div class="btn blue darken-4">
                                    <span>Imagem da assinatura do secretário</span>
                                        <input type="file" name="assinatura_secretario" id="assinatura_secretario">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" name="assinatura_secretario" id="assinatura_secretario"
                                    value="@if(isset($informacoesMotic->assinatura_secretario)){{$informacoesMotic->assinatura_secretario or old('assinatura_secretario')}}@endif">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">person</i>
                                <input type="text" name="prefeito" id="prefeito"
                                        value="@if(isset($informacoesMotic->prefeito)){{$informacoesMotic->prefeito or old('prefeito')}}@endif">
                                <label for="prefeito">Nome do prefeito</label>
                        <div class="row">
                            <div class="file-field col s12 m12 l12">
                                <div class="btn blue darken-4">
                                    <span>Imagem da assinatura do prefeito</span>
                                        <input type="file" name="assinatura_prefeito" id="assinatura_prefeito">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" name="assinatura_prefeito" id="assinatura_prefeito"
                                    value="@if(isset($informacoesMotic->assinatura_prefeito)){{$informacoesMotic->assinatura_prefeito or old('assinatura_prefeito')}}@endif">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                </div>        

                    
                            
                           
                        <div class="center center-align">
                            <button class="waves-effect waves-light btn blue darken-4" type="submit"><i
                                        class="material-icons right">send</i>salvar
                            </button>
                        </div>
                    </div>
                </div>
                
                </form>
    
    @endsection