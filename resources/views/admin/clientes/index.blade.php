@extends('adminlte::page')

@section('title', 'Videos')

@section('content_header')
<div class="card-header bg-dark">
    <div class="row align-items-center">
        <h5><b>CLIENTES | </b> Lista de Registros</h5>
    </div>
    <form action="{{route('admin.clientes.index')}}" method="get">
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
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->NombreCli}}</td>
                            <td>{{$cliente->email}}</td>
                            <td>
                            <a class="btn btn-outline-info rounded-circle m-1" href="{{route('admin.clientes.show', $cliente)}}">
                            <i class="fas fa-eye"></i>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                 
    </div>
    {{$clientes->links()}} <!-- Paginación de bootstrap y laravel -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
    