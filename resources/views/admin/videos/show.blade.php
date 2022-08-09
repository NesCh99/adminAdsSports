@extends('adminlte::page')

@section('title', 'Video')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-10">
                <h5><b>ID: </b> {{$video->idVideo}}</h5>
                <h1><b>{{$video->NombreVid}}</b></h1>
                <p><b>{{$deporte->NombreDep}}</b> | {{$campeonato->NombreCam}}</p>
                @if(is_null($metadato))
                <a class="btn btn-outline-info" href="{{url('/admin/videos/'.$video->idVideo.'/createLiveStream')}}">Transmisión</a>
                @else
                <a class="btn btn-outline-info" href="{{url('/admin/videos/'.$video->idVideo.'/retrieveLiveStream')}}">Transmisión</a>
                @endif
            </div>
            @can('admin.videos.edit')
            <div class="col-md-1">
                <a class="btn btn-outline-light" href="{{url('/admin/videos/'.$video->idVideo.'/edit')}}">Editar</a>  
            </div>
            @endcan
            @can('admin.videos.destroy')
            <div class="col-md-1">
                <form action="{{route('admin.videos.destroy', $video)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Desea eliminar {{$video->NombreVid}}?')">
                        Eliminar
                    </button>
                </form>                
            </div>
            @endcan
        </div>
    </div>
</div>
@stop

@section('content')
@if(session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row pb-3">
                <div class="col-md-4">
                    <h5><b>Fecha de Inicio: </b>{{$video->FechaInicioVid}}</h5>
                </div>
                <div class="col-md-4">
                    @if(is_null($video->HoraInicioVid))
                    <h5><b>Hora de Inicio: </b>Sin Asignar</h5>
                    @else
                    <h5><b>Hora de Inicio: </b>{{$video->HoraInicioVid}}</h5>
                    @endif
                </div>
                <div class="col-md-4">
                    <h5><b>Precio: </b>${{$video->PrecioVid}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 pr-5 pb-2">
                    <h5><b>Portada</b></h5>
                    <img src="{{Storage::url($video->PortadaVid)}}" class="img-fluid rounded">   
                </div>
                <div class="col-md-5">
                    <h5><b>Descripcion</b></h5>
                    {{$video->DescripcionVid}}
                </div>
            </div>          
        </div>
    </div>  
</div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop