@extends('adminlte::page')

@section('title', 'Campeonatos')

@section('content_header')
<div class="card-header bg-dark">
    <div class="row align-items-center">
        <h5><b>CAMPEONATOS | </b> Lista de Registros</h5>
    </div>
    <form action="{{route('admin.campeonatos.index')}}" method="get">
        <div class="row ">
            <div class="col-md-11 mt-2">
                <input name="search" type="search" class="form-control" placeholder="Ingresa un nombre de campeonato">
            </div>    
            <div class="col-md-1 mt-2">
                <button type="submit" class="btn btn-outline-light">Buscar</button>
            </div>                
        </div>
    </form>
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
            <table class="table table-stripe">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>FECHA DE INICIO</th>
                        <th>DESCUENTO</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campeonatos as $campeonato)
                        <tr>
                            <td><b>{{$campeonato->idCampeonato}}</b></td>
                            <td>{{$campeonato->NombreCam}}</td>
                            <td>{{$campeonato->FechaInicioCam}}</td>
                            <td>{{$campeonato->DescuentoCam.'%'}}</td>
                            @can('admin.campeonatos.show')
                            <td width="10px">
                            <a class="btn btn-primary" href="{{route('admin.campeonatos.show', $campeonato)}}">Ver</a>
                            </td>
                            @endcan
                            @can('admin.campeonatos.edit')
                            <td width="10px">
                                <a class="btn btn-primary" href="{{url('/admin/campeonatos/'.$campeonato->idCampeonato.'/edit')}}">Editar</a>
                            </td>
                            @endcan
                            @can('admin.campeonatos.destroy')
                            <td width="10px">
                                <form action="{{route('admin.campeonatos.destroy', $campeonato)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea eliminar {{$campeonato->NombreCam}}?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                 
    </div>
    {{$campeonatos->links()}} <!-- Paginación de bootstrap y laravel -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
    