@extends('_layouts._app')

@section('titulo','Motic')

@section('breadcrumb')
    <a href="{{{route ('home')}}}" class="breadcrumb">Home</a>
@endsection

@section('content')
 @if(Session::get('mensagem'))
    @include('_layouts._mensagem-sucesso')
@endif


<div class="white">
        <?php
        $aviso = App\AvisosMotic::latest()->first();
        ?>
        @if($aviso['ativo'] == 1)
        @include('_layouts.avisopopup')
        @endif
    <img class="responsive-img" src="{{url('images/motic-home.png')}}">
</div>
<script>

   </script>
@endsection
