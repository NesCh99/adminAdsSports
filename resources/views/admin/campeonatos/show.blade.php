@extends('adminlte::page')

@section('title', 'Campeonato')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-10">
                <h5><b>ID: </b> {{$campeonato->idCampeonato}}</h5>
                <h1><b>{{$campeonato->NombreCam}}</b></h1>
                <p>{{$deporte->NombreDep}}</p>
            </div>
            @can('admin.campeonatos.edit')
            <div class="col-md-2 ">
                <a class="btn btn-light" href="{{url('/admin/campeonatos/'.$campeonato->idCampeonato.'/edit')}}">Editar</a>  
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
                <div class="row">
                    <div class="col-md-7 pr-5 pb-2">
                        <h5><b>Portada</b></h5>
                        <img src="{{Storage::url($campeonato->PortadaCam)}}" class="img-fluid rounded">   
                    </div>
                    <div class="col-md-5">
                        <h5><b>Descripcion</b></h5>
                        {{$campeonato->DescripcionCam}}
                    </div>
                </div>          
            </div>
        </div>  
    </div>
    <div class="card">
        <div class="card-body">
        <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Video</th>
                        <th>Fecha de Inicio</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td><b>{{$video->idVideo}}</b></td>
                            <td>{{$video->NombreVid}}</td>
                            <td>{{$video->FechaInicioVid}}</td>
                            <td>{{$video->PrecioVid}}</td>
                            @can('admin.videos.show')
                            <td width="10px">
                            <a class="btn btn-primary" href="{{route('admin.videos.show', $video)}}">Ver</a>
                            </td>
                            @endcan                            
                        </tr>
                    @endforeach
                </tbody>
            </table>     
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop