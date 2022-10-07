@extends('adminlte::page')

@section('title', 'Deporte')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-10">
                <h5><b>ID: </b> {{$deporte->idDeporte}}</h5>
                <h1><b>{{$deporte->NombreDep}}</b></h1>
            </div>
            @can('admin.deportes.edit')
            <div class="col-md-2 ">
                <a class="btn btn-light" href="{{url('/admin/deportes/'.$deporte->idDeporte.'/edit')}}">Editar</a>  
            </div>
            @endcan
        </div>
    </div>
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
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 pr-5 pb-2">
                        <h5><b>Portada</b></h5>
                        <img src="{{$deporte->PortadaDep}}" class="img-fluid rounded">   
                    </div>
                    <div class="col-md-5">
                        <h5><b>Descripcion</b></h5>
                        {{$deporte->DescripcionDep}}
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
                        <th>Campeonato</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campeonatos as $campeonato)
                        <tr>
                            <td>{{$campeonato->idCampeonato}}</td>
                            <td>{{$campeonato->NombreCam}}</td>
                            @can('admin.campeonatos.show')
                            <td width="10px">
                            <a class="btn btn-primary" href="{{route('admin.campeonatos.show', $campeonato)}}">Ver</a>
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
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
    <!-- <script> console.log('Hi!'); </script> -->
@stop