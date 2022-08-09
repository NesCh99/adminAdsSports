@extends('adminlte::page')

@section('title', 'Deportes')

@section('content_header')
<div class="card-header bg-dark">
    <div class="row align-items-center">
        <h5><b>DEPORTES | </b> Lista de Registros</h5>
    </div>
    <form action="{{route('admin.deportes.index')}}" method="get">
        <div class="row ">
            <div class="col-md-11 mt-2">
                <input name="search" type="search" class="form-control" placeholder="Ingresa un nombre de deporte">
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
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deportes as $deporte)
                        <tr>
                            <td><b>{{$deporte->idDeporte}}</b></td>
                            <td>{{$deporte->NombreDep}}</td>
                            @can('admin.deportes.show')
                            <td width="10px">
                            <a class="btn btn-primary" href="{{route('admin.deportes.show', $deporte)}}">Ver</a>
                            </td>
                            @endcan
                            @can('admin.deportes.edit')
                            <td width="10px">
                                <a class="btn btn-primary" href="{{url('/admin/deportes/'.$deporte->idDeporte.'/edit')}}">Editar</a>
                            </td>
                            @endcan
                            @can('admin.deportes.destroy')
                            <td width="10px">
                            <!-- {{url('/admin/deportes/'.$deporte->idDeporte.'/destroy')}} -->
                                <form action="{{route('admin.deportes.destroy', $deporte)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar {{$deporte->NombreDep}}?')">
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
    {{$deportes->links()}} <!-- Paginación de bootstrap y laravel -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
    