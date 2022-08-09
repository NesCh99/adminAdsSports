@extends('adminlte::page')

@section('title', 'Publicidades')

@section('content_header')
<div class="card-header bg-dark">
    <div class="row align-items-center">
        <h5><b>PUBLICIDADES | </b> Lista de Registros</h5>
    </div>
<!--     <form action="{{route('admin.videos.index')}}" method="get">
        <div class="row ">
            <div class="col-md-11 mt-2">
                <input name="search" type="search" class="form-control" placeholder="Ingresa un nombre de video">
            </div>    
            <div class="col-md-1 mt-2">
                <button type="submit" class="btn btn-outline-light">Buscar</button>
            </div>                
        </div>
    </form> -->
</div>
@stop

@section('content')
@if(session('info'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('info')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row justify-content-center">        
    @foreach($publicidades as $publicidad)
        <div class="card p-3 m-2" style="width: 15rem;">
            <img src="{{Storage::url($publicidad->PortadaPub)}}" class="card-img-top rounded" width="150px" height="150px">
            <div class="card-body">
                <h5 class="card-title"><b> Posición: {{$publicidad->idPublicidad}}</b></h5>
                <p class="card-text">{{$video->DescripcionPub}}</p>
            </div>
            <a href="{{route('admin.publicidades.edit', $publicidad)}}" class="btn btn-outline-primary">Editar</a>
        </div>
    @endforeach
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
    